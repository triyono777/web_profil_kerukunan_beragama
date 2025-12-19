<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FooterRequest extends FormRequest
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
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'email' => ['nullable', 'email'],
            'whatsapp' => ['nullable', 'string'],
            'map_embed' => ['nullable', 'string'],
            'social_links' => ['nullable', 'array'],
            'social_links.*.platform' => ['nullable', 'string'],
            'social_links.*.url' => ['nullable', 'url'],
            'quick_links' => ['nullable', 'array'],
            'quick_links.*.label' => ['nullable', 'string'],
            'quick_links.*.url' => ['nullable', 'string'],
            'copyright_text' => ['nullable', 'string'],
        ];
    }
}
