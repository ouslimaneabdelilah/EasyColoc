<?php

namespace App\Http\Requests\Expenses;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'expense_date' => ['required', 'date'],
            'category_id' => ['required', 'exists:categories,id'],
            'paid_by' => ['required', 'exists:users,id']
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Le titre de la dépense est requis.',
            'title.string' => 'Le titre doit être une chaîne de caractères.',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères.',
            'amount.required' => 'Le montant est requis.',
            'amount.numeric' => 'Le montant doit être une valeur numérique.',
            'amount.min' => 'Le montant doit être supérieur à zéro.',
            'expense_date.required' => 'La date de la dépense est requise.',
            'expense_date.date' => 'Veuillez fournir une date valide.',
            'category_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
            'paid_by.required' => 'Vous devez spécifier qui a payé la dépense.',
            'paid_by.exists' => 'L\'utilisateur sélectionné n\'existe pas.'
        ];
    }
}
