<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperPersonnelAdministratif
 */
class PersonnelAdministratif extends User
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function roles(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function paiements(): HasMany
    {
        return $this->hasMany(Paiement::class);
    }

    public function annonces(): HasMany
    {
        return $this->hasMany(Annonce::class);
    }

    public function isAdmin(): bool
    {
        return $this->roles->nom === 'Administrateur';
    }

    public function isComptable(): bool
    {
        return $this->roles->nom === 'Comptable';
    }

    public function isSecretaire(): bool
    {
        return $this->roles->nom === 'Secrétaire';
    }
}
