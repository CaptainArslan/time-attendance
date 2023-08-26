<?php

namespace App\Http\Resources\Schedule;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'required_work_hour' => $this->required_work_hour,
            'is_open_shift' => $this->is_open_shift,
            'is_night_shift' => $this->is_night_shift,
            'created_at' => $this->created_at->format('M d Y'),
            'updated_at' => $this->updated_at->format('M d Y'),
        ];
        // return parent::toArray($request);
    }
}
