<?php

namespace App\Http\Controllers\Api;

use App\Enum\WeekDaysEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\AvailableTimeResource;
use App\Models\Reservation;
use App\Models\WorkDay;
use App\Models\WorkHour;
use App\Traits\ApiTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ReservationController extends Controller
{
    use ApiTrait;
    public function index(){
        $reservations=Reservation::all();
        return $this->returnData('Data',$reservations,'All Reservation');
    }

    public function available_date (Request $request){
        date_default_timezone_set('Asia/Riyadh');

        $date = $request->date;
        $day= Carbon::parse($date)->dayName;
        $day_const= WeekDaysEnum::getConstantByName(strtoupper($day));

        if($day==Carbon::parse(Carbon::now())->dayName){
            $work_day=WorkDay::where('week_day',$day_const)->where('is_active',1)
                -> with(['workHours' => fn($query) => $query->where('open',1)->whereTime('from', '<=', now())
                    ->whereTime('to', '>=', now())
                ])
                ->get();
        }else{

            $work_day=WorkDay::where('week_day',$day_const)->where('is_active',1)
                -> with(['workHours' => fn($query) => $query->where('open',1)
                ])
                ->get();
        }


        return $this->returnData('Data',AvailableTimeResource::collection($work_day),'Available Time');

    }

    public function appointment(Request $request){

        $reservation=Reservation::create([
            'user_name'=>$request->user_name,
            'user_phone'=>$request->user_name,
            'area'=>$request->area,
            'date'=>$request->date,
            'from'=>$request->from,
            'to'=>$request->to,
            'items'=>$request->items,
            'status'=>'Accept',
        ]);

        $work_hour=WorkHour::find($request->timing_id);
        $work_hour->update([
            'open'=>0
        ]);
        return $this->returnSuccessMessage('Reservation Success');
    }
}
