<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['orders'] = Order::where('user_id', Auth::user()->getId())
                       ->where('status', 'Pending')
                       ->get();
        return view('order.index')->with('viewData', $viewData);
    }

    public function create(Request $request): RedirectResponse
    {
        $productsInSession = $request->session()->get('products');
        if ($productsInSession) {
            $userId = Auth::user()->getId();
            $order = new Order;
            $order->setUserId($userId);
            $order->setStatus("Pending");
            $order->setTotal(0);
            $order->save();
            $total = 0;
            $productsInCart = Product::findMany(array_keys($productsInSession));
            foreach ($productsInCart as $product) {
                $quantity = $productsInSession[$product->getId()];
                $item = new Item;
                $item->setQuantity($quantity);
                $item->setPrice($product->getPrice());
                $item->setProductId($product->getId());
                $item->setOrderId($order->getId());
                $item->save();
                $total += $product->getPrice() * $quantity;
            }
            $order->setTotal($total);
            $order->save();

            $request->session()->forget('products');

            $viewData = [];
            $viewData['order'] = $order;
        }

        return redirect()->route('order.index');
    }

    public function pay(string $id): RedirectResponse
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();

        if ($order->getUserId() !== $user->getId()) {
            return redirect()->route('order.index')->with('error', 'Unauthorized action.');
        }
        if ($user->getBalance() < $order->getTotal()) {
          return redirect()->route('order.index')->with('error', 'Insufficient balance.');
        }
        $user->setBalance($user->getBalance() - $order->getTotal());
        $user->save();
        $items = Item::where('order_id', $order->getId())->get();
        foreach ($items as $item) {
            $product = Product::findOrFail($item->getProductId());
            $product->setStock($product->getStock() - $item->getQuantity());
            $product->save();
        }

        $order->setStatus('Paid');
        $order->save();

        return redirect()->route('order.index')->with('success', 'Order paid successfully.');
    }
}