<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
        $userId = $this->route('professeur') ? $this->route('professeur')->user->id : null;

        return [
            'nom' => ['required', 'string', 'min:3'],
            'prenom' => ['required', 'string', 'min:3'],
            'login' => ['required', 'string', 'min:3', Rule::unique('users', 'login')->ignore($userId)],
            'email' => ['required', 'string', 'email', 'min:5', Rule::unique('users', 'email')->ignore($userId)],
            'telephone' => ['required', 'string', 'min:8', Rule::unique('users', 'telephone')->ignore($userId)],
            'specialites' => ['required', 'string', 'min:2'],
            'image' => ['nullable', 'image', 'max:2048'],
        ];
    }

    protected function prepareForValidation(): void
    {
        //un mot de passe par défaut
//        $this->merge(['password' => Hash::make('123')]);
    }
}
