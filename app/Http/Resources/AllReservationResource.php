<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AllReservationResource extends JsonResource
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
            'user_name'=>$this->user_name,
            'user_phone '=>$this->user_phone ,
            'area'=>$this->area,
            'date'=>$this->date,
            'from'=>$this->from,
            'to'=>$this->to,
            'items'=>$this->items,
            'status'=>$this->status,
        ];
    }
}
