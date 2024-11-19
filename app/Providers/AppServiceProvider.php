<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PayPalPaymentProcessor;
use App\Services\BalancePaymentProcessor;
use App\Interfaces\PaymentProcessorInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentProcessorInterface::class, PayPalPaymentProcessor::class);
    
        $this->app->bind('balance', function () {
            return new \App\Services\BalancePaymentProcessor();
        });
    }
    

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
