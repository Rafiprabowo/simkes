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
        Schema::create('patient_queues', function (Blueprint $table) {
        $table->id();
        $table->string('patient_name');
        $table->unsignedBigInteger('schedule_doctors_id');
        $table->time('appointment_time');
        $table->foreign('schedule_doctors_id')->references('id')->on('schedule_doctors');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_queues');
    }
};
