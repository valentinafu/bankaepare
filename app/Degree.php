<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Degree extends Model
{
    public function faculty() {
        return $this->belongsTo(Faculty::class);
    }

    public function subjects() {
        return $this->hasMany(Subject::class);
    }

    public function moderator() {
        $moderator_id = DB::table('moderator_degrees')->where('degree_id', '=', $this->id)->pluck('moderator_id')[0];
        return User::where('id', $moderator_id)->first();
    }
}
