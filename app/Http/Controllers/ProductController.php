<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Zuca products';
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
            return redirect()->route('product.index');
        }
        $viewData['title'] = $product->getName().' - Zuca Shop';
        $viewData['subtitle'] = $product->getName().' - Product information';

        $viewData['product'] = $product;

        return view('product.show')->with('viewData', $viewData);
    }
    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = 'Create Products';
        $viewData['subtitle'] = 'List of products';
        $viewData['products'] = Product::all();
        return view('product.create')->with('viewData', $viewData);
    }
    public function store(Request $request): RedirectResponse
    {
        Product::validate($request);

        $newProduct = new Product;
        $newProduct->setName($request->input('name'));
        $newProduct->setDescription($request->input('description'));
        $newProduct->setPrice($request->input('price'));
        $newProduct->setImage('default_image.png');
        $newProduct->save();

        if ($request->hasFile('image')) {
            $imageName = $newProduct->getId().'.'.$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $newProduct->setImage($imageName);
            $newProduct->save();
        }

        return redirect()->route('product.index')->with('success', 'Element created successfully.');
    }

    public function delete($id): RedirectResponse
    {
        Product::destroy($id);

        return redirect()->route('product.index');
    }

    public function edit($id): View
    {
        $viewData = [];
        $viewData['title'] = 'Edit Product - Zuca';
        $viewData['product'] = Product::findOrFail($id);

        return view('product.edit')->with('viewData', $viewData);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        Product::validate($request);

        $product = Product::findOrFail($id);

        $product->setName($request->input('name'));
        $product->setDescription($request->input('description'));
        $product->setPrice($request->input('price'));

        if ($request->hasFile('image')) {
            $imageName = $product->getId().'.'.$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $product->setImage($imageName);
        }

        $product->save();

        return redirect()->route('product.index');
    }
}
