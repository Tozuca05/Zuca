<?php

namespace App\Services;

use App\Interfaces\PaymentProcessorInterface;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
class PayPalPaymentProcessor implements PaymentProcessorInterface
{
    public function processPayment(Request $request): RedirectResponse
    {
        $order = Order::findOrFail($request->input('order_id'));
        $user = $request->user();

        if ($order->getUserId() !== $user->getId()) {
            throw new \Exception('Unauthorized action.');
        }

        $paypal = new PayPalClient;
        $paypal->setApiCredentials(config('paypal'));
        $paypal->getAccessToken();

        $orderData = [
            'intent' => 'CAPTURE',
            'application_context' => [
                'return_url' => route('payment.success', ['token' => $order->getId()]),
                'cancel_url' => route('payment.cancel', ['token' => $order->getId()]),
            ],
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $order->getTotal(),
                    ],
                    'description' => 'Payment for Order #' . $order->getId(),
                ],
            ],
        ];

        $response = $paypal->createOrder($orderData);

        if (isset($response['id']) && $response['status'] === 'CREATED') {
            $order->paypal_order_id = $response['id'];
            $order->save();

            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        throw new \Exception('Error creating PayPal order.');
    }
}
