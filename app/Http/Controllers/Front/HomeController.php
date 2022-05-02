<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\AdminAuth;
// use App\Models\NewsCategory;
use App\Models\News;

class HomeController extends Controller
{
    // var $main_menu = 'news';
    // var $sub_menu = 'news_list';
    var $head_data = [];
    
    public function __construct()
    {
        $this->head_data = [
            // 'main_menu' => $this->main_menu,
            // 'sub_menu' => $this->sub_menu,
        ];
    }

    public function home() {
        $data = $this->head_data;
        $data['news'] = News::orderBy('date', 'desc')->get();
        
        return view('front.home', $data);
    }
    
    private function alertAndRedirectList($message = '操作錯誤!', $icon = 'info') {
        echo view('admin.alert', [
            'icon_type' => $icon,
            'message' => $message,
            'redirect' => route('admin.news_list')
        ]);
    }
    
}
