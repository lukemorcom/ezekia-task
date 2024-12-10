<?php

namespace App\Http\Requests\User;

use App\Enums\CurrencyEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['nullable', 'string', 'max:64'],
            'last_name' => ['nullable', 'string', 'max:128'],
            'hourly_rate' => ['nullable', 'numeric'],
            'currency' => ['nullable', 'string', Rule::enum(CurrencyEnum::class)],
        ];
    }
}
