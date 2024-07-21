<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperEtudiant
 */
class Etudiant extends User
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paiements(): HasMany
    {
        return $this->hasMany(Paiement::class);
    }

    public function reclamations(): HasMany
    {
        return $this->hasMany(Reclamation::class);
    }

    public function filieres(): BelongsTo
    {
        return $this->belongsTo(Filiere::class);
    }

    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class)
            ->withPivot('note_examen', 'note_classe')
            ->withTimestamps();
    }
}
