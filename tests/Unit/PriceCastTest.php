<?php

namespace Tests\Unit;

use App\Models\User;

test('It casts a price correctly. For example, a user\'s hourly rate', function () {
    $user = User::factory()->create(['hourly_rate' => 12.00]);
    expect($user->hourly_rate)->toBe('12.00');

    $user = User::factory()->create(['hourly_rate' => 11.34]);
    expect($user->hourly_rate)->toBe('11.34');
});
