<?php

namespace App\Interfaces;

use App\Models\Order;

interface PaymentProcessorInterface
{
    /**
     * Procesa un pago para una orden.
     *
     * @param Order $order La orden que se pagará.
     * @param mixed $user El usuario que realiza el pago.
     * @return mixed Retorna true si el pago es exitoso o redirige al sistema de pagos.
     */
    public function processPayment(Order $order, $user);
}
