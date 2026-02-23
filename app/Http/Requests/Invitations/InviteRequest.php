<?php

namespace App\Http\Requests\Invitations;

use Illuminate\Foundation\Http\FormRequest;

class InviteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255']
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'L\'adresse email est requise pour envoyer une invitation.',
            'email.email' => 'Veuillez fournir une adresse email valide.',
            'email.max' => 'L\'adresse email ne peut pas dépasser 255 caractères.'
        ];
    }
}
