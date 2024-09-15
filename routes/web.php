<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;

Auth::routes();
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::middleware(['auth', 'App\Http\Middleware\AdminMiddleware'])->group(function () {
    Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin.index');
});



