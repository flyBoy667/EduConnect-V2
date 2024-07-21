<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperAnnonce
 */
class Annonce extends BaseModel
{
    public function PersonnelAdministratif(): BelongsTo
    {
        return $this->belongsTo(PersonnelAdministratif::class);
    }

    public function professeur(): BelongsTo
    {
        return $this->belongsTo(Professeur::class);
    }

}
