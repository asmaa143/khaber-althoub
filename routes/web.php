<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/reservation', [App\Http\Controllers\ReservationController::class, 'index'])->name('reservation');
    Route::resource('appointment', App\Http\Controllers\AppointmentController::class);
    Route::resource('work-time', App\Http\Controllers\WorkTimeController::class);
});

