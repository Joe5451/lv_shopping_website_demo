<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Gate;
use App\Libraries\AdminAuth;


class LoginController extends Controller
{
    public function loginPage(Request $request){
        return view('admin.login');
    }

    public function login(Request $request){
        $account = $request->input('account'); // admin
        $password = $request->input('password'); // admin123

        AdminAuth::logIn($account, $password);

        if (AdminAuth::isLoggedIn()) {
            return view('admin.alert', [
                'icon_type' => 'success',
                'message' => '登入成功!',
                'redirect' => url('admin') . '/home_slider'
            ]);
        } else {
            return view('admin.alert', [
                'icon_type' => 'error',
                'message' => '登入失敗!',
                'redirect' => url('admin') . '/login'
            ]);
        }
    }

    public function logout() {
        AdminAuth::logOut();
        return redirect(AdminAuth::HOME);
    }
}
