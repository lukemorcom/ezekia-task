<?php

return [
    'driver' => env('CURRENCY_DRIVER', 'local'),
    'exchange_rates' => [
        'api_key' => env('EXCHANGE_RATES_API_KEY'),
    ],
];
