<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperModule
 */
class Module extends BaseModel
{
    public function professeurs()
    {
        return $this->belongsToMany(Professeur::class)
            ->withTimestamps();
    }

    public function filiere(): BelongsToMany
    {
        return $this->belongsToMany(Filiere::class);
    }

    public function reclamations(): HasMany
    {
        return $this->hasMany(Reclamation::class);
    }

    public function ressources(): HasMany
    {
        return $this->hasMany(Ressource::class);
    }

    public function etudiants(): BelongsToMany
    {
        return $this->belongsToMany(Etudiant::class)
            ->withPivot('note_examen', 'note_classe')
            ->withTimestamps();
    }

}
