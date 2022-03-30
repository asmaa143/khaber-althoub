<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkTime extends Model
{
    use HasFactory;
    protected $table='work_times';
    public $timestamps = true;
    protected $fillable=['morning_time','evening_time','friday'];
}
