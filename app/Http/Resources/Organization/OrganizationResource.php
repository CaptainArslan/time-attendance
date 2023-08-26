<?php

namespace App\Http\Resources\Organization;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
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
            'created_at' => $this->created_at->format('M d Y'),
            'organizationType' => $this->organizationType,
            'mainOrganization' => $this->mainOrganization,
            'updated_at' => $this->updated_at->format('M d Y'),
        ];
    }
}
