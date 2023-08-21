<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\Sort;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CardsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return match ($this->getMethod()) {
            'GET' => ['sometimes', new Enum(Sort::class)],
            'POST' => [
                'realName' => 'required|string',
                'playerName' => 'required|string',
                'asset' => 'required|string',
            ]
        };
    }
}
