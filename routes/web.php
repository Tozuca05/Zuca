<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;

Auth::routes();
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::middleware(['auth', 'App\Http\Middleware\AdminMiddleware'])->group(function () {
    Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin.index');
});

Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name('product.show');
Route::post('/products/create', 'App\Http\Controllers\ProductController@create')->name('product.create');
Route::delete('/products/{id}/delete', 'App\Http\Controllers\ProductController@delete')->name('product.delete');
Route::get('/products/{id}/edit', 'App\Http\Controllers\ProductController@edit')->name('product.edit');
Route::put('/products/{id}/update', 'App\Http\Controllers\ProductController@update')->name('.product.update');
