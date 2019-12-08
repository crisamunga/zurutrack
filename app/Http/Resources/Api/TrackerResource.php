<?php

namespace App\Http\Resources\Api;

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
            "model" => $this->model,
            "added_on" => $this->added_on,
            "expires_on" => $this->expires_on,
            "state" => $this->state,
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
