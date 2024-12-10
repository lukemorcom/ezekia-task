<?php

namespace App\Dtos;

use App\Enums\CurrencyEnum;
use App\Http\Requests\UserStoreRequest;

class UserDto
{
    public function __construct(
        protected readonly string $firstName,
        protected readonly string $lastName,
        protected readonly CurrencyEnum $currency,
        protected readonly float $hourlyRate,
    ) {}

    public static function fromRequest(UserStoreRequest $request): self
    {
        return new self(
            firstName: $request->input('first_name'),
            lastName: $request->input('last_name'),
            currency: CurrencyEnum::from($request->input('currency')),
            hourlyRate: $request->input('hourly_rate'),
        );
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'currency' => $this->currency,
            'hourly_rate' => $this->hourlyRate,
        ];
    }
}
