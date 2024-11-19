<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\PaymentProcessorInterface;
use App\Models\Order;

class BalancePaymentProcessor implements PaymentProcessorInterface
{
    public function processPayment(Request $request): RedirectResponse
    {
        $order = Order::findOrFail($request->input('order_id'));
        $user = $request->user();

        if ($order->getUserId() !== $user->getId()) {
            throw new \Exception('Unauthorized action.');
        }

        if ($user->getBalance() < $order->getTotal()) {
            return redirect()->route('order.index')->with('error', 'Insufficient balance.');
        }

        $user->setBalance($user->getBalance() - $order->getTotal());
        $user->save();

        $order->setStatus('Paid');
        $order->save();

        return redirect()->route('order.index')->with('success', 'Payment made successfully using balance.');
    }
}

