<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Libraries\MemberAuth;

use App\Models\HeadImg;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\Product;
use App\Models\ProductOption;

class ProductController extends Controller
{
    var $common_data = [];
    
    public function __construct()
    {
        $this->common_data = [
            'menu_id' => 3,
            'head_img' => HeadImg::find(2)
        ];
    }

    // 避免 function list() 的 Symfony 產生 too few arguments to function 錯誤
    public function first_list(Request $request) {
        $data = $this->common_data;
        $data['cart_amount'] = $request->get('cart_amount');
        $data['product_categories'] = ProductCategory::where('display', '1')->orderBy('sequence', 'asc')->get();

        $categoryId = null;
        $subcategoryId = null;

        // 顯示第一個分類及子分類
        if (count($data['product_categories']) > 0) {
            $categoryId = $data['product_categories'][0]->product_category_id;

            if (count($data['product_categories'][0]->product_subcategories) > 0) {
                $subcategoryId = $data['product_categories'][0]->product_subcategories[0]->product_subcategory_id;
            }
        }

        $builder = DB::table('products');
        $builder->where('product_category_id', $categoryId);
        $builder->where('product_subcategory_id', $subcategoryId);
        $builder->where('display', '1');
        $builder->orderBy('sequence', 'asc');
        $data['products'] = $builder->get();

        $data['current_categoryId'] = $categoryId;
        $data['current_subcategoryId'] = $subcategoryId;
        
        return view('front.product_list', $data);
    }
    
    public function list($categoryId = null, $subcategoryId = null, Request $request) {
        $data = $this->common_data;
        $data['cart_amount'] = $request->get('cart_amount');
        $data['product_categories'] = ProductCategory::where('display', '1')->orderBy('sequence', 'asc')->get();

        // 沒有 categoryId 或 subcategoryId 則顯示第一個分類及子分類
        if (is_null($categoryId) && count($data['product_categories']) > 0) {
            $categoryId = $data['product_categories'][0]->product_category_id;

            if (is_null($subcategoryId) && count($data['product_categories'][0]->product_subcategories) > 0) {
                $subcategoryId = $data['product_categories'][0]->product_subcategories[0]->product_subcategory_id;
            }
        }

        $builder = DB::table('products');
        $builder->where('product_category_id', $categoryId);
        $builder->where('product_subcategory_id', $subcategoryId);
        $builder->where('display', '1');
        $builder->orderBy('sequence', 'asc');
        $data['products'] = $builder->get();

        $data['current_categoryId'] = $categoryId;
        $data['current_subcategoryId'] = $subcategoryId;
        
        return view('front.product_list', $data);
    }

    public function content($id, Request $request) {
        $data = $this->common_data;
        $data['cart_amount'] = $request->get('cart_amount');
        $data['product'] = Product::find($id);

        if (is_null($data['product']) || $data['product']->display == '0') die('操作錯誤!');

        $data['is_login'] = MemberAuth::isLoggedIn();

        return view('front.product_content', $data);
    }
}
