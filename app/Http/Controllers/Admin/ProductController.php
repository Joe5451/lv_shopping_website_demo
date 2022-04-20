<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Libraries\AdminAuth;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductOption;

class ProductController extends Controller
{
    var $main_menu = 'product';
    var $sub_menu = 'product_list';
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
        $data['products'] = Product::orderBy('sequence', 'desc')->get();
        
        return view('admin.product_list', $data);
    }

    public function add_form() {
        $data = $this->head_data;
        $data['product_categories'] = ProductCategory::orderBy('sequence', 'asc')->get();
        
        return view('admin.product_add_form', $data);
    }

    public function add(Request $request) {
        // if (!is_null($request->file('img_src')) && $request->file('img_src')->isValid()) {
        //     $extension = $request->img_src->extension();
        //     $path = $request->img_src->store('images');
        // } else {
        //     $path = '';
        // }
        
        $data = $request->input();
        $option_names = $request->input('option_names');
        $option_sequences = $request->input('option_sequences');
        unset($data['_token']);
        unset($data['option_names']);
        unset($data['option_sequences']);

        // $data['img_src'] = $path;

        if (is_null($data['summary'])) $data['summary'] = '';
        if (is_null($data['content'])) $data['content'] = '';

        $product = Product::create($data);

        $option_index = 0;
        foreach ($option_names as $option_name) {
            ProductOption::create([
                'product_id' => $product->id,
                'option_name' => $option_name,
                'sequence' => $option_sequences[$option_index]
            ]);

            $option_index++;
        }

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => '新增成功!',
            'redirect' => route('admin.product_list')
        ]);
    }

    public function update_form($id) {
        $data = $this->head_data;
        $data['product'] = Product::find($id);
        $data['product_categories'] = ProductCategory::orderBy('sequence', 'asc')->get();
        $data['product_options'] = ProductOption::where('product_id', $id)->orderBy('sequence', 'asc')->get();
        
        return view('admin.product_update_form', $data);
    }

    public function update($id, Request $request) {
        $data = $request->input();
        $option_ids = $request->input('option_ids');
        $option_names = $request->input('option_names');
        $option_sequences = $request->input('option_sequences');
        unset($data['_token']);
        unset($data['option_ids']);
        unset($data['option_names']);
        unset($data['option_sequences']);
        // unset($data['delete_img']);
        
        // $img_src = $request->file('img_src');
        // $delete_img = $request->input('delete_img');

        // if (is_null($img_src) && $delete_img == 'true') {
        //     $data['img_src'] = '';
        // } else if (!is_null($img_src)) {
        //     if ($request->file('img_src')->isValid()) {
        //         $extension = $request->img_src->extension();
        //         $path = $request->img_src->store('images');

        //         $data['img_src'] = $path;
        //     }
        // }

        Product::where('id', $id)
        ->update($data);

        DB::table('product_option')->whereNotIn('option_id', $option_ids)->delete();

        $option_index = 0;
        foreach ($option_ids as $option_id) {
            if ($option_id == 'new') {
                ProductOption::create([
                    'product_id' => $id,
                    'option_name' => $option_names[$option_index],
                    'sequence' => $option_sequences[$option_index]
                ]);
            } else {
                ProductOption::where('option_id', $option_id)
                ->update([
                    'option_name' => $option_names[$option_index],
                    'sequence' => $option_sequences[$option_index]
                ]);
            }

            $option_index++;
        }

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => '更新成功!',
            'redirect' => route('admin.product_update_form', $id)
        ]);
    }

    public function batch_action(Request $request) {
        $data = $request->input();
        $action = $request->input('action');

        if ($action == 'none' || $action == '') {
            $this->errorAndRedirectList();
        }

        switch ($action) {
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
            'redirect' => route('admin.product_list')
        ]);
    }

    private function batch_display_update($display, $request) {
        $ids = $request->input('checked_ids');

        if (is_null($ids)) {
            $this->alertAndRedirectList('未勾選項目!', 'warning');
            return false;
        }
        
        Product::whereIn('id', $ids)
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

        Product::whereIn('id', $ids)->delete();

        return true;
    }

    private function alertAndRedirectList($message = '操作錯誤!', $icon = 'info') {
        echo view('admin.alert', [
            'icon_type' => $icon,
            'message' => $message,
            'redirect' => route('admin.product_list')
        ]);
    }
    
}
