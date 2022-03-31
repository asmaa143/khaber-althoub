<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorkHourIdToReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
           $table->foreignId('work_hour_id')->nullable();
           $table->foreign('work_hour_id')
               ->on('work_hours')
               ->references('id')
               ->onDelete('CASCADE')
               ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
           $table->dropColumn('work_hour_id');
        });
    }
}
