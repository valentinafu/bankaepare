<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function moderator() {
        return $this->belongsTo(User::class);
    }
}
