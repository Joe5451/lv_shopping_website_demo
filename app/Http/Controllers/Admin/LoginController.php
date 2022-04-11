<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LoginController extends Controller
{
    const ADMIN_ACCOUNT = 'admin';
    const ADMIN_PASSWORD = 'admin';

    public function loginPage(Request $request){

        return view('admin.login');
    }

    public function login(Request $request){
        $account = $request->input('account');
        $password = $request->input('password');

        if ($account == self::ADMIN_ACCOUNT && $password == self::ADMIN_PASSWORD) {
            return view('admin.alert', [
                'icon_type' => 'success',
                'message' => '登入成功!',
                'redirect' => url('admin') . '/news_list'
            ]);
        } else {
            return view('admin.alert', [
                'icon_type' => 'error',
                'message' => '登入失敗!',
                'redirect' => url('admin') . '/login'
            ]);
        }
    }
}
