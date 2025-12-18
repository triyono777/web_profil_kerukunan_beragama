<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SiteSettingRequest extends FormRequest
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
            'site_name' => ['required', 'string'],
            'logo_path' => ['nullable', 'string'],
            'logo' => ['nullable', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'favicon_path' => ['nullable', 'string'],
            'favicon' => ['nullable', 'mimes:jpg,jpeg,png,webp,svg', 'max:1024'],
            'primary_color' => ['nullable', 'string'],
            'contact_email' => ['nullable', 'email'],
            'contact_phone' => ['nullable', 'string'],
            'contact_whatsapp' => ['nullable', 'string'],
            'contact_address' => ['nullable', 'string'],
            'map_embed' => ['nullable', 'string'],
            'office_hours' => ['nullable', 'string'],
            'hero_title' => ['nullable', 'string'],
            'hero_subtitle' => ['nullable', 'string'],
            'hero_cta_label' => ['nullable', 'string'],
            'hero_cta_link' => ['nullable', 'string'],
        ];
    }
}
