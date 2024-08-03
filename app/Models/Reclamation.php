<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperReclamation
 */
class Reclamation extends BaseModel
{
    public function professeur(): BelongsTo
    {
        return $this->belongsTo(Professeur::class);
    }

    public function etudiant(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

}
