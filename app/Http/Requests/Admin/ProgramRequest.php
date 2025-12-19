<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProgramRequest extends FormRequest
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
        $programId = $this->route('program')?->id;

        return [
            'title' => ['required', 'string'],
            'slug' => ['required', 'alpha_dash', 'unique:programs,slug,' . $programId],
            'excerpt' => ['nullable', 'string'],
            'description' => ['required', 'string'],
            'is_featured' => ['boolean'],
            'status' => ['required', 'in:draft,published,archived'],
            'cta_label' => ['nullable', 'string'],
            'cta_link' => ['nullable', 'string'],
        ];
    }
}
