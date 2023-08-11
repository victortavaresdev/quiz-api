<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'bio' => ['sometimes', 'string', 'nullable', 'max:255'],
            'image' => ['sometimes', 'string', 'nullable', 'url'],
        ];
    }
}
