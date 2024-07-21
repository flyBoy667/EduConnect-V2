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
 * @mixin IdeHelperProfesseur
 */
class Professeur extends User
{
    protected $casts = [
        'specialites' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class)
            ->withTimestamps();
    }

    public function reclamations(): HasMany
    {
        return $this->hasMany(Reclamation::class);
    }

    public function annonces(): HasMany
    {
        return $this->hasMany(Annonce::class);
    }

    public function ressources(): HasMany
    {
        return $this->hasMany(Ressource::class);
    }
}
