<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'file' => ['nullable', 'file'],
            'file_path' => ['required_without:file', 'string'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'published_at' => ['nullable', 'date'],
        ];
    }
}
