<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\AdminAuth;

class NewsController extends Controller
{
    var $main_menu = 'news';
    var $sub_menu = 'news_list';
    
    public function __construct()
    {
        if (!AdminAuth::isLoggedIn()) {
            return redirect(AdminAuth::HOME);
        }
    }
    
    public function list(Request $request) {

        $data = [
            'main_menu' => $this->main_menu,
            'sub_menu' => $this->sub_menu,
        ];
        
        return view('admin.news_list', $data);
    }

    public function add_form() {

    }

    public function update_form() {
        
    }
}
