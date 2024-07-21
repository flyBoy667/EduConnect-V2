<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperFiliere
 */
class Filiere extends BaseModel
{
    public function etudiants(): HasMany
    {
        return $this->hasMany(Etudiant::class);
    }

    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class, 'filiere_module')->withTimestamps();
    }
}
