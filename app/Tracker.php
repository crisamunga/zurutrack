<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    protected $fillable = ['name', 'serial', 'model', 'added_on', 'client_id', 'added_by_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function added_by()
    {
        return $this->belongsTo(User::class, 'added_by_id');
    }

    public function fleets()
    {
        return $this->belongsToMany(Fleet::class, 'fleet_tracker', 'tracker_id', 'fleet_id');
    }
}
