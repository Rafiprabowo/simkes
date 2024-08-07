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
        Schema::create('doctor_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors')->ondelete('cascade');
            $table->string('date');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->enum('status', ['available', 'reserved', 'cancelled'])->default('available');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->ondelete('set null');
            $table->timestamps();
            $table->unique(['doctor_id', 'start_time', 'end_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_schedules');
    }
};
