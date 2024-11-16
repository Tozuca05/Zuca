<?php

namespace App\Interfaces;

use App\Models\Order;

interface OrderTotalCalculatorInterface
{
    /**
     * Calcula el total de la orden.
     *
     * @param Order $order La orden para calcular el total.
     * @return float El total calculado.
     */
    public function calculateTotal(Order $order): float;
}
