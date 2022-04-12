<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\AdminAuth;

class NewsController extends Controller
{
    public function __construct()
    {
        if (!AdminAuth::isLoggedIn()) {
            return redirect(AdminAuth::HOME);
        }
    }
    
    public function list(Request $request) {
        return view('admin.news_list');
    }
}
