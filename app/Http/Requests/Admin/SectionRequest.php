<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
            'page_key' => ['required', 'string'],
            'section_key' => ['required', 'string'],
            'title' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'json_data' => ['nullable'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['boolean'],
        ];
    }
}
