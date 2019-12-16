<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Tracker
 *
 * @property int $id
 * @property string $name
 * @property string $serial
 * @property int $online
 * @property int $enabled
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string $added_on
 * @property string $expires_on
 * @property int|null $tracker_model_id
 * @property int|null $added_by_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $added_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Fleet[] $fleets
 * @property-read int|null $fleets_count
 * @property-read \App\TrackerModel|null $tracker_model
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tracker addedBy(\App\User $user)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tracker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tracker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tracker query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tracker whereAddedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tracker whereAddedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tracker whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tracker whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tracker whereExpiresOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tracker whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tracker whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tracker whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tracker whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tracker whereOnline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tracker whereSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tracker whereTrackerModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tracker whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
