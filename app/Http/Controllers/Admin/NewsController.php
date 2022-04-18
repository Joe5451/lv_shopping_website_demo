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
        if ($request->file('img_src')->isValid()) {
            $extension = $request->img_src->extension();
            $path = $request->img_src->store('images');
        }
        
        $data = $request->input();
        unset($data['_token']);

        $data['img_src'] = $path;

        News::create($data);

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => '新增成功!',
            'redirect' => route('admin.news_list')
        ]);
    }

    public function update_form($id) {
        $data = $this->head_data;
        $data['new'] = News::find($id);
        $data['news_categories'] = NewsCategory::orderBy('sequence', 'asc')->get();
        
        return view('admin.news_update_form', $data);
    }

    public function update(Request $request) {
        $data = $request->input();
        $id = $request->input('id');
        unset($data['_token']);
        unset($data['id']);
        unset($data['delete_img']);
        
        $img_src = $request->file('img_src');
        $delete_img = $request->input('delete_img');

        if (is_null($img_src) && $delete_img == 'true') {
            $data['img_src'] = '';
        } else if (!is_null($img_src)) {
            if ($request->file('img_src')->isValid()) {
                $extension = $request->img_src->extension();
                $path = $request->img_src->store('images');

                $data['img_src'] = $path;
            }
        }

        News::where('id', $id)
        ->update($data);

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => '更新成功!',
            'redirect' => route('admin.news_update_form', $id)
        ]);
    }
}
