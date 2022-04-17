<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\AdminAuth;
use App\Models\NewsCategory;
use App\Models\News;

class NewsController extends Controller
{
    var $main_menu = 'news';
    var $sub_menu = 'news_list';
    var $head_data = [];
    
    public function __construct()
    {
        $this->head_data = [
            'main_menu' => $this->main_menu,
            'sub_menu' => $this->sub_menu,
        ];
    }
    
    public function list(Request $request) {
        $data = $this->head_data;
        $data['news'] = News::orderBy('date', 'desc')->get();
        
        return view('admin.news_list', $data);
    }

    public function add_form() {
        $data = $this->head_data;
        $data['news_categories'] = NewsCategory::orderBy('sequence', 'asc')->get();
        
        return view('admin.news_add_form', $data);
    }

    public function add(Request $request) {
        $data = $request->input();
        unset($data['_token']);

        News::create($data);

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => '新增成功!',
            'redirect' => route('admin.news_list')
        ]);
    }

    public function update_form() {
        $data = $this->head_data;
        
        return view('admin.news_update_form', $data);
    }
}
