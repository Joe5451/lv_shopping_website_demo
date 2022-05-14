<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\HomeSlider;

class HomeSliderController extends Controller
{
    var $main_menu = 'home';
    var $sub_menu = 'home_slider';
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
        $data['sliders'] = HomeSlider::orderBy('sequence', 'asc')->get();
        
        return view('admin.home_slider', $data);
    }

    public function add(Request $request) {
        if (!is_null($request->file('img_src')) && $request->file('img_src')->isValid()) {
            $extension = $request->img_src->extension();
            $path = $request->img_src->store('images');
        } else {
            $path = '';
        }
        
        $data = $request->input();
        unset($data['_token']);

        $data['img_src'] = $path;

        // if (is_null($data['href'])) $data['href'] = ''; // 已修改空字串轉為 null 的 middleware

        HomeSlider::create($data);

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => '新增成功!',
            'redirect' => route('admin.home_slider')
        ]);
    }

    public function update_form($id) {
        $data = $this->head_data;
        $data['slider'] = HomeSlider::find($id);

        return view('admin.home_slider_update_form', $data);
    }

    public function update($id, Request $request) {
        $data = $request->input();
        unset($data['_token']);
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

        HomeSlider::where('id', $id)->update($data);

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => '更新成功!',
            'redirect' => route('admin.home_slider_update_form', $id)
        ]);
    }

    public function batch_action(Request $request) {
        $data = $request->input();
        $action = $request->input('action');

        if ($action == 'none' || $action == '') {
            $this->errorAndRedirectList();
        }

        switch ($action) {
            case 'update':
                $result = $this->batch_update($request);
                $action_message = '批次更新';
                break;
            default:
        }

        if (!$result) return;

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => $action_message . '成功!',
            'redirect' => route('admin.home_slider')
        ]);
    }

    function batch_update($request) {
        $data = $request->input();

        $ids = $data['ids'];
        $hrefs = $data['hrefs'];
        $sequences = $data['sequences'];

        $index = 0;
        foreach ($ids as $id) {
            $validator = Validator::make([
                'sequence' => $sequences[$index],
            ],
            [
                'sequence' => 'required|integer',
            ]);

            if (!$validator->fails()) {
                HomeSlider::where('id', $id)
                ->update([
                    'href' => $hrefs[$index],
                    'sequence' => $sequences[$index]
                ]);
            }
            
            $index++;
        }

        return true;
    }

    public function delete($id, Request $request) {
        HomeSlider::where('id', $id)->delete();

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => '刪除成功!',
            'redirect' => route('admin.home_slider')
        ]);
    }

    // private function batch_delete($request) {
    //     $ids = $request->input('checked_ids');

    //     if (is_null($ids)) {
    //         $this->alertAndRedirectList('未勾選項目!', 'warning');
    //         return false;
    //     }

    //     News::whereIn('id', $ids)->delete();

    //     return true;
    // }

    // private function alertAndRedirectList($message = '操作錯誤!', $icon = 'info') {
    //     echo view('admin.alert', [
    //         'icon_type' => $icon,
    //         'message' => $message,
    //         'redirect' => route('admin.news_list')
    //     ]);
    // }
    
}
