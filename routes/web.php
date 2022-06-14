<?php

// Admin
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\HomeSliderController as AdminHomeSliderController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\NewsCategoryController as AdminNewsCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductCategoryController as AdminProductCategoryController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\HeadImgController as AdminHeadImgController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\DeliveryFeeController as AdminDeliveryFeeController;

// Front
use App\Http\Controllers\Front\HomeController as HomeController;
use App\Http\Controllers\Front\NewsController as NewsController;
use App\Http\Controllers\Front\ContactController as ContactController;
use App\Http\Controllers\Front\MemberController as MemberController;
use App\Http\Controllers\Front\ProductController as ProductController;
use App\Http\Controllers\Front\CartController as CartController;
use App\Http\Controllers\Front\OrderController as OrderController;

// Common
use App\Http\Controllers\AddressController as AddressController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 連結強制 https
URL::forceScheme('https');

// Common
Route::prefix('address')->post('/getTown', [AddressController::class, 'getTown'])->name('get_town');

// Front
Route::middleware(['cart.amount'])->get('/', [HomeController::class, 'home'])->name('home');

// 最新消息
Route::prefix('news')->middleware(['cart.amount'])->name('news.')->group(function () {
    Route::get('/list', [NewsController::class, 'list'])->name('list');
    Route::get('/content/{id}', [NewsController::class, 'content'])->name('content');
});

// 聯絡我們
Route::middleware(['cart.amount'])->get('/contact', [ContactController::class, 'contact_form'])->name('contact');
Route::prefix('contact')->post('/add', [ContactController::class, 'add'])->name('contact_add');

// 會員註冊&登入
Route::prefix('member')->middleware(['cart.amount'])->name('member.')->group(function () {
    Route::get('/login', [MemberController::class, 'login_form'])->name('login_form');
    Route::post('/login', [MemberController::class, 'login'])->name('login');
    Route::get('/signup', [MemberController::class, 'signup_form'])->name('signup_form');
    Route::post('/signup', [MemberController::class, 'signup'])->name('signup');
    Route::get('/logout', [MemberController::class, 'logout'])->name('logout');
});

// 會員中心
Route::prefix('member')->name('member.')->middleware(['member.auth', 'cart.amount'])->group(function () {
    Route::get('/update_form', [MemberController::class, 'update_form'])->name('update_form');
    Route::post('/update', [MemberController::class, 'update'])->name('update');
    Route::get('/order_list', [MemberController::class, 'order_list'])->name('order_list');
});

// 購物商城
Route::prefix('product')->middleware(['cart.amount'])->name('product.')->group(function () {
    Route::get('/list', [ProductController::class, 'first_list'])->name('first_list');
    Route::get('/list/{categoryId?}/{subcategoryId?}', [ProductController::class, 'list'])->name('list');
    Route::get('/content/{id}', [ProductController::class, 'content'])->name('content');
});

// 購物車
Route::prefix('cart')->middleware(['cart.amount'])->name('cart.')->group(function () {
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::get('/content', [CartController::class, 'content'])->name('content');
    Route::post('/update_cart_amount', [CartController::class, 'update_cart_amount'])->name('update_amount');
    Route::get('/delete/{cartId}', [CartController::class, 'delete'])->name('delete');
});

// 訂單
Route::prefix('order')->name('order.')->post('/create', [OrderController::class, 'create'])->name('create');

// Admin
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/login', [AdminLoginController::class, 'loginPage'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);
});

Route::prefix('admin')->name('admin.')->middleware(['admin.auth'])->group(function () {
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::get('/home_slider', [AdminHomeSliderController::class, 'list'])->name('home_slider');
    Route::post('/home_slider_add', [AdminHomeSliderController::class, 'add'])->name('home_slider_add');
    Route::get('/home_slider_update_form/{id}', [AdminHomeSliderController::class, 'update_form'])->name('home_slider_update_form');
    Route::post('/home_slider_update/{id}', [AdminHomeSliderController::class, 'update'])->name('home_slider_update');
    Route::post('/home_slider_batch_action', [AdminHomeSliderController::class, 'batch_action'])->name('home_slider_batch_action');
    Route::get('/home_slider_delete/{id}', [AdminHomeSliderController::class, 'delete'])->name('home_slider_delete');

    Route::get('/news_list', [AdminNewsController::class, 'list'])->name('news_list');
    Route::get('/news_add_form', [AdminNewsController::class, 'add_form'])->name('news_add_form');
    Route::get('/news_update_form/{id}', [AdminNewsController::class, 'update_form'])->name('news_update_form');
    Route::post('/news_add', [AdminNewsController::class, 'add'])->name('news_add');
    Route::post('/news_update', [AdminNewsController::class, 'update'])->name('news_update');
    Route::post('/news_batch_action', [AdminNewsController::class, 'batch_action'])->name('news_batch_action');
    
    Route::get('/news_category_list', [AdminNewsCategoryController::class, 'list'])->name('news_category_list');
    Route::get('/news_category_add_form', [AdminNewsCategoryController::class, 'add_form'])->name('news_category_add_form');
    Route::post('/news_category_add', [AdminNewsCategoryController::class, 'add'])->name('news_category_add');
    Route::post('/news_category_batch_action', [AdminNewsCategoryController::class, 'batch_action'])->name('news_category_batch_action');
    Route::get('/news_category_delete/{id}', [AdminNewsCategoryController::class, 'delete'])->name('news_category_delete');

    Route::get('/product_list', [AdminProductController::class, 'list'])->name('product_list');
    Route::get('/product_add_form', [AdminProductController::class, 'add_form'])->name('product_add_form');
    Route::get('/product_update_form/{id}', [AdminProductController::class, 'update_form'])->name('product_update_form');
    Route::post('/product_add', [AdminProductController::class, 'add'])->name('product_add');
    Route::post('/product_update/{id}', [AdminProductController::class, 'update'])->name('product_update');
    Route::post('/product_batch_action', [AdminProductController::class, 'batch_action'])->name('product_batch_action');
    Route::post('/get_product_subcategories', [AdminProductController::class, 'get_product_subcategories'])->name('get_product_subcategories');

    Route::get('/product_category_list', [AdminProductCategoryController::class, 'list'])->name('product_category_list');
    Route::get('/product_category_add_form', [AdminProductCategoryController::class, 'add_form'])->name('product_category_add_form');
    Route::post('/product_category_add', [AdminProductCategoryController::class, 'add'])->name('product_category_add');
    Route::get('/product_category_update_form/{id}', [AdminProductCategoryController::class, 'update_form'])->name('product_category_update_form');
    Route::post('/product_category_update/{id}', [AdminProductCategoryController::class, 'update'])->name('product_category_update');
    Route::post('/product_category_batch_action', [AdminProductCategoryController::class, 'batch_action'])->name('product_category_batch_action');
    Route::get('/product_category_delete/{id}', [AdminProductCategoryController::class, 'delete'])->name('product_category_delete');

    Route::get('/contact_list', [AdminContactController::class, 'list'])->name('contact_list');
    Route::get('/contact_update_form/{id}', [AdminContactController::class, 'update_form'])->name('contact_update_form');
    Route::post('/contact_update/{id}', [AdminContactController::class, 'update'])->name('contact_update');
    Route::post('/contact_batch_action', [AdminContactController::class, 'batch_action'])->name('contact_batch_action');

    Route::get('/member_list', [AdminMemberController::class, 'list'])->name('member_list');
    Route::get('/member_add_form', [AdminMemberController::class, 'add_form'])->name('member_add_form');
    Route::get('/member_update_form/{id}', [AdminMemberController::class, 'update_form'])->name('member_update_form');
    Route::post('/member_add', [AdminMemberController::class, 'add'])->name('member_add');
    Route::post('/member_update/{id}', [AdminMemberController::class, 'update'])->name('member_update');
    Route::post('/member_batch_action', [AdminMemberController::class, 'batch_action'])->name('member_batch_action');

    Route::get('/order_list', [AdminOrderController::class, 'list'])->name('order_list');
    Route::get('/order_update_form/{id}', [AdminOrderController::class, 'update_form'])->name('order_update_form');
    Route::post('/order_update/{id}', [AdminOrderController::class, 'update'])->name('order_update');

    Route::get('/delivery_fee_update_form', [AdminDeliveryFeeController::class, 'update_form'])->name('delivery_fee_update_form');
    Route::post('/delivery_fee_update', [AdminDeliveryFeeController::class, 'update'])->name('delivery_fee_update');

    Route::get('/head_img_list', [AdminHeadImgController::class, 'list'])->name('head_img_list');
    Route::get('/head_img_update_form/{id}', [AdminHeadImgController::class, 'update_form'])->name('head_img_update_form');
    Route::post('/head_img_update/{id}', [AdminHeadImgController::class, 'update'])->name('head_img_update');
});
