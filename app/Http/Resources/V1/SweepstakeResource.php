<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SweepstakeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'image_card' => $this->image_card,
            'image_page' => $this->image_page,
            'price' => $this->price,
            'minimum_amount' => $this->minimum_amount,
            'status' => $this->status,
            'number_of_quotas' => $this->number_of_quotas,
            'remaining_blocks' => $this->remaining_blocks,
            'is_active' => $this->is_active,
            'affiliates' => $this->affiliates,
            'affiliates_percent' => $this->affiliates_percent,
            'affiliates_type' => $this->affiliates_type,
            'draw_date' => $this->draw_date,
            'event_date' => $this->event_date,
    ];

    }
}
