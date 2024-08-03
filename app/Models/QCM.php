<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QCM extends BaseModel
{
    use HasFactory;

    public function questions()
    {
        return $this->hasMany(Question::class, 'qcm_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
