<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AvailableTimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'Day'=>array_flip((new \ReflectionClass(\App\Enum\WeekDaysEnum::class))->getConstants())[$this->week_day],
            'timing'=>TimeResource::collection($this->workHours)
        ];
    }
}
