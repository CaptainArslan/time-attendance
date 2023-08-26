<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedule_time_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('schedule_time_id');
            $table->time('time_in');
            $table->time('time_out');
            $table->integer('required_work_hour');
            $table->boolean('is_open_shift')->default(0);
            $table->boolean('is_night_shift')->default(0);
            $table->foreign('schedule_time_id')->references('id')->on('schedule_times')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_time_details');
    }
};
