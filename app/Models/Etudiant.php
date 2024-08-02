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

    public function filiere(): BelongsTo
    {
        return $this->belongsTo(Filiere::class);
    }

    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class)
            ->withPivot('note_examen', 'note_classe')
            ->withTimestamps();
    }

    public function getAverageForModule(Module $module): float
    {
        $pivot = $this->modules()->where('module_id', $module->id)->first()->pivot ?? null;

        if ($pivot) {
            $noteExamen = $pivot->note_examen ?? 0;
            $noteClasse = $pivot->note_classe ?? 0;

            return ($noteExamen + $noteClasse) / 2;
        }

        return 0;
    }

    public function getAverage(): float
    {
        $total = 0;
        $count = 0;

        foreach ($this->modules as $module) {
            $average = $this->getAverageForModule($module);
            if ($average > 0) {
                $total += $average;
                $count++;
            }
        }

        return $count > 0 ? $total / $count : 0;
    }

}
