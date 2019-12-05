<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrackerModel extends Model
{
    public function trackers()
    {
        return $this->hasMany(Tracker::class, 'tracker_model_id');
    }
}
