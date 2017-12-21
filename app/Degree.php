<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    public function faculty() {
        return $this->belongsTo(Faculty::class);
    }

    public function subjects() {
        return $this->hasMany(Subject::class);
    }
}
