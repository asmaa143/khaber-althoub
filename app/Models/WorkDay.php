<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkDay extends Model
{
    use HasFactory;
    protected $table='work_days';
    public $timestamps = true;
    protected $fillable=['week_day','is_active'];

    public function workHours(){
        return $this->hasMany(WorkHour::class);
    }
}
