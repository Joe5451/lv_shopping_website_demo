<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductImg;

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
        $data['products'] = Product::orderBy('sequence', 'asc')->get();
        
        return view('admin.product_list', $data);
    }

    public function add_form() {
        $data = $this->head_data;
        $data['product_categories'] = ProductCategory::orderBy('sequence', 'asc')->get();
        
        return view('admin.product_add_form', $data);
    }

    public function get_product_subcategories(Request $request) {
        $categoryId = $request->input('categoryId');

        $subcategories = DB::table('product_subcategory')->where('category_id', $categoryId)->get();

        $options_html = '<option value="none">無</option>';

        foreach ($subcategories as $subcategory) {
            $options_html .= '<option value="' . $subcategory->product_subcategory_id . '">' . $subcategory->subcategory_name . '</option>';
        }

        echo $options_html;
    }

    public function add(Request $request) {
        if (!is_null($request->file('img_src')) && $request->file('img_src')->isValid()) {
            $extension = $request->img_src->extension();
            $path = $request->img_src->store('images');
        } else {
            $path = '';
        }
        
        $data = $request->input();
        $option_names = $request->input('option_names');
        $option_sequences = $request->input('option_sequences');
        unset($data['_token']);
        unset($data['option_names']);
        unset($data['option_sequences']);

        $data['img_src'] = $path;

        // if (is_null($data['summary'])) $data['summary'] = '';
        // if (is_null($data['content'])) $data['content'] = '';

        $product = Product::create($data);

        $option_index = 0;
        if (!is_null($option_names)) {
            foreach ($option_names as $option_name) {
                ProductOption::create([
                    'product_id' => $product->id,
                    'option_name' => $option_name,
                    'sequence' => $option_sequences[$option_index]
                ]);
    
                $option_index++;
            }
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
        $data['subcategory_options'] = $this->get_product_subcategory_options($data['product']->product_category_id);
        
        return view('admin.product_update_form', $data);
    }

    private function get_product_subcategory_options($categoryId) {
        $subcategories = DB::table('product_subcategory')->where('category_id', $categoryId)->get();

        $options_html = '<option value="none">無</option>';

        foreach ($subcategories as $subcategory) {
            $options_html .= '<option value="' . $subcategory->product_subcategory_id . '">' . $subcategory->subcategory_name . '</option>';
        }

        return $options_html;
    }

    public function update($id, Request $request) {
        $data = $request->input();

        // $product_column = ['product_name', 'product_category_id', 'product_subcategory_id', 'display', 'price', 'sequence', 'summary', 'content'];
        // foreach ($data as $key => $value) {
        //     if (!in_array($key, $product_column)) {
        //         unset($data[$key]);
        //     }
        // }

        unset($data['_token']);
        unset($data['delete_img']);

        // 規格
        $option_ids = $request->input('option_ids');
        $option_names = $request->input('option_names');
        $option_sequences = $request->input('option_sequences');
        unset($data['option_ids']);
        unset($data['option_names']);
        unset($data['option_sequences']);
        
        // 商品圖片
        $img_ids = $request->input('secondary_img_ids');
        $img_indexes = $request->input('secondary_img_indexes');
        $img_change = $request->input('secondary_img_change');
        $img_sequences = $request->input('secondary_img_sequences');
        unset($data['secondary_img_ids']);
        unset($data['secondary_img_indexes']);
        unset($data['secondary_img_change']);
        unset($data['secondary_img_sequences']);

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

        Product::where('id', $id)->update($data);

        // 商品圖片
        // $product_img_srcs = [];
        // if (!is_null($img_srcs)) {
        //     foreach ($request->secondary_img_srcs as $product_img_src) {
        //         if ($product_img_src->isValid()) {
        //             // $extension = $product_img_src->extension();
        //             $path = $product_img_src->store('images');

        //             $product_img_srcs[] = $path;
        //         } else {
        //             $product_img_srcs[] = '';
        //         }
        //     }
        // }
        
        if (!is_null($img_ids)) {
            DB::table('product_img')->where('product_id', $id)->whereNotIn('id', $img_ids)->delete();

            $index = 0;
            foreach ($img_ids as $img_id) {
                $img_data = [
                    'product_id' => $id,
                    'sequence' => $img_sequences[$index]
                ];
                
                if ($img_change[$index] == 'true') { // 新檔案
                    $file_name = 'secondary_img_' . $img_indexes[$index];
                    $img_file = $request->file($file_name);

                    if (!is_null($img_file) && $img_file->isValid()) {
                        $path = $img_file->store('images');
        
                        $img_data['src'] = $path;
                    }
                }

                if ($img_id == 'new') {
                    ProductImg::create($img_data);
                } else {
                    ProductImg::where('id', $img_id)->update($img_data);
                }

                $index++;
            }
        } else { // 刪除所有商品圖片
            DB::table('product_img')->where('product_id', $id)->delete();
        }

        // 商品規格
        $option_index = 0;
        if (!is_null($option_ids)) {
            DB::table('product_option')->where('product_id', $id)->whereNotIn('option_id', $option_ids)->delete();

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
        } else {
            DB::table('product_option')->where('product_id', $id)->delete();
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
