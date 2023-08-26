<?php

namespace App\Http\Resources\Schedule;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ScheduleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {

    	  return [
            'status' => true,
            'message' => 'Record Found',
            'data' => $this->collection,
        ];
       // return parent::toArray($request);
    }
}
