<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'category_name' => $this->category ? $this->category->name : null,
            'startdatetime' => $this->startdatetime,
            'enddatetime' => $this->enddatetime,
            'ticketsavailable' => $this->ticketsavailable,
            'price' => $this->price,
            'location_type' => $this->location_type,
            'link_url' => $this->link_url,
            'location_id' => $this->location_id,
            'location_county' => $this->location ? $this->location->county : null,
            'location_description' => $this->location_description,
            'img_url' => $this->img_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

    }
}
