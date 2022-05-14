<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeadImg;
use App\Models\Member;

class MemberController extends Controller
{
    var $common_data = [];
    
    public function __construct()
    {
        $this->common_data = [
            'menu_id' => 5,
            'head_img' => HeadImg::find(4)
        ];
    }

    public function login_form() {
        $data = $this->common_data;
        
        return view('front.member_login', $data);
    }

    public function login(Request $request) {
        $data = $request->input();
        unset($data['_token']);

        $existMember = Member::where('email', $data['email'])
        ->where('password', md5($data['password']))
        ->take(1)->get();

        if (count($existMember) == 0) {
            return view('front.alert', [
                'icon_type' => 'info',
                'message' => '帳號或密碼錯誤!',
                'redirect' => route('member_login_form')
            ]);
        }
        

        return view('front.alert', [
            'icon_type' => 'success',
            'message' => '登入成功!',
            'redirect' => route('home')
        ]);
    }

    public function signup_form() {
        $data = $this->common_data;
        
        return view('front.member_signup', $data);
    }

    public function signup(Request $request) {
        $data = $request->input();
        $data['datetime'] = date('Y-m-d H:i:s');
        unset($data['_token']);

        $existMember = Member::where('email', $data['email'])->take(1)->get();

        if (count($existMember) > 0) {
            return view('front.alert', [
                'icon_type' => 'info',
                'message' => 'Email 已存在，請重新註冊!',
                'redirect' => route('member_login_form')
            ]);
        }

        $data['password'] = md5($data['password']);
        
        Member::create($data);

        return view('front.alert', [
            'icon_type' => 'success',
            'message' => '註冊成功!',
            'redirect' => route('member_login_form')
        ]);
    }

    // private function alertAndRedirectList($message = '操作錯誤!', $icon = 'info') {
    //     echo view('admin.alert', [
    //         'icon_type' => $icon,
    //         'message' => $message,
    //         'redirect' => route('admin.news_list')
    //     ]);
    // }
    
}
