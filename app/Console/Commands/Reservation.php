<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class Reservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:finish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'finish reservation every one hour';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        date_default_timezone_set('Asia/Riyadh');
       $reservation=\App\Models\Reservation::where('status','Accept')
           ->where(function ($q)  {
               $q ->whereDate('date','<',Carbon::now())
                   ->orWhereTime('to','<',Carbon::now());
           })->get();

       foreach ($reservation as $value){
           $value->update([
               'status'=>'Finish'
           ]);
           $value->workHour->update([
               'open'=>1
           ]);
       }
    }
}