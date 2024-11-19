<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::where('stock', '>', 0);

        if ($request->has('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $viewData = [];
        $viewData['title'] = 'Products - Zuca Store';
        $viewData['subtitle'] = 'List of products';
        $viewData['products'] = $query->get();
        $viewData['search'] = $request->search;

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

    public function partnerProducts(Request $request): View
{
    // URL of the external API
    $apiUrl = 'http://pawtopia.sytes.net/api/products';

    // Make the API request
    $response = Http::get($apiUrl);

    // Check if the request was successful
    if ($response->successful()) {
        $partnerProducts = $response->json();
    } else {
        // Handle the error if the request fails
        $partnerProducts = [];
        // You can add error messages or logs here
    }

    $viewData = [];
    $viewData['title'] = 'Partner Products - Zuca Store';
    $viewData['subtitle'] = 'List of partner products';
    $viewData['partnerProducts'] = $partnerProducts;

    return view('product.partnerProducts')->with('viewData', $viewData);
}   
}
