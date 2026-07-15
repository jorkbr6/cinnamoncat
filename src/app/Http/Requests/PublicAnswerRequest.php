<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicAnswerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'question_option_id' => ['required', 'exists:question_options,id'],
            'visitor_token' => ['required', 'string', 'max:255'],
        ];
    }
}
