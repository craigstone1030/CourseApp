<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::group(['middleware' => ['isAdmin'],'prefix' => 'admin', 'as' => 'admin.'], function() {

    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('learn', \App\Http\Controllers\Admin\LearnController::class);

    Route::get('faqs', [\App\Http\Controllers\Admin\FaqController::class, "index"])->name("faqs.index");
    Route::post('faqs/store', [\App\Http\Controllers\Admin\FaqController::class, "store"])->name("faqs.store");
    Route::post('faqs/{id}/remove', [\App\Http\Controllers\Admin\FaqController::class, "destroy"])->name("faqs.destroy");

    Route::get('learn/product/view', [\App\Http\Controllers\Admin\LearnController::class, 'viewProductLearn'])->name("learn.product.view");
    Route::post('learn/product/store', [\App\Http\Controllers\Admin\LearnController::class, 'storeProductLearn'])->name("learn.product.store");

});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::get('products/{categoryId}/subcateogry', [App\Http\Controllers\ProductController::class, 'showcategory'])->name('products.showcategory');

Route::get('faqs', [\App\Http\Controllers\Admin\FaqController::class, "viewFAQs"])->name("faqs");
