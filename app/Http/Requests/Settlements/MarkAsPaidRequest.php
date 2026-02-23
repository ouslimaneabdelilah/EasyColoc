<?php

namespace App\Http\Requests\Settlements;

use Illuminate\Foundation\Http\FormRequest;

class MarkAsPaidRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'expense_id' => ['required', 'exists:expenses,id'],
            'amount' => ['required', 'numeric', 'min:0.01']
        ];
    }

    public function messages(): array
    {
        return [
            'expense_id.required' => 'La dépense à rembourser est requise.',
            'expense_id.exists' => 'La dépense sélectionnée n\'existe pas.',
            'amount.required' => 'Le montant du règlement est requis.',
            'amount.numeric' => 'Le montant doit être une valeur numérique.',
            'amount.min' => 'Le montant doit être supérieur à zéro.'
        ];
    }
}
