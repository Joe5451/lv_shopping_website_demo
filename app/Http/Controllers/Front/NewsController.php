<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\AdminAuth;
use App\Models\HeadImg;
use App\Models\NewsCategory;
use App\Models\News;

class NewsController extends Controller
{
    var $head_data = [];
    
    public function __construct()
    {
        $this->head_data = [];
    }
    
    public function list(Request $request) {
        $data = $this->head_data;
        $data['head_img'] = HeadImg::find(1);
        $data['news'] = News::orderBy('date', 'desc')->get();
        $data['news_categories'] = NewsCategory::orderBy('sequence', 'asc')->get();
        $data['menu_id'] = 2;
        
        return view('front.news_list', $data);
    }
}
