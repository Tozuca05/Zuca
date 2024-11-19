<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

interface PaymentProcessorInterface
{
    /**
     * Procesa un pago para una orden.
     *
     * @param Request $request La solicitud HTTP con los datos necesarios para el pago.
     * @return RedirectResponse Redirección al sistema de pago o una respuesta de éxito.
     */
    public function processPayment(Request $request): RedirectResponse;
}
