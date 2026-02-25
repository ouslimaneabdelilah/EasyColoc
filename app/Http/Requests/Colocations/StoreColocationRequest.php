<?php

namespace App\Http\Requests\Colocations;

use Illuminate\Foundation\Http\FormRequest;

class StoreColocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom de la colocation est requis.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom ne peut pas dépasser 255 caractères.'
        ];
    }
}
