<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TrackerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            "id" => $this->id,
            "name" => $this->name,
            "serial" => $this->serial,
            "tracker_model" => new TrackerModelResource($this->tracker_model),
            "added_on" => Carbon::parse($this->added_on)->isoFormat('D MMM Y'),
            "expires_on" => Carbon::parse($this->expires_on)->isoFormat('D MMM Y'),
            "state" => $this->state ?? "Offline",
            "last_known_location" => !($this->latitude && $this->longitude) ? null : [
                    "lat" => $this->latitude,
                    "lng" => $this->longitude
                ]
            ];
        if (isset($this->pivot) && isset($this->pivot->is_admin)) {
            $data['is_admin'] = $this->pivot->is_admin;
        }
        return $data;
    }
}
