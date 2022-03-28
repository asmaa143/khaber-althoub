<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkHour extends Model
{
    use HasFactory;
    protected $table='work_days';
    public $timestamps = true;
    protected $fillable=['working_day_id','from','to'];
}
