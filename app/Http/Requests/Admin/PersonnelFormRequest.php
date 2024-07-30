<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PersonnelFormRequest extends FormRequest
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
        $userId = $this->route('personnel') ? $this->route('personnel')->user->id : null;

        return [
            'nom' => ['required', 'string', 'min:3'],
            'prenom' => ['required', 'string', 'min:3'],
            'login' => ['required', 'string', 'min:3', Rule::unique('users', 'login')->ignore($userId)],
            'email' => ['required', 'string', 'email', 'min:5', Rule::unique('users', 'email')->ignore($userId)],
            'telephone' => ['required', 'string', 'min:10', Rule::unique('users', 'telephone')->ignore($userId)],
            'role_id' => ['required', 'integer', 'exists:role,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'], // Ajout de contraintes pour l'image
        ];
    }
}