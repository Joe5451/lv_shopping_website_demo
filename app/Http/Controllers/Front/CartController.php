<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Crypt;

use App\Libraries\MemberAuth;

use App\Models\Cart;

use App\Models\HeadImg;
// use App\Models\ProductCategory;
// use App\Models\ProductSubCategory;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\Member;

class CartController extends Controller
{
    var $common_data = [];
    
    public function __construct()
    {
        
        
        $this->common_data = [
            'menu_id' => 6,
            'head_img' => HeadImg::find(2),
            // 'cart_amount' => $this->getCartAmount()
        ];
    }

    private function getCartAmount() {
        // $memberId = session('memberId');
        // $this->middleware(function ($request, $next) {
        //     $memberId = Session::get('memberId');
        //     die(var_dump($memberId));
        // });


        // $memberId = Session::get('memberId');
        $memberId = session('memberId');
        // $memberId = $session->get('memberId');

        die(var_dump($memberId));
        
        if (MemberAuth::isLoggedIn()) {
            $memberId = Crypt::decryptString(session('memberId'));
            $amount = Cart::where('member_id', $memberId)->count();
        } else {
            $amount = 0;
        }

        return $amount;
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

    public function content() {
        if (!MemberAuth::isLoggedIn()) {
            return $this->redirectMemberLogin();
        }

        $memberId = Crypt::decryptString(session('memberId'));
        
        $data = $this->common_data;
        $data['member'] = Member::find($memberId);
        $data['cart_products'] = Cart::where('member_id', $memberId)->get();

        return view('front.cart', $data);
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

    // public function content($id, Request $request) {
    //     $data = $this->common_data;
    //     $data['product'] = Product::find($id);

    //     if (is_null($data['product']) || $data['product']->display == '0') die('操作錯誤!');

    //     $data['is_login'] = MemberAuth::isLoggedIn();
        
    //     // $data['products'] = News::orderBy('date', 'desc')->get();
    //     // $data['product_categories'] = ProductCategory::orderBy('sequence', 'asc')->get();

    //     return view('front.product_content', $data);
    // }
}
