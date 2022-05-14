<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;

class ProductCategoryController extends Controller
{
    var $main_menu = 'product';
    var $sub_menu = 'product_category';
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
        $data['product_categories'] = ProductCategory::orderBy('sequence', 'asc')->get();

        return view('admin.product_category_list', $data);
    }

    public function add_form() {
        $data = $this->head_data;
        
        return view('admin.product_category_add_form', $data);
    }

    public function add(Request $request) {
        $data = $request->input();
        $subcategory_names = $request->input('subcategory_names');
        $subcategory_displays = $request->input('subcategory_displays');
        $subcategory_sequences = $request->input('subcategory_sequences');
        unset($data['_token']);
        unset($data['subcategory_names']);
        unset($data['subcategory_displays']);
        unset($data['subcategory_sequences']);

        $product_category = ProductCategory::create($data);

        $index = 0;
        if (!is_null($subcategory_names)) {
            foreach ($subcategory_names as $subcategory_name) {
                ProductSubCategory::create([
                    'category_id' => $product_category->product_category_id,
                    'subcategory_name' => $subcategory_name,
                    'display' => $subcategory_displays[$index],
                    'sequence' => $subcategory_sequences[$index]
                ]);
    
                $index++;
            }
        }

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => '新增成功!',
            'redirect' => route('admin.product_category_list')
        ]);
    }

    public function update_form($id) {
        $data = $this->head_data;
        $data['category'] = ProductCategory::find($id);
        
        return view('admin.product_category_update_form', $data);
    }

    public function update($id, Request $request) {
        $data = $request->input();
        $subcategory_ids = $request->input('subcategory_ids');
        $subcategory_names = $request->input('subcategory_names');
        $subcategory_displays = $request->input('subcategory_displays');
        $subcategory_sequences = $request->input('subcategory_sequences');
        unset($data['_token']);
        unset($data['subcategory_ids']);
        unset($data['subcategory_names']);
        unset($data['subcategory_displays']);
        unset($data['subcategory_sequences']);

        ProductCategory::where('product_category_id', $id)->update($data);

        $index = 0;
        if (!is_null($subcategory_ids)) {
            DB::table('product_subcategory')->whereNotIn('product_subcategory_id', $subcategory_ids)->delete();

            foreach ($subcategory_ids as $subcategory_id) {
                if ($subcategory_id == 'new') {
                    ProductSubcategory::create([
                        'category_id' => $id,
                        'subcategory_name' => $subcategory_names[$index],
                        'display' => $subcategory_displays[$index],
                        'sequence' => $subcategory_sequences[$index]
                    ]);
                } else {
                    ProductSubcategory::where('product_subcategory_id', $subcategory_id)
                    ->update([
                        'subcategory_name' => $subcategory_names[$index],
                        'display' => $subcategory_displays[$index],
                        'sequence' => $subcategory_sequences[$index]
                    ]);
                }

                $index++;
            }
        } else {
            DB::table('product_subcategory')->where('category_id', $id)->delete();
        }

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => '更新成功!',
            'redirect' => route('admin.product_category_update_form', $id)
        ]);
    }

    public function delete($id, Request $request) {
        ProductCategory::where('product_category_id', $id)->delete();
        ProductSubCategory::where('category_id', $id)->delete();
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
            'redirect' => route('admin.product_category_list')
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
                ProductCategory::where('product_category_id', $id)
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

        ProductCategory::whereIn('product_category_id', $ids)
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

        ProductCategory::whereIn('product_category_id', $ids)->delete();
        ProductSubCategory::whereIn('category_id', $ids)->delete();

        return true;
    }

    private function alertAndRedirectList($message = '操作錯誤!', $icon = 'info') {
        echo view('admin.alert', [
            'icon_type' => $icon,
            'message' => $message,
            'redirect' => route('admin.product_category_list')
        ]);
    }
}
