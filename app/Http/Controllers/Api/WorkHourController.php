<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AvailableTimeResource;
use App\Http\Resources\WorkTimeResource;
use App\Models\WorkTime;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class WorkHourController extends Controller
{
    use ApiTrait;
    public function index(){
        $work=WorkTime::all();
        return $this->returnData('Data',WorkTimeResource::collection($work),'Working Time');
    }
}
