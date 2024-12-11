<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

test('Can create a User', function () {
    $data = [
        'first_name' => 'Terry',
        'last_name' => 'Tibbs',
        'hourly_rate' => 34.99,
        'currency' => 'gbp',
    ];

    $this->postJson(
        route('api.users.store'),
        $data
    )
        ->assertSuccessful();

    $this->assertDatabaseHas(
        'users',
        array_merge(
            $data,
            // To account for the fact it is stored as an integer
            ['hourly_rate' => 3499]
        )
    );
});

test('Can show a User', function () {
    $user = User::factory()->create();

    $this->getJson(
        route('api.users.show', $user)
    )
        ->assertSuccessful()
        ->assertJson(function (AssertableJson $json) use ($user) {
            $json->where('data.first_name', $user->first_name)
                ->where('data.last_name', $user->last_name)
                ->where('data.hourly_rate', $user->hourly_rate)
                ->where('data.currency', $user->currency->value);
        });
});

test('Can update all User fields at once', function () {
    $user = User::factory()->create();

    $newData = [
        'first_name' => 'Terry',
        'last_name' => 'Tibbs',
        'hourly_rate' => 38.12,
        'currency' => 'gbp',
    ];

    $this->putJson(
        route('api.users.update', $user),
        $newData,
    )
        ->assertSuccessful();

    $user->refresh();

    expect($user->toArray())->toMatchArray($newData);
});

test('Can update some User fields', function () {
    $user = User::factory()->create();

    $newData = [
        'first_name' => 'Terry',
        'last_name' => 'Tibbs',
    ];

    $this->putJson(
        route('api.users.update', $user),
        $newData,
    )
        ->assertSuccessful();

    $freshUser = $user->refresh();

    expect(
        $freshUser->toArray()
    )->toMatchArray(
        array_merge($user->toArray(), $newData)
    );
});

test('Can delete a User', function () {
    $user = User::factory()->create();

    $this->deleteJson(
        route('api.users.destroy', $user)
    )
        ->assertSuccessful();

    $this->assertDatabaseMissing(
        'users',
        ['id' => $user->id]
    );
});

test('Can show a user and convert currency using the local driver', function () {
    // This user's currency is gbp
    $user = User::factory()->create(['currency' => 'gbp']);

    $response = $this->getJson(
        // We want it converted to usd
        route('api.users.show', ['user' => $user, 'currency' => 'usd']),
    )->assertSuccessful();

    // The exchange rate for the gbp -> usd pair in the Local converter is 1.3
    expect($response['data']['hourly_rate'])
        ->toBe(number_format($user->hourly_rate * 1.3, 2));
});
