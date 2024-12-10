<?php

namespace App\Providers;

use App\Interfaces\CurrencyConverterInterface;
use App\Services\CurrencyConverter\ExchangeRatesApiCurrencyConverterService;
use App\Services\CurrencyConverter\LocalCurrencyConverterService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            CurrencyConverterInterface::class,
            match (config('currency.driver')) {
                'local' => LocalCurrencyConverterService::class,
                'exchange-rates' => ExchangeRatesApiCurrencyConverterService::class
            }
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
