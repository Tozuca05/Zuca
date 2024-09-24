<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name('product.show');
Route::get('/cart', 'App\Http\Controllers\CartController@index')->name("cart.index"); 
Route::get('/cart/delete', 'App\Http\Controllers\CartController@delete')->name("cart.delete"); 
Route::post('/cart/add/{id}', 'App\Http\Controllers\CartController@add')->name("cart.add"); 
Route::get('/cart/remove/{id}', 'App\Http\Controllers\CartController@remove')->name('cart.remove');
Route::post('/cart/substract/{id}', 'App\Http\Controllers\CartController@subtract')->name('cart.subtract');
Route::get('/product/search', 'App\Http\Controllers\ProductController@search')->name('product.search');

Route::middleware('auth', 'App\Http\Middleware\AdminMiddleware')->group(function () {
    Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name('admin.home.index');
    Route::get('/admin/products', 'App\Http\Controllers\Admin\AdminProductController@index')->name('admin.product.index');
    Route::post('/admin/products/store', 'App\Http\Controllers\Admin\AdminProductController@store')->name('admin.product.store');
    Route::delete('/admin/products/{id}/delete', 'App\Http\Controllers\Admin\AdminProductController@delete')->name('admin.product.delete');
    Route::get('/admin/products/{id}/edit', 'App\Http\Controllers\Admin\AdminProductController@edit')->name('admin.product.edit');
    Route::put('/admin/products/{id}/update', 'App\Http\Controllers\Admin\AdminProductController@update')->name('admin.product.update');
    Route::get('/admin/items/top-sold', 'App\Http\Controllers\Admin\AdminItemController@topSoldProducts')->name('admin.item.topSoldProducts');
    Route::get('/admin/tags', 'App\Http\Controllers\Admin\AdminTagController@index')->name('admin.tag.index');
    Route::get('/admin/tags/{id}', 'App\Http\Controllers\Admin\AdminTagController@show')->name('admin.tag.show');
    Route::get('/admin/tags/search', 'App\Http\Controllers\Admin\AdminTagController@search')->name('admin.tag.search');
    Route::post('/admin/tags/store', 'App\Http\Controllers\Admin\AdminTagController@store')->name('admin.tag.store');
    Route::get('/admin/tags/{id}/edit', 'App\Http\Controllers\Admin\AdminTagController@edit')->name('admin.tag.edit');
    Route::put('/admin/tags/{id}/update', 'App\Http\Controllers\Admin\AdminTagController@update')->name('admin.tag.update');
    Route::delete('/admin/tags/{id}/delete', 'App\Http\Controllers\Admin\AdminTagController@delete')->name('admin.tag.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/orders/create', 'App\Http\Controllers\OrderController@create')->name('order.create');
    Route::get('/orders', 'App\Http\Controllers\OrderController@index')->name('order.index');
    Route::post('/orders/pay/{id}', 'App\Http\Controllers\OrderController@pay')->name("order.pay");
    Route::get('/orders/generate-invoice/{id}', 'App\Http\Controllers\OrderController@generateInvoice')->name('order.generateInvoice');
});

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');