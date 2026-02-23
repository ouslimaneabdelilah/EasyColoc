<?php

namespace App\Http\Requests\Invitations;

use Illuminate\Foundation\Http\FormRequest;

class AcceptInvitationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => ['required', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => 'Le jeton d\'invitation est requis.',
            'token.string' => 'Le jeton d\'invitation n\'est pas valide.'
        ];
    }
}
