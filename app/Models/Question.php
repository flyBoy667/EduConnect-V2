<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends BaseModel
{
    use HasFactory;

    public function qcm()
    {
        return $this->belongsTo(QCM::class, 'qcm_id');
    }

    public function options(): HasMany
    {
        return $this->hasMany(Option::class, 'question_id');
    }
}
