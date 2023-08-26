<?php

namespace App\Http\Resources\PermissionType;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionTypeResource extends JsonResource
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
            'max_permission' => $this->max_permission,
            'max_minute' => $this->max_minute,
            'is_official' => $this->is_official != false ? true : false,
            'is_group_apply' => $this->is_group_apply != false ? true : false,
            'created_at' => $this->created_at->format('M d Y'),
            'reason' => $this->reason,
            'updated_at' => $this->updated_at->format('M d Y'),
        ];
    }
}
