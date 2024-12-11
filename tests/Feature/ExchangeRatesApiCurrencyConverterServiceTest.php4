<?php

use App\Interfaces\CurrencyConverterInterface;
use App\Models\User;
use App\Services\CurrencyConverter\ExchangeRatesApiCurrencyConverterService;

beforeEach(function () {
    config(['currency.driver' => 'exchange-rates']);

    // The container has already matched the previous config and bound the concrete, so rebind it
    app()->bind(
        CurrencyConverterInterface::class,
        ExchangeRatesApiCurrencyConverterService::class
    );

    $mockService = Mockery::mock(ExchangeRatesApiCurrencyConverterService::class);
    $mockService->shouldReceive('convertCurrency')
        ->once()
        ->andReturn('52.70');

    app()->instance(
        ExchangeRatesApiCurrencyConverterService::class,
        $mockService,
    );
});

test('Can show a user and convert currency using the ExchangeRatesApi driver', function () {
    // This user's currency is eur
    $user = User::factory()->create(['currency' => 'eur']);

    $response = $this->getJson(
        // We want it converted to gbp
        route('api.users.show', ['user' => $user, 'currency' => 'gbp']),
    )->assertSuccessful();

    // The value returned by the mocked method
    expect($response['data']['hourly_rate'])
        ->toBe('52.70');
});
