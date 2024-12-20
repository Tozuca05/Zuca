<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $total = 0;
        $productsInCart = [];

        $productsInSession = $request->session()->get('products');
        if ($productsInSession) {
            $productsInCart = Product::findMany(array_keys($productsInSession));
            foreach ($productsInCart as $product) {
                $quantity = $productsInSession[$product->getId()];
                $total += $product->getPrice() * $quantity;
            }
        }

        $viewData = [];
        $viewData['title'] = 'Cart - Online Store';
        $viewData['subtitle'] = 'Shopping Cart';
        $viewData['total'] = $total;
        $viewData['products'] = $productsInCart;

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(Request $request, int $id): JsonResponse|RedirectResponse
    {
        $products = $request->session()->get('products');
        if (isset($products[$id])) {
            $products[$id]++;
        } else {
            $products[$id] = 1;
        }
        $request->session()->put('products', $products);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Product added to cart successfully']);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully');
    }

    public function subtract(Request $request, int $id): RedirectResponse
    {
        $products = $request->session()->get('products');
        if (isset($products[$id]) && $products[$id] > 1) {
            $products[$id]--;
        } else {
            unset($products[$id]);
        }

        $request->session()->put('products', $products);

        return back();
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->session()->forget('products');

        return back();
    }

    public function remove(Request $request, $id): RedirectResponse
    {
        $productos = $request->session()->get('products');
        if (isset($productos[$id])) {
            unset($productos[$id]);
            $request->session()->put('products', $productos);
        }

        return back();
    }
}
