<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RamdanScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'description'=>$this->description,
            'arabic_description'=>$this->arabic_description,
            'from_date'=>date('M d Y',strtotime($this->from_date)),
            'to_date'=>date('M d Y',strtotime($this->to_date)),
            'created_at'=>$this->created_at->format('M d Y'),
            'updated_at'=>$this->updated_at->format('M d Y')
        ];
    }
}
