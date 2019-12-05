<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    protected $fillable = ['name', 'serial', 'model', 'added_on', 'client_id', 'added_by_id'];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function added_by()
    {
        return $this->belongsTo(User::class, 'added_by_id');
    }

    public function fleets()
    {
        return $this->belongsToMany(Fleet::class, 'fleet_tracker', 'tracker_id', 'fleet_id');
    }

    public function tracker_model()
    {
        return $this->belongsTo(TrackerModel::class, 'tracker_model_id');
    }
}
