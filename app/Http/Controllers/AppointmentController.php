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
                for ($i = 0; $i < count($request->from); $i++) {
                     $day->workHours()->updateOrCreate([
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
                    $day->workHours()->updateOrCreate([
                        'from'=>(isset($request->{'from_'. $day->week_day}[$i]) && isset($request->{'is_active_'. $day->week_day}) ) ? $request->{'from_'. $day->week_day}[$i] : null,
                        'to'=>(isset($request->{'to_'. $day->week_day}[$i]) && isset($request->{'is_active_'. $day->week_day}) ) ? $request->{'to_'. $day->week_day}[$i] : null,
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
        $work_day->update([
            'is_active'=>isset($request->is_active)? 1 : 0,
        ]);
        for ($i = 0; $i < count($request->from); $i++) {
            $work_day->workHours()->updateOrCreate([
                'from'=>$request->from[$i],
                'to'=>$request->to[$i],
            ],[
                'from'=>$request->from[$i],
                'to'=>$request->to[$i],
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
