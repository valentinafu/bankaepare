<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
