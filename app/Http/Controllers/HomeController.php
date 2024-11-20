<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        
        $products = Product::inRandomOrder()->limit(5)->get();

        
        $viewData = [];
        $viewData['title'] = 'Home Page - Zuca Store';
        $viewData['subtitle'] = 'Welcome to the Zuca Store';

        
        return view('home.index', compact('viewData', 'products'));
    }
}
