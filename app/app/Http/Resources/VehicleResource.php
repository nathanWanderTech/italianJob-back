<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'brand' => $this->brand,
            'total_traveled_distance' => $this->total_traveled_distance,
            'daily_traveled_distance' => $this->daily_traveled_distance,
            'owner_id' => $this->owner_id,
        ];
    }
}
