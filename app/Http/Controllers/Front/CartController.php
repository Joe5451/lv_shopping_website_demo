<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

use App\Libraries\MemberAuth;

use App\Models\Cart;
use App\Models\HeadImg;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\Member;
use App\Models\DeliveryFee;

class CartController extends Controller
{
    var $common_data = [];
    
    public function __construct()
    {
        $this->common_data = [
            'menu_id' => 6,
            'head_img' => HeadImg::find(2),
        ];
    }

    public function add(Request $request) {
        if (!MemberAuth::isLoggedIn()) {
            return $this->redirectMemberLogin();
        }

        $memberId = Crypt::decryptString(session('memberId'));
        
        $product_id = $request->input('product_id');
        $option_id = $request->input('option_id');
        $amount = (int) $request->input('amount');
        
        $product = Product::find($product_id);

        if (is_null($product)) die('商品不存在!');

        if (!is_null($option_id)) {
            $productOption = ProductOption::find($option_id);
            if (is_null($productOption) || $productOption->product_id != $product_id)
                die('商品規格不存在!');
            else
                $option_name = $productOption->option_name;
        } else {
            $option_id = '';
            $option_name = '';
        }

        $price = $product->price;
        $img_src = $product->img_src;

        $exist_cart = DB::table('cart')
        ->where('member_id', $memberId)
        ->where('product_id', $product_id)
        ->where('option_id', $option_id)
        ->get();

        $cart_data = [
            'member_id' => $memberId,
            'product_id' => $product_id,
            'product_name' => $product->product_name,
            'option_id' => $option_id,
            'option_name' => $option_name,
            'price' => $price,
            'amount' => $amount,
            'img_src' => $img_src
        ];

        if (count($exist_cart) == 0) {
            Cart::create($cart_data);
        } else {
            Cart::where('id', $exist_cart[0]->id)->update($cart_data);
        }

        return view('front.alert', [
            'icon_type' => 'success',
            'message' => '加入購物車成功!',
            'redirect' => route('product.content', $product_id)
        ]);
    }

    public function content(Request $request) {
        if (!MemberAuth::isLoggedIn()) {
            return $this->redirectMemberLogin();
        }

        $memberId = Crypt::decryptString(session('memberId'));
        
        $data = $this->common_data;
        $data['cart_amount'] = $request->get('cart_amount');
        $data['member'] = Member::find($memberId);
        $data['cart_products'] = Cart::where('member_id', $memberId)->get();
        $data['delivery_fee'] = DeliveryFee::first()->fee;

        return view('front.cart', $data);
    }

    public function update_cart_amount(Request $request) {
        if (!MemberAuth::isLoggedIn()) {
            $res = [
                'status' => 'fail',
                'message' => '請登入會員<br>再進行操作',
                'location' => route('member.login_form')
            ];

            echo json_encode($res);
            return;
        }

        $cart_id = (int) $request->input('id');
        $amount = (int) $request->input('amount');
        $memberId = Crypt::decryptString(session('memberId'));

        if ($amount < 1 || $amount > 1000) {
            $res = [
                'status' => 'fail',
                'message' => '商品數量錯誤<br>請重新操作',
                'location' => route('cart.content')
            ];

            echo json_encode($res);
            return;
        }

        Cart::where('member_id', $memberId)->where('id', $cart_id)->update([
            'amount' => $amount
        ]);

        $res = [
            'status' => 'success',
            'message' => ''
        ];

        echo json_encode($res);
    }

    public function delete($cartId) {
        if (!MemberAuth::isLoggedIn()) {
            return $this->redirectMemberLogin();
        }

        $memberId = Crypt::decryptString(session('memberId'));

        DB::table('cart')->where('member_id', $memberId)->where('id', $cartId)->delete();

        return view('front.alert', [
            'icon_type' => 'success',
            'message' => '移除購物車成功!',
            'redirect' => route('cart.content')
        ]);
    }

    private function redirectMemberLogin() {
        return view('front.alert', [
            'icon_type' => 'info',
            'message' => '請登入會員!',
            'redirect' => route('member.login_form')
        ]);
    }
}
