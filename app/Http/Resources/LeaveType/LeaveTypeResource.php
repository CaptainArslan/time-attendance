<?php

namespace App\Http\Resources\LeaveType;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaveTypeResource extends JsonResource
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
            'code' => $this->code,
            'description' => $this->description,
            'arabic_description' => $this->arabic_description,
            'is_official' => $this->is_official != false ? true : false,
            'is_need_approval' => $this->is_need_approval != false ? true : false,
            'created_at' => $this->created_at->format('M d Y'),
            'updated_at' => $this->updated_at->format('M d Y'),
        ];
    }
}
