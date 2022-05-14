<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\NewsCategory;

class NewsCategoryController extends Controller
{
    var $main_menu = 'news';
    var $sub_menu = 'news_category';
    var $head_data = [];
    
    public function __construct()
    {
        $this->head_data = [
            'main_menu' => $this->main_menu,
            'sub_menu' => $this->sub_menu,
        ];
    }
    
    public function list() {
        $data = $this->head_data;
        $data['news_categories'] = NewsCategory::orderBy('sequence', 'asc')->get();

        return view('admin.news_category_list', $data);
    }

    public function add_form() {
        $data = $this->head_data;
        
        return view('admin.news_category_add_form', $data);
    }

    public function add(Request $request) {
        $data = $request->input();
        unset($data['_token']);

        NewsCategory::create($data);

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => '新增成功!',
            'redirect' => route('admin.news_category_list')
        ]);
    }

    public function delete($id, Request $request) {
        NewsCategory::where('news_category_id', $id)->delete();
        return $this->alertAndRedirectList('刪除成功', 'success');
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
            case 'display_on':
                $result = $this->batch_display_update(1, $request);
                $action_message = '顯示';
                break;
            case 'display_off':
                $result = $this->batch_display_update(0, $request);
                $action_message = '隱藏';
                break;
            case 'delete':
                $result = $this->batch_delete($request);
                $action_message = '刪除';
                break;
            default:
        }

        if (!$result) return;

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => $action_message . '成功!',
            'redirect' => route('admin.news_category_list')
        ]);
    }

    function batch_update($request) {
        $data = $request->input();

        $ids = $data['ids'];
        $category_names = $data['category_names'];
        $sequences = $data['sequences'];

        $index = 0;
        foreach ($ids as $id) {
            $validator = Validator::make([
                'category_name' => $category_names[$index],
                'sequence' => $sequences[$index],
            ],
            [
                'category_name' => 'required|string',
                'sequence' => 'required|integer',
            ]);

            if (!$validator->fails()) {
                NewsCategory::where('news_category_id', $id)
                ->update([
                    'category_name' => $category_names[$index],
                    'sequence' => $sequences[$index]
                ]);
            }
            
            $index++;
        }

        return true;
    }

    private function batch_display_update($display, $request) {
        $ids = $request->input('checked_ids');

        if (is_null($ids)) {
            $this->alertAndRedirectList('未勾選項目!', 'warning');
            return false;
        }

        NewsCategory::whereIn('news_category_id', $ids)
        ->update([
            'display' => $display
        ]);

        return true;
    }

    private function batch_delete($request) {
        $ids = $request->input('checked_ids');

        if (is_null($ids)) {
            $this->alertAndRedirectList('未勾選項目!', 'warning');
            return false;
        }

        NewsCategory::whereIn('news_category_id', $ids)->delete();

        return true;
    }

    private function alertAndRedirectList($message = '操作錯誤!', $icon = 'info') {
        echo view('admin.alert', [
            'icon_type' => $icon,
            'message' => $message,
            'redirect' => route('admin.news_category_list')
        ]);
    }
}
