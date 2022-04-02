<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkTimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $from=(Carbon::parse($this->from)->format('a') == 'am') ? trans('web.am') : trans('web.pm');
        $to=(Carbon::parse($this->to)->format('a') == 'am') ? trans('web.am') : trans('web.pm');
        return [
            'Work_days'=>$this->description,
            'shift_name'=>$this->label,
            'from'=>date('h:i', strtotime($this->from)) . ' '. $from ,
            'to'=>date('h:i', strtotime($this->to)) . ' '. $to ,
        ];
    }
}
