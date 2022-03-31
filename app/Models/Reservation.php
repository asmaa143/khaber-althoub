<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='reservations';
    public $timestamps = true;
    protected $fillable=['user_name','user_phone','area','date','from','to','items','status','work_hour_id'];

    public function workHour(){
        return $this->belongsTo(WorkHour::class,'work_hour_id','id');
    }
}
