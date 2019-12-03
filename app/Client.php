<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function trackers()
    {
        return $this->hasMany(Tracker::class);
    }

    public function added_by()
    {
        return $this->belongsTo(User::class, 'added_by_id');
    }
}
