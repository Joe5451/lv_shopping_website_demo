<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryFee;

class DeliveryFeeController extends Controller
{
    var $main_menu = 'order';
    var $sub_menu = 'delivery_fee';
    var $head_data = [];
    
    public function __construct()
    {
        $this->head_data = [
            'main_menu' => $this->main_menu,
            'sub_menu' => $this->sub_menu,
        ];
    }

    public function update_form() {
        $data = $this->head_data;
        $data['delivery_fee'] = DeliveryFee::find(1);
        
        return view('admin.delivery_fee_update_form', $data);
    }

    public function update(Request $request) {
        $data = $request->input();
        unset($data['_token']);

        DeliveryFee::where('id', 1)->update($data);

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => '更新成功!',
            'redirect' => route('admin.delivery_fee_update_form')
        ]);
    }

    private function alertAndRedirectList($message = '操作錯誤!', $icon = 'info') {
        echo view('admin.alert', [
            'icon_type' => $icon,
            'message' => $message,
            'redirect' => route('admin.delivery_fee_update_form')
        ]);
    }
    
}
