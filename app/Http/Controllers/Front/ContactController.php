<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeadImg;
use App\Models\Contact;

class ContactController extends Controller
{
    var $head_data = [];
    
    public function __construct()
    {
        $this->head_data = [];
    }

    public function contact_form(Request $request) {
        $data = $this->head_data;
        $data['cart_amount'] = $request->get('cart_amount');
        $data['head_img'] = HeadImg::find(3);
        $data['menu_id'] = 4;
        
        return view('front.contact', $data);
    }

    public function add(Request $request) {
        $data = $request->input();
        $data['datetime'] = date('Y-m-d H:i:s');
        unset($data['_token']);

        Contact::create($data);

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => '發送成功!',
            'redirect' => route('home')
        ]);
    }
}
