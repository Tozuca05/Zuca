<?php

namespace App\Http\Controllers;

use App\Interfaces\PaymentProcessorInterface;
use App\Interfaces\OrderTotalCalculatorInterface;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    protected $paymentProcessor;
    protected $orderTotalCalculator;

    public function __construct(
        PaymentProcessorInterface $paymentProcessor,
        OrderTotalCalculatorInterface $orderTotalCalculator
    ) {
        $this->paymentProcessor = $paymentProcessor;
        $this->orderTotalCalculator = $orderTotalCalculator;
    }

    public function index(): View
    {
        $orders = Order::where('user_id', Auth::id())->get();

        $viewData = [
            'title' => 'Orders - Zuca Store',
            'subtitle' => 'List of orders',
            'orders' => $orders,
        ];

        return view('order.index')->with('viewData', $viewData);
    }

    public function show(string $id): View|RedirectResponse
    {
        try {
            $order = Order::findOrFail($id);
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

    public function create(Request $request): RedirectResponse
    {
        $productsInSession = $request->session()->get('products');
        if ($productsInSession) {
            $userId = Auth::id();
            $order = new Order;
            $order->setUserId($userId);
            $order->setStatus('Pending');
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

        $total = $this->orderTotalCalculator->calculateTotal($order);

        try {
            $response = $this->paymentProcessor->processPayment($order, $user);

            if ($response instanceof RedirectResponse) {
                return $response;
            }
        } catch (\Exception $e) {
            return redirect()->route('order.index')->with('error', 'Payment processing failed: ' . $e->getMessage());
        }

        return redirect()->route('order.index')->with('success', 'Order paid successfully.');
    }

    public function paymentSuccess(): RedirectResponse
    {
        $orderId = request('token');
        $order = Order::where('paypal_order_id', $orderId)->firstOrFail();
        $order->setStatus('Paid');
        $order->save();

        return redirect()->route('order.index')->with('success', 'Payment successful. Your order has been processed.');
    }

    public function paymentCancel(): RedirectResponse
    {
        $orderId = request('token');
        $order = Order::where('paypal_order_id', $orderId)->firstOrFail();
        $order->setStatus('Canceled');
        $order->save();

        return redirect()->route('order.index')->with('error', 'Payment was canceled.');
    }
}
