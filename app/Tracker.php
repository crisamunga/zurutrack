<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tracker extends Model
{
    protected $fillable = ['name', 'serial', 'tracker_model_id', 'added_by_id'];

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

    public function users()
    {
        return $this->belongsToMany(User::class, 'tracker_user', 'tracker_id', 'user_id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::creating(function (Tracker $tracker) {
            $tracker->expires_on = now()->addDays(3);
        });
    }

    /**
     * Scope a query to only include trackers added by specific user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param \App\User $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAddedBy($query, User $user)
    {
        return $query->where('added_by', $user->id);
    }
}
