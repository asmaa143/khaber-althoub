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
        date_default_timezone_set('Asia/Riyadh');
        foreach ((new ReflectionClass(WeekDaysEnum::class))->getConstants() as $day_name => $day_value) {
            WorkDay::updateOrCreate([
                'week_day' => $day_value,
            ], [
                'week_day' => $day_value,
                'is_active'=>1
            ]);
        }
        $work_days=WorkDay::get();
        if($request->type=='every_day'){
            foreach ($work_days as $day){
                if(count( $day->workHours)>0){
                    $day->workHours()->delete();
                }
                foreach ($request->from as $key=>$value) {
                    $day->workHours()->updateOrCreate([
                        'from'=>$request->from[$key],
                        'to'=>$request->to[$key],
                        'open'=>1,
                    ]);
                }
            }
        }else{
            foreach ($work_days as $day){
                if(count( $day->workHours)>0){
                    $day->workHours()->delete();
                }
                $day->update([
                    'is_active' => isset($request->{'is_active_'. $day->week_day}) ? 1 : 0,
                ]);
                foreach ($request->{'from_'.$day->week_day} as $key=>$value) {
                    $day->workHours()->updateOrCreate([
                        'from'=>(isset($request->{'from_'. $day->week_day}[$key]) && isset($request->{'is_active_'. $day->week_day}) ) ? $request->{'from_'. $day->week_day}[$key] : null,
                        'to'=>(isset($request->{'to_'. $day->week_day}[$key]) && isset($request->{'is_active_'. $day->week_day}) ) ? $request->{'to_'. $day->week_day}[$key] : null,
                        'open'=>1,
                    ]);
                }
            }
        }
        return redirect()->route('appointment.index');
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
    public function edit($id)
    {
        $day=WorkDay::with('workHours')->findOrFail($id);
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
        date_default_timezone_set('Asia/Riyadh');
        $work_day=WorkDay::findOrFail($id);
        $work_day->workHours()->delete();
        $work_day->update([
            'is_active'=>isset($request->is_active)? 1 : 0,
        ]);
        foreach ($request->from as $key=>$value) {
            $work_day->workHours()->create([
                'from'=>$request->from[$key],
                'to'=>$request->to[$key],
            ]);
        }
        return redirect()->route('appointment.index');
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
