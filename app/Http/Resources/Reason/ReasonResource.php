<?php

namespace App\Http\Resources\Reason;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReasonResource extends JsonResource
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
            'reason_mode' => $this->reason_mode,
            'prompt_message' => $this->prompt_message,
            'is_web_punch' => $this->is_web_punch != false ? true : false,
            'created_at' => $this->created_at->format('M d Y'),
            'updated_at' => $this->updated_at->format('M d Y'),
        ];
    }
}
