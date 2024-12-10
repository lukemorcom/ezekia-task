<?php

namespace App\Exceptions;

use Throwable;

class InvalidExchangeRatesApiKeyException extends \Exception
{
    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(
            'Invalid Exchange Rates API key',
            $code,
            $previous
        );
    }
}
