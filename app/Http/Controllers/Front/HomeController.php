<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlider;
use App\Models\News;
use App\Models\Product;

class HomeController extends Controller
{
    var $head_data = [];
    
    public function __construct()
    {
        $this->head_data = [];
    }

    public function home(Request $request) {
        $data = $this->head_data;
        $data['cart_amount'] = $request->get('cart_amount');
        $data['sliders'] = HomeSlider::orderBy('sequence', 'asc')->get();
        $data['news'] = News::orderBy('date', 'desc')->get();
        $data['products'] = Product::where('display', 1)->orderBy('sequence', 'asc')->take(10)->get();
        $data['menu_id'] = 1;
        
        return view('front.home', $data);
    }
}
