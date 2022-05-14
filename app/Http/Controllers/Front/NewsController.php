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
        $data['news'] = News::orderBy('date', 'desc')->get();
        $data['news_categories'] = NewsCategory::orderBy('sequence', 'asc')->get();
        
        return view('front.news_list', $data);
    }
}
