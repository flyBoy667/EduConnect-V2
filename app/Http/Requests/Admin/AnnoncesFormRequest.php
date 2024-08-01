<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AnnoncesFormRequest extends FormRequest
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
        $annonceId = $this->route('annonce')?->id ?? null;
        return [
            'titre' => ['required', 'string', 'min:5'],
            'contenu' => ['required', 'string', 'min:10'],
            'image' => ['nullable', 'image', 'max:2048'],
            'dateDebut' => ['required', 'date'],
            'dateFin' => ['required', 'date', 'after:date_debut'],
            'filieres' => 'required|array',
            'filieres.*' => 'exists:filieres,id',
        ];
    }
}
