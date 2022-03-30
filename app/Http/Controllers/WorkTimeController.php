<?php

namespace App\Http\Controllers;

use App\Models\WorkTime;
use Illuminate\Http\Request;

class WorkTimeController extends Controller
{
   public function index(){
       $work_time=WorkTime::all();
       return view('work.index',compact('work_time'));
   }
    public function create(){
        return view('work.create');
    }
    public function store(Request $request){

       WorkTime::create($request->all());
        return redirect()->route('work-time.index');

    }
    public function edit($id){
       $work_time=WorkTime::findOrFail($id);
        return view('work.edit',compact('work_time'));
    }
    public function update(Request $request,$id){
        $work_time=WorkTime::findOrFail($id);
        $work_time->update($request->all());
        return redirect()->route('work-time.index');
    }
}
