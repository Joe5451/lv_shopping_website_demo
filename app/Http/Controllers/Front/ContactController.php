<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\AdminAuth;
use App\Models\HeadImg;

class ContactController extends Controller
{
    var $head_data = [];
    
    public function __construct()
    {
        $this->head_data = [];
    }

    public function contact_form() {
        $data = $this->head_data;
        $data['head_img'] = HeadImg::find(3);
        $data['menu_id'] = 4;
        
        return view('front.contact', $data);
    }
    
    // private function alertAndRedirectList($message = '操作錯誤!', $icon = 'info') {
    //     echo view('admin.alert', [
    //         'icon_type' => $icon,
    //         'message' => $message,
    //         'redirect' => route('admin.news_list')
    //     ]);
    // }
    
}
