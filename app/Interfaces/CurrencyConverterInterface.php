<?php

namespace App\Interfaces;

use App\Enums\CurrencyEnum;
use App\Exceptions\InvalidExchangeRatesApiKeyException;

interface CurrencyConverterInterface
{
    /**
     * @throws InvalidExchangeRatesApiKeyException
     */
    public function convertCurrency(CurrencyEnum $from, CurrencyEnum $to, float $amount): string;
}
