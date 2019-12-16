<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TrackerModel
 *
 * @property int $id
 * @property string $name
 * @property string $protocol
 * @property string|null $configuration_instructions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tracker[] $trackers
 * @property-read int|null $trackers_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TrackerModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TrackerModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TrackerModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TrackerModel whereConfigurationInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TrackerModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TrackerModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TrackerModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TrackerModel whereProtocol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TrackerModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TrackerModel extends Model
{
    protected $fillable = ['name', 'protocol', 'configuration_instructions'];
    
    public function trackers()
    {
        return $this->hasMany(Tracker::class, 'tracker_model_id');
    }
}
