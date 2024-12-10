<?php

namespace App\Http\Requests;

use App\Enums\CurrencyEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:64'],
            'last_name' => ['required', 'string', 'max:128'],
            'hourly_rate' => ['required', 'numeric'],
            'currency' => ['required', 'string', Rule::enum(CurrencyEnum::class)],
        ];
    }
}
