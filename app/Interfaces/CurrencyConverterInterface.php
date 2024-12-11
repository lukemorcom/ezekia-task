<?php

namespace App\Interfaces;

use App\Enums\CurrencyEnum;

interface CurrencyConverterInterface
{
    public function convertCurrency(CurrencyEnum $from, CurrencyEnum $to, float $amount): string;
}
