<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ProfesseurFormRequest extends FormRequest
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
            'nom' => ['required', 'string', 'min:3'],
            'prenom' => ['required', 'string', 'min:3'],
            'login' => ['required', 'string', 'min:3', 'unique:users,login'],
            'email' => ['required', 'string', 'email', 'min:5', 'unique:users,email'],
            'telephone' => ['required', 'string', 'max:8', 'min:8'],
            'specialites' => ['required', 'string', 'min:2']
        ];
    }

    protected function prepareForValidation(): void
    {
        //un mot de passe par défaut
//        $this->merge(['password' => Hash::make('123')]);
    }
}
