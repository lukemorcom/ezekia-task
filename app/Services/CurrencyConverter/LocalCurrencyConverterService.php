<?php

namespace App\Services\CurrencyConverter;

use App\Enums\CurrencyEnum;
use App\Interfaces\CurrencyConverterInterface;

use function number_format;

class LocalCurrencyConverterService implements CurrencyConverterInterface
{
    /**
     * Each key in the array indicates a 'from' currency to convert,
     * while its values K,V represent the 'destination' currency,
     * and the rate.
     */
    protected array $pricePairs = [
        'gbp' => [
            'usd' => 1.3,
            'eur' => 1.1,
        ],
        'eur' => [
            'gbp' => 0.9,
            'usd' => 1.2,
        ],
        'usd' => [
            'gbp' => 0.7,
            'eur' => 0.8,
        ],
    ];

    public function convertCurrency(CurrencyEnum $from, CurrencyEnum $to, float $amount): string
    {
        // Find the rate that applies to this conversion and return the result
        return number_format($this->pricePairs[$from->value][$to->value] * $amount, 2);
    }
}
