<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Fleet
 *
 * @property int $id
 * @property string $name
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tracker[] $trackers
 * @property-read int|null $trackers_count
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Fleet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Fleet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Fleet query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Fleet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Fleet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Fleet whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Fleet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Fleet whereUserId($value)
 * @mixin \Eloquent
 */
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
