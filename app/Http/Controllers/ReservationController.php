<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
   public function index(){
       $reservation=Reservation::all();
       return view('reservations.index',compact('reservation'));
   }
   public function accept($id){
       $reservation=Reservation::find($id);
       $reservation->update([
           'status'=>'Accept'
       ]);
       return redirect()->route('reservation');

   }

    public function reject($id){
        $reservation=Reservation::find($id);
        $reservation->update([
            'status'=>'Reject'
        ]);
        $reservation->delete();
        return redirect()->route('reservation');
    }
}
