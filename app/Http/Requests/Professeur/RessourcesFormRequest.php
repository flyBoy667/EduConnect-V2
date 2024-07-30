<?php

namespace App\Http\Requests\Professeur;

use Illuminate\Foundation\Http\FormRequest;

class RessourcesFormRequest extends FormRequest
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
            'nom' => 'required|string|min:3',
            'module_id' => 'required|exists:modules,id',
            'professeur_id' => 'required|exists:professeurs,id',
            'fichier' => 'file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
        ];
    }
}
