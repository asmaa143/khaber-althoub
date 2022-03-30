<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('available-date',[\App\Http\Controllers\Api\ReservationController::class,'available_date']);
Route::post('appointment',[\App\Http\Controllers\Api\ReservationController::class,'appointment']);
Route::get('work-hour',[\App\Http\Controllers\Api\WorkHourController::class,'index']);
Route::get('all-reservation',[\App\Http\Controllers\Api\ReservationController::class,'index']);
