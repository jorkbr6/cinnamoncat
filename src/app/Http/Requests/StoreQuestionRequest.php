<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'is_public' => ['nullable', 'boolean'],
            'options' => ['required', 'array', 'min:1'],
            'options.*.option_text' => ['required', 'string', 'max:255'],
        ];
    }
}
