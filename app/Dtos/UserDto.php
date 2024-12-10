<?php

namespace App\Dtos;

use App\Enums\CurrencyEnum;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;

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

    public static function updateFromRequest(UserUpdateRequest $request, User $user): self
    {
        return new self(
            firstName: $request->input('first_name', $user->first_name),
            lastName: $request->input('last_name', $user->last_name),
            currency: CurrencyEnum::tryFrom($request->input('currency')) ?? $user->currency,
            hourlyRate: $request->input('hourly_rate', $user->hourly_rate),
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
