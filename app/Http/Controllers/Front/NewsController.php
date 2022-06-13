<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeadImg;
use App\Models\NewsCategory;
use App\Models\News;

class NewsController extends Controller
{
    var $common_data = [];
    
    public function __construct()
    {
        $this->common_data = [
            'menu_id' => 2,
            'head_img' => HeadImg::find(1)
        ];
    }
    
    public function list(Request $request) {
        $data = $this->common_data;
        $data['cart_amount'] = $request->get('cart_amount');
        $data['news'] = News::orderBy('date', 'desc')->get();
        $data['news_categories'] = NewsCategory::orderBy('sequence', 'asc')->get();
        
        return view('front.news_list', $data);
    }

    public function content($id, Request $request) {
        $data = $this->common_data;
        $data['cart_amount'] = $request->get('cart_amount');
        $data['new'] = News::find($id);

        if (is_null($data['new']) || $data['new']->display == '0') die('操作錯誤!');

        return view('front.news_content', $data);
    }
}
