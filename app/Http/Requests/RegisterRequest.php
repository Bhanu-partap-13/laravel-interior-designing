<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role' => ['required', Rule::in(['client', 'designer'])],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'design_type' => ['required_if:role,client', 'string', 'max:120'],
            'budget_range' => ['required_if:role,client', 'string', 'max:60'],
            'location' => ['required_if:role,client', 'string', 'max:120'],
            'timeline' => ['required_if:role,client', 'string', 'max:120'],
            'property_size' => ['required_if:role,client', 'string', 'max:120'],
            'style_preference' => ['required_if:role,client', 'string', 'max:120'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
