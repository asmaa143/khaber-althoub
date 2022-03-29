<?php

namespace App\Http\Controllers;

use App\Enum\WeekDaysEnum;
use App\Models\WorkDay;
use Illuminate\Http\Request;
use ReflectionClass;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $work_days=WorkDay::with('workHours')->get();
        return view('appointment.index',compact('work_days'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('appointment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        foreach ((new ReflectionClass(WeekDaysEnum::class))->getConstants() as $day_name => $day_value) {
            WorkDay::create([
                'week_day'=>$day_value,
                'is_active'=>1,
            ]);
        }
        $work_days=WorkDay::get();
        if($request->type=='every_day'){
            foreach ($work_days as $day){
                for ($i = 0; $i < count($request->from); $i++) {
                     $day->workHours()->create([
                            'from'=>$request->from[$i],
                            'to'=>$request->to[$i],
                            'open'=>1,
                        ]);
                }

            }
        }else{
            foreach ($work_days as $day){
                $day->update([
                    'is_active' => isset($request->{'is_active_'. $day->week_day}) ? 1 : 0,
                ]);
                for ($i = 0; $i < count($request->{'from_'.$day->week_day}); $i++) {
                    $day->workHours()->create([
                        'from'=>(isset($request->{'from_'. $day->week_day}[$i]) && isset($request->{'is_active_'. $day->week_day}) ) ? $request->{'from_'. $day->week_day}[$i] : null,
                        'to'=>(isset($request->{'to_'. $day->week_day}[$i]) && isset($request->{'is_active_'. $day->week_day}) ) ? $request->{'to_'. $day->week_day}[$i] : null,
                        'open'=>1,
                    ]);
                }

            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkDay $day)
    {
        return view('appointment.edit',compact('day'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
