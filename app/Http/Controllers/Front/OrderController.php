<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

use App\Libraries\MemberAuth;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\Member;
use App\Models\DeliveryFee;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function __construct()
    {
        
    }

    public function create(Request $request) {
        if (!MemberAuth::isLoggedIn()) {
            return $this->redirectMemberLogin();
        }

        $memberId = Crypt::decryptString(session('memberId'));

        $cart_products = Cart::where('member_id', $memberId)->get();

        if (count($cart_products) == 0) {
            die('購物車無商品!');
        }

        [$is_cart_updated, $cart_products] = $this->check_cart_product_and_add_category_data($cart_products, $memberId);

        if ($is_cart_updated) {
            return view('front.alert', [
                'icon_type' => 'info',
                'message' => '購物車中含有已更新資訊之商品<br>請重新確認訂單內容後再下訂!',
                'redirect' => route('cart.content')
            ]);
        }

        $customer_data = $request->input(); // 訂購人、收件人資料
        unset($customer_data['_token']);

        $validator = Validator::make(
            $request->all(),
            // [
            //     'name' => $customer_data['name'],
            //     'phone' => $customer_data['phone'],
            //     'email' => $customer_data['email'],
            //     'address' => $customer_data['address'],
            //     'receiver_name' => $customer_data['receiver_name'],
            //     'receiver_phone' => $customer_data['receiver_phone'],
            //     'receiver_email' => $customer_data['receiver_email'],
            //     'receiver_address' => $customer_data['receiver_address'],
            //     'order_remark' => $customer_data['order_remark'],
            // ],
            [
                'name' => 'required|string',
                'phone' => 'required|string',
                'email' => 'required|string',
                'address' => 'required|string',
                'receiver_name' => 'required|string',
                'receiver_phone' => 'required|string',
                'receiver_email' => 'required|string',
                'receiver_address' => 'required|string',
                'order_remark' => 'string',
            ]
        );

        if ($validator->fails()) {
            return view('front.alert', [
                'icon_type' => 'info',
                'message' => '訂單資料請填寫完整!',
                'redirect' => route('cart.content')
            ]);
        }

        // 訂單金額
        $subtotal = 0; // 商品小計
        $delivery_fee = DeliveryFee::first()->fee; // 運費
        $total = 0; // 總計

        foreach ($cart_products as $cart_product) {
            $subtotal += $cart_product->price * $cart_product->amount;
        }

        $total = $subtotal + $delivery_fee;

        // 建立訂單
        $order_data = $customer_data;
        $order_data['member_id'] = $memberId;
        $order_data['order_number'] = $this->get_order_number();
        $order_data['datetime'] = date('Y-m-d H:i:s');
        $order_data['subtotal'] = $subtotal;
        $order_data['delivery_fee'] = $delivery_fee;
        $order_data['total'] = $total;

        $order_id = Order::create($order_data)->order_id;

        // 建立訂單商品
        foreach ($cart_products as $cart_product) {
            OrderItem::create([
                'order_id' => $order_id,
                'product_name' => $cart_product['product_name'],
                'product_category_name' => $cart_product['product_category_name'],
                'product_subcategory_name' => $cart_product['product_subcategory_name'],
                'product_id' => $cart_product['product_id'],
                'product_category_id' => $cart_product['product_category_id'],
                'product_subcategory_id' => $cart_product['product_subcategory_id'],
                'product_img' => $cart_product['img_src'],
                'option_id' => $cart_product['option_id'],
                'option_name' => $cart_product['option_name'],
                'price' => $cart_product['price'],
                'amount' => $cart_product['amount'],
            ]);
        }

        // 清空購物車
        Cart::where('member_id', $memberId)->delete();

        return view('front.alert', [
            'icon_type' => 'success',
            'message' => '訂單建立成功!',
            'redirect' => route('home')
        ]);
    }

    // 檢查購物車商品資料是否有更新，以及添加商品分類資料
    private function check_cart_product_and_add_category_data($cart_products, $memberId) {
        $is_product_data_updated = false;

        foreach ($cart_products as $cart_product) {
            $product = Product::find((int) $cart_product->product_id);
            $product_option = ProductOption::find((int) $cart_product->option_id);

            if (is_null($product)
                || $product->product_name != $cart_product->product_name
                || $product->price != $cart_product->price
                // 有產品規格，檢查規格名稱是否更新
                || (!is_null($product_option) && $product_option->option_name != $cart_product->option_name)) {

                $is_product_data_updated = true;
                DB::table('cart')->where('member_id', $memberId)->where('id', $cart_product->id)->delete();
            } else {
                $cart_product->product_category_id = $product->product_category->product_category_id;
                $cart_product->product_category_name = $product->product_category->category_name;
                $cart_product->product_subcategory_id = $product->product_subcategory->product_subcategory_id;
                $cart_product->product_subcategory_name = $product->product_subcategory->subcategory_name;
            }
        }

        return [
            $is_product_data_updated,
            $cart_products
        ];
    }

    // 產生訂單編號 = 兩個隨機大寫英文字母 + 五個隨機數字
    private function get_order_number() {
    	$order_number = '';

    	$num = '1234567890';
    	$num_len = strlen($num);

    	$word = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$word_len = strlen($word);

		for($i = 0; $i < 2; $i++){ // 取 2 次
        	$order_number .= $word[rand() % $word_len]; // 隨機取得一個字元
    	}

    	for($i = 0; $i < 5; $i++){ // 取 5 次
        	$order_number .= $num[rand() % $num_len];
    	}

        $exist_order_number = Order::where('order_number', $order_number)->get();

        while (count($exist_order_number) > 0 && $j <= 10) { // 檢查訂單編號是否已存在
            $order_number = '';

            for($i = 0; $i < 2; $i++){
                $order_number .= $word[rand() % $word_len];
            }
    
            for($i = 0; $i < 5; $i++){
                $order_number .= $num[rand() % $num_len];
            }

            $exist_order_number = Order::where('order_number', $order_number)->get();
        }
		
    	return $order_number;
	}

    private function redirectMemberLogin() {
        return view('front.alert', [
            'icon_type' => 'info',
            'message' => '請登入會員!',
            'redirect' => route('member.login_form')
        ]);
    }
}
