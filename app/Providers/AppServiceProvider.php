<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Interfaces\PaymentProcessorInterface::class,
            \App\Services\PayPalPaymentProcessor::class
        );
    
        // Registro del servicio de cálculo del total
        $this->app->bind(
            \App\Interfaces\OrderTotalCalculatorInterface::class,
            \App\Services\OrderTotalCalculator::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
