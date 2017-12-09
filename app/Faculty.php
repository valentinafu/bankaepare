<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    public function degrees() {
        return $this->hasMany(Degree::class);
    }
}
