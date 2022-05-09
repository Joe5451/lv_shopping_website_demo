<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\AdminAuth;
use App\Models\HomeSlider;
use App\Models\News;

class HomeController extends Controller
{
    var $head_data = [];
    
    public function __construct()
    {
        $this->head_data = [];
    }

    public function home() {
        $data = $this->head_data;
        $data['sliders'] = HomeSlider::orderBy('sequence', 'asc')->get();
        $data['news'] = News::orderBy('date', 'desc')->get();
        $data['menu_id'] = 1;
        
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
