<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'project_id' => ['required', 'exists:projects,id'],
            'visitor_name' => ['required', 'string', 'max:120'],
            'visitor_email' => ['required', 'email', 'max:160'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }
}
