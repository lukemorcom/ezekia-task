<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class PriceCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): string
    {
        // Format as a price with 2 decimal places
        return number_format($value / 100, 2);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): int
    {
        // Store as an integer (e.g., 12.34 -> 1234)
        return (int) round($value * 100);
    }
}
