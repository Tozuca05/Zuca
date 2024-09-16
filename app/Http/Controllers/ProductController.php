<?php

namespace App\Http\Controllers;

use App\Models\Product;
<<<<<<< HEAD
use Illuminate\Http\Request; 
use App\Utils\ProductDataValidate;
=======
>>>>>>> bc7c07b4b25526c1361fad9e14701615155e4972
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Products - Pet Store';
        $viewData['subtitle'] = 'List of products';
        $viewData['products'] = Product::all();

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(string $id): View|RedirectResponse
    {
        $viewData = [];
        try {
            $product = Product::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('home.index');
        }
        $viewData['title'] = $product->getName().' - Online Store';
        $viewData['subtitle'] = $product->getName().' - Product information';
<<<<<<< HEAD
=======

>>>>>>> bc7c07b4b25526c1361fad9e14701615155e4972
        $viewData['product'] = $product;

        return view('product.show')->with('viewData', $viewData);
    }
<<<<<<< HEAD

  
    public function save(Request $request): RedirectResponse
    {
     
        $validator = ProductDataValidate::validate($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }
}
=======
}
>>>>>>> bc7c07b4b25526c1361fad9e14701615155e4972
