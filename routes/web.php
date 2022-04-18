<?php

// admin
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\NewsCategoryController as AdminNewsCategoryController;

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
    // return view('welcome');
    return view('admin.login');
});

Route::get('admin/login', [AdminLoginController::class, 'loginPage'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login']);

Route::prefix('admin')->name('admin.')->middleware(['admin.auth'])->group(function () {
    Route::get('/news_list', [AdminNewsController::class, 'list'])->name('news_list');
    Route::get('/news_add_form', [AdminNewsController::class, 'add_form'])->name('news_add_form');
    Route::get('/news_update_form/{id}', [AdminNewsController::class, 'update_form'])->name('news_update_form');
    Route::post('/news_add', [AdminNewsController::class, 'add'])->name('news_add');
    Route::post('/news_update', [AdminNewsController::class, 'update'])->name('news_update');

    
    Route::get('/news_category_list', [AdminNewsCategoryController::class, 'list'])->name('news_category_list');
    Route::get('/news_category_add_form', [AdminNewsCategoryController::class, 'add_form'])->name('news_category_add_form');
    Route::post('/news_category_add', [AdminNewsCategoryController::class, 'add'])->name('news_category_add');
    Route::post('/news_category_batch_action', [AdminNewsCategoryController::class, 'batch_action'])->name('news_category_batch_action');
    Route::get('/news_category_delete/{id}', [AdminNewsCategoryController::class, 'delete'])->name('news_category_delete');
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Route::get('/', [ControlsPageController::class, 'home'])->name('home');
    // Route::resource('products', ControlsProductController::class)->except(['show']);
    // Route::resource('orders', ControlsOrderController::class)->except(['show', 'create', 'store']);
    // Route::resource('brands', ControlsBrandController::class)->except(['show']);
    // Route::resource('categories', ControlsCategoryController::class)->except(['show']);
    // Route::resource('users', ControlsUserController::class)->except(['show']);
    // Route::resource('carts', ControlsCartController::class)->only(['index']);
    // Route::resource('categories.subcategories', ControlsSubcategoryController::class)->except(['show']);
});
