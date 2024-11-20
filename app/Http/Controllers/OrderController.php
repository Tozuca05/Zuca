<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\PaymentProcessorInterface;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Orders - Zuca Store';
        $viewData['subtitle'] = 'List orders';
        $viewData['orders'] = Order::with('items.product')
                                    ->where('user_id', Auth::id())
                                    ->get(); 

        return view('order.index')->with('viewData', $viewData);
    }

    public function show(string $id): View|RedirectResponse
    {
        try {
            $order = Order::with('items.product')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('order.index')->with('error', 'Order not found.');
        }

        if ($order->getUserId() !== Auth::id()) {
            return redirect()->route('order.index')->with('error', 'Unauthorized action.');
        }

        $viewData = [
            'title' => 'Order Details - Zuca Store',
            'subtitle' => 'Order information',
            'order' => $order,
        ];

        return view('order.show')->with('viewData', $viewData);
    }

    public function create(): RedirectResponse
    {
        $productsInSession = session()->get('products');
        if ($productsInSession) {
            $userId = Auth::id();
            $order = new Order();
            $order->user_id = $userId;
            $order->status = 'Pending';
            $order->total = 0;
            $order->save();

            $total = 0;
            $productsInCart = Product::findMany(array_keys($productsInSession));
            foreach ($productsInCart as $product) {
                $quantity = $productsInSession[$product->id];
                $item = new Item();
                $item->quantity = $quantity;
                $item->price = $product->price;
                $item->product_id = $product->id;
                $item->order_id = $order->id;
                $item->save();
                $total += $product->price * $quantity;
            }
            $order->total = $total;
            $order->save();

            session()->forget('products');
        }

        return redirect()->route('order.index');
    }

    public function pay(Request $request): RedirectResponse
    {
        $paymentMethod = $request->input('payment_method');
        $processor = $paymentMethod === 'balance'
            ? app('balance')
            : app(PaymentProcessorInterface::class);
    
        try {
            return $processor->processPayment($request);
        } catch (\Exception $e) {
            return redirect()->route('order.index')->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    public function paymentSuccess(): RedirectResponse
    {
        $orderId = request('token');
        $order = Order::where('paypal_order_id', $orderId)->firstOrFail();

        if ($order->status !== 'Paid') {
            $order->status = 'Paid';
            $order->save();
        }

        return redirect()->route('order.index')->with('success', 'Payment successful. Your order has been processed.');
    }

    public function paymentCancel(): RedirectResponse
    {
        $orderId = request('token');
        $order = Order::where('paypal_order_id', $orderId)->firstOrFail();

        if ($order->status === 'Paid') {
            return redirect()->route('order.index')->with('error', 'Order is already paid and cannot be canceled.');
        }

        $order->status = 'Pending';
        $order->save();

        return redirect()->route('order.index')->with('error', 'Payment was canceled. You can try again.');
    }
}
