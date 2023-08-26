<?php

namespace App\Http\Resources\ScheduleTime;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleTimeResource extends JsonResource
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
            'color' => $this->color,
            'code' => $this->code,
            'grace_in' => $this->grace_in,
            'grace_out' => $this->grace_out,
            'flexible' => $this->flexible,
            'organization' => $this->organization,
            'scheduleLocation' => $this->scheduleLocation,
            'created_at' => $this->created_at->format('M d Y'),
            'updated_at' => $this->updated_at->format('M d Y'),
        ];
    }
}
