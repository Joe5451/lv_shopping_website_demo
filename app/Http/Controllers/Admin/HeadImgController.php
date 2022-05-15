<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\HeadImg;

class HeadImgController extends Controller
{
    var $main_menu = 'head_img';
    var $sub_menu = 'head_img_list';
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
        $data['head_imgs'] = HeadImg::get();
        
        return view('admin.head_img_list', $data);
    }

    public function update_form($id) {
        $data = $this->head_data;
        $data['head_img'] = HeadImg::find($id);

        return view('admin.head_img_update_form', $data);
    }

    public function update($id, Request $request) {
        $data = $request->input();
        unset($data['_token']);
        
        $img_src = $request->file('img_src');

        if (!is_null($img_src)) {
            if ($request->file('img_src')->isValid()) {
                $extension = $request->img_src->extension();
                $path = $request->img_src->store('images');

                $data['img_src'] = $path;
            }
        }

        HeadImg::where('id', $id)->update($data);

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => '更新成功!',
            'redirect' => route('admin.head_img_update_form', $id)
        ]);
    }

    public function batch_action(Request $request) {
        $data = $request->input();
        $action = $request->input('action');

        if ($action == 'none' || $action == '') {
            $this->alertAndRedirectList();
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
            'redirect' => route('admin.head_img')
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
                HeadImg::where('id', $id)
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
        HeadImg::where('id', $id)->delete();

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => '刪除成功!',
            'redirect' => route('admin.head_img')
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

    private function alertAndRedirectList($message = '操作錯誤!', $icon = 'info') {
        echo view('admin.alert', [
            'icon_type' => $icon,
            'message' => $message,
            'redirect' => route('admin.head_img')
        ]);
    }
    
}
