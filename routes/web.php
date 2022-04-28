<?php

// admin
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\NewsCategoryController as AdminNewsCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductCategoryController as AdminProductCategoryController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;

// Front
use App\Http\Controllers\Front\NewsController as NewsController;


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

Route::get('/', function () {
    return view('front.welcome');
})->name('home');

Route::get('/news_list', [NewsController::class, 'list'])->name('news_list');


Route::get('admin/login', [AdminLoginController::class, 'loginPage'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login']);

Route::prefix('admin')->name('admin.')->middleware(['admin.auth'])->group(function () {
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');

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

    Route::get('/product_category_list', [AdminProductCategoryController::class, 'list'])->name('product_category_list');
    Route::get('/product_category_add_form', [AdminProductCategoryController::class, 'add_form'])->name('product_category_add_form');
    Route::post('/product_category_add', [AdminProductCategoryController::class, 'add'])->name('product_category_add');
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
    

    // Route::get('/', [ControlsPageController::class, 'home'])->name('home');
    // Route::resource('products', ControlsProductController::class)->except(['show']);
    // Route::resource('orders', ControlsOrderController::class)->except(['show', 'create', 'store']);
    // Route::resource('brands', ControlsBrandController::class)->except(['show']);
    // Route::resource('categories', ControlsCategoryController::class)->except(['show']);
    // Route::resource('users', ControlsUserController::class)->except(['show']);
    // Route::resource('carts', ControlsCartController::class)->only(['index']);
    // Route::resource('categories.subcategories', ControlsSubcategoryController::class)->except(['show']);
});
