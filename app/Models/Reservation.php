<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table='reservations';
    public $timestamps = true;
    protected $fillable=['user_name','user_phone','area','date','from','to','items','status'];
}
