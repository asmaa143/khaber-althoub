<?php

namespace App\Http\Controllers\Api;

use App\Enum\WeekDaysEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\AllReservationResource;
use App\Http\Resources\AvailableTimeResource;

use App\Mail\ReservationMail;
use App\Models\Reservation;
use App\Models\WorkDay;
use App\Models\WorkHour;
use App\Traits\ApiTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ReservationController extends Controller
{
    use ApiTrait;

    public function index(Request $request){

        if($request->token =='A0DA959F6DD349A1867F37BA6AEBA2D5') {
            $reservations=Reservation::get();
            return $this->returnData('Data',AllReservationResource::collection($reservations),'All Reservation');
        }else{
            return $this->returnError(404,'Invalid');
        }



    }

    public function available_date (Request $request){
        date_default_timezone_set('Asia/Riyadh');

        $date = $request->date;
        $day= Carbon::parse($date)->dayName;
        $day_const= WeekDaysEnum::getConstantByName(strtoupper($day));
        $date1 =Carbon::parse(Carbon::now());
        $date2 = Carbon::parse($request->date);
        $result = $date1->gt($date2);
        if($day==Carbon::parse(Carbon::now())->dayName && Carbon::parse($request->date)->format('d-m-y')== Carbon::now()->format('d-m-y')){
            $work_day=WorkDay::where('week_day',$day_const)->where('is_active',1)
                -> with(['workHours' => fn($query) => $query->where('open',1)->whereTime('from', '<=', now())
                    ->whereTime('to', '>=', now())
                    ->orWhere(function ($q)  {
                        $q ->whereTime('from', '>=', now())
                            ->whereTime('to', '>=', now());
                    })
                ])
                ->get();
        }else if($result == false){
            $work_day=WorkDay::where('week_day',$day_const)->where('is_active',1)
                -> with(['workHours' => fn($query) => $query->where('open',1)
                ])
                ->get();
        }else{
            $work_day=[];
        }


        return $this->returnData('Data',AvailableTimeResource::collection($work_day),'Available Time');

    }

    public function appointment(Request $request){




        $reservation=Reservation::create([
            'user_name'=>$request->user_name,
            'user_phone'=>$request->user_phone,
            'area'=>$request->area,
            'date'=>$request->date,
            'from'=>$request->from,
            'to'=>$request->to,
            'items'=>$request->items,
            'status'=>'Pending',
            'work_hour_id'=>$request->timing_id
        ]);

        $work_hour=WorkHour::find($request->timing_id);
        $work_hour->update([
            'open'=>0
        ]);

        $job=(new \App\Jobs\Reservation($reservation));
        dispatch($job);
        return $this->returnSuccessMessage('Reservation Success');
    }

    public function changeStatus(Request $request){
        if($request->token =='A0DA959F6DD349A1867F37BA6AEBA2D5'){
            $reserve=Reservation::find($request->reservation_id);
            $reserve->update([
                'status'=>$request->status,
            ]);
            if($reserve->status=='Reject'){
               $reserve->workHour->update([
                  'open'=>1
               ]);

               $reserve->delete();
            }
            return $this->returnSuccessMessage('Status Change Success');
        }else{
            return $this->returnError(404,'Invalid');
        }

    }
}
