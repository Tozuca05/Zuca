<?php

namespace App\Services;

use App\Interfaces\PaymentProcessorInterface;
use App\Interfaces\OrderTotalCalculatorInterface;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Order;

class PayPalPaymentProcessor implements PaymentProcessorInterface
{
    protected $paypal;
    protected $totalCalculator;

    public function __construct(OrderTotalCalculatorInterface $totalCalculator)
    {
        $this->paypal = new PayPalClient;
        $this->paypal->setApiCredentials(config('paypal'));
        $this->paypal->getAccessToken();

        $this->totalCalculator = $totalCalculator;
    }

    public function processPayment(Order $order, $user)
{
    $total = $this->totalCalculator->calculateTotal($order);

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
                    'value' => $total,
                ],
                'description' => 'Payment for Order #' . $order->getId(),
            ],
        ],
    ];

    $response = $this->paypal->createOrder($orderData);

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
