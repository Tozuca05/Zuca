<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Home Page - Zuca Store';
        $viewData['subtitle'] = 'Welcome to the Zuca Store';
        return view('home.index')->with('viewData', $viewData);

    }
}