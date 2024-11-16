<?php

namespace App\Services;

use App\Interfaces\OrderTotalCalculatorInterface;
use App\Models\Order;

class OrderTotalCalculator implements OrderTotalCalculatorInterface
{
    public function calculateTotal(Order $order): float
    {
        return $order->items->sum(function ($item) {
            return $item->getPrice() * $item->getQuantity();
        });
    }
}
