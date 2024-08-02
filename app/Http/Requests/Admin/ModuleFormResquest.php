<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ModuleFormResquest extends FormRequest
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
            'nom_module' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'professeur_id' => ['required', 'string', 'exists:professeurs,id'],
            'filiere_id' => ['required', 'string', 'exists:filieres,id'],
        ];
    }
}
