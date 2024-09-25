<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Admin Page - Products - Zuca Store';
        $viewData['products'] = Product::all();
        $viewData['tags'] = Tag::all();

        return view('admin.product.index')->with('viewData', $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        Product::validate($request);

        $newProduct = new Product;
        $newProduct->setName($request->input('name'));
        $newProduct->setDescription($request->input('description'));
        $newProduct->setPrice($request->input('price'));
        $newProduct->setImage('default_image.png');
        $newProduct->setStock($request->input('stock'));
        $newProduct->tag()->associate($request->input('tag_id'));
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

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');
    }

    public function delete($id): RedirectResponse
    {
        Product::destroy($id);

        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully.');
    }

    public function edit($id): View
    {
        $viewData = [];
        $viewData['title'] = 'Admin Page - Edit Product - Zuca Store';
        $viewData['product'] = Product::findOrFail($id);
        $viewData['tags'] = Tag::all();

        return view('admin.product.edit')->with('viewData', $viewData);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        Product::validate($request);
        $product = Product::findOrFail($id);
        $product->setName($request->input('name'));
        $product->setDescription($request->input('description'));
        $product->setPrice($request->input('price'));
        $product->setStock($request->input('stock'));
        $product->tag()->associate($request->input('tag_id'));

        if ($request->hasFile('image')) {
            $imageName = $product->getId().'.'.$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $product->setImage($imageName);
        }

        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully.');
    }
}
