<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    protected $fillable = ['name', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trackers()
    {
        return $this->belongsToMany(Tracker::class, 'fleet_tracker', 'fleet_id', 'tracker_id');
    }
}
