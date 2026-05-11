<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:160'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string', 'max:2000'],
            'budget_range' => ['nullable', 'string', 'max:60'],
            'duration_days' => ['nullable', 'integer', 'min:1'],
            'style_tags' => ['nullable', 'string', 'max:250'],
            'before_image' => ['nullable', 'image', 'max:4096'],
            'after_image' => ['nullable', 'image', 'max:4096'],
            'invoice_proof' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:4096'],
            'media' => ['nullable', 'array'],
            'media.*' => ['file', 'mimes:jpg,jpeg,png,webp,mp4,webm,mov', 'max:8192'],
            'is_published' => ['nullable', 'boolean'],
        ];
    }
}
