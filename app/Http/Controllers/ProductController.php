<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): View
    {   
        $viewData = [];
        $viewData['title'] = 'Products - Zuca Store';
        $viewData['subtitle'] = 'List of products';
        $viewData['products'] = Product::where('stock', '>', 0)->get();
        
        return view('product.index')->with('viewData', $viewData);
    }

    public function show(string $id): View|RedirectResponse
    {
        $viewData = [];
        try {
            $product = Product::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('home.index');
        }
        $viewData['title'] = $product->getName().' - Online Store';
        $viewData['subtitle'] = $product->getName().' - Product information';
        $viewData['product'] = $product;
        return view('product.show')->with('viewData', $viewData);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")
                            ->where('stock', '>', 0) // Filtrar productos en stock
                            ->get();
        $viewData = [];
        $viewData["title"] = "Search Results";
        $viewData["subtitle"] = "Products matching: " . $query;
        $viewData["products"] = $products;
        return view('product.index')->with("viewData", $viewData);
    }
    
}