<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeadImg;
use App\Models\ProductCategory;
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
    
    public function list(Request $request) {
        $data = $this->common_data;
        // $data['products'] = News::orderBy('date', 'desc')->get();
        // $data['product_categories'] = ProductCategory::orderBy('sequence', 'asc')->get();
        
        return view('front.product_list', $data);
    }

    public function content($id, Request $request) {
        $data = $this->common_data;
        // $data['products'] = News::orderBy('date', 'desc')->get();
        // $data['product_categories'] = ProductCategory::orderBy('sequence', 'asc')->get();
        
        return view('front.product_content', $data);
    }
}
