<?php

namespace App\Http\Resources\Grade;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GradeResource extends JsonResource
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
            'is_overtime_eligible' => $this->is_overtime_eligible != false ? true : false,
            'is_senior_employee' => $this->is_senior_employee != false ? true : false,
            'created_at' => $this->created_at->format('M d Y'),
            'updated_at'=>$this->updated_at->format('M d Y')
        ];
    }
}
