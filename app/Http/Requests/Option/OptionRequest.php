<?php

namespace App\Http\Requests\Option;

use Illuminate\Foundation\Http\FormRequest;

class OptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'option_text' => ['required', 'string', 'max:255'],
        ];
    }
}
