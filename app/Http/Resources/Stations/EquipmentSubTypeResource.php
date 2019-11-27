<?php

namespace App\Http\Resources\Stations;

use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentSubTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
