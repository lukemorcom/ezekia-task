<?php

namespace App\Services\CurrencyConverter;

use App\Enums\CurrencyEnum;
use App\Exceptions\InvalidExchangeRatesApiKeyException;
use App\Interfaces\CurrencyConverterInterface;
use Illuminate\Support\Facades\Http;

class ExchangeRatesApiCurrencyConverterService implements CurrencyConverterInterface
{
    private string $api_key;

    public function __construct()
    {
        $this->api_key = config('currency.exchange_rates.api_key');
    }

    /**
     * @throws InvalidExchangeRatesApiKeyException
     */
    public function convertCurrency(CurrencyEnum $from, CurrencyEnum $to, float $amount): string
    {
        $response = Http::get('http://api.exchangeratesapi.io/v1/convert'
                                .'?access_key='.$this->api_key
                                .'&from='.$from->value
                                .'&to='.$to->value
                                .'&amount='.$amount
        );

        if (! $response->successful()) {
            throw new InvalidExchangeRatesApiKeyException;
        }

        return $response->json('result');
    }
}
