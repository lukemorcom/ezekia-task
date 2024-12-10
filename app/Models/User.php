<?php

namespace App\Models;

use App\Casts\PriceCast;
use App\Enums\CurrencyEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $casts = [
        'currency' => CurrencyEnum::class,
        'hourly_rate' => PriceCast::class,
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'hourly_rate',
        'currency',
    ];
}
