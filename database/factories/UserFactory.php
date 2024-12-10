<?php

namespace Database\Factories;

use App\Enums\CurrencyEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'hourly_rate' => $this->faker->randomFloat(2, 20, 100),
            'currency' => $this->faker->randomElement(CurrencyEnum::cases())->value,
        ];
    }
}
