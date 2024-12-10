<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

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
