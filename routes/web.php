<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

<<<<<<< HEAD
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name('product.show');
Route::get('/product/search', 'App\Http\Controllers\ProductController@search')->name('product.search');
=======
    Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
    Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');
    Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name('product.show');
    Route::get('/product/search', 'App\Http\Controllers\ProductController@search')->name('product.search');
    Route::get('/partner-products', 'App\Http\Controllers\ProductController@partnerProducts')->name('product.partnerProducts');


>>>>>>> 6a2405baae9fcbe7a04cf2603652d4e00a464aed

Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
Route::get('/cart/delete', 'App\Http\Controllers\CartController@delete')->name('cart.delete');
Route::post('/cart/add/{id}', 'App\Http\Controllers\CartController@add')->name('cart.add');
Route::get('/cart/remove/{id}', 'App\Http\Controllers\CartController@remove')->name('cart.remove');
Route::post('/cart/subtract/{id}', 'App\Http\Controllers\CartController@subtract')->name('cart.subtract');

Route::middleware('auth')->group(function () {
    Route::get('/orders', 'App\Http\Controllers\OrderController@index')->name('order.index');
    Route::get('/orders/create', 'App\Http\Controllers\OrderController@create')->name('order.create');
    Route::post('/orders', 'App\Http\Controllers\OrderController@store')->name('order.store');
    Route::post('/orders/pay', 'App\Http\Controllers\OrderController@pay')->name('order.pay'); // Ajustado
    Route::get('/payment/success', 'App\Http\Controllers\OrderController@paymentSuccess')->name('payment.success');
    Route::get('/payment/cancel', 'App\Http\Controllers\OrderController@paymentCancel')->name('payment.cancel');
    
    Route::get('/playlists/{id}', 'App\Http\Controllers\PlaylistController@show')->name('playlists.show');
    Route::get('/playlist', 'App\Http\Controllers\Admin\AdminPlaylistController@index')->name('playlist.index');
});

Route::middleware(['auth', 'App\Http\Middleware\AdminMiddleware'])->group(function () {
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
    
    Route::get('/admin/playlist', 'App\Http\Controllers\Admin\AdminPlaylistController@index')->name('admin.playlist.index');
    Route::get('/admin/playlist/create', 'App\Http\Controllers\Admin\AdminPlaylistController@create')->name('admin.playlist.create');
    Route::post('/admin/playlist', 'App\Http\Controllers\Admin\AdminPlaylistController@store')->name('admin.playlist.store');
    Route::get('/admin/playlist/{id}', 'App\Http\Controllers\Admin\AdminPlaylistController@show')->name('admin.playlist.show');
    Route::get('/admin/playlist/{id}/edit', 'App\Http\Controllers\Admin\AdminPlaylistController@edit')->name('admin.playlist.edit');
    Route::put('/admin/playlist/{id}', 'App\Http\Controllers\Admin\AdminPlaylistController@update')->name('admin.playlist.update');
    Route::delete('/admin/playlist/{id}', 'App\Http\Controllers\Admin\AdminPlaylistController@delete')->name('admin.playlist.delete');
});
