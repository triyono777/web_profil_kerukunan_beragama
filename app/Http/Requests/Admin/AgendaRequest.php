<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AgendaRequest extends FormRequest
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
        $agendaId = $this->route('agenda')?->id;

        return [
            'title' => ['required', 'string'],
            'slug' => ['required', 'alpha_dash', 'unique:agendas,slug,' . $agendaId],
            'description' => ['nullable', 'string'],
            'start_at' => ['nullable', 'date'],
            'end_at' => ['nullable', 'date', 'after_or_equal:start_at'],
            'location' => ['nullable', 'string'],
            'is_featured' => ['boolean'],
            'status' => ['required', 'in:draft,published,archived'],
            'registration_link' => ['nullable', 'string'],
        ];
    }
}
