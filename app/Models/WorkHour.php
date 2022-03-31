<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkHour extends Model
{
    use HasFactory;
    protected $table='work_hours';
    public $timestamps = true;
    protected $fillable=['work_day_id','from','to','open'];

    public function workDay(){
        return $this->belongsTo(WorkDay::class,'work_day_id','id');
    }

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }
}
