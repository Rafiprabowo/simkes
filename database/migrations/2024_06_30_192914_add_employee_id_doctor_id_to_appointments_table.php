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
        Schema::table('appointments', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            //
            $table->dropForeign('doctor_id');
            $table->dropForeign('employee_id');
            $table->dropColumn('doctor_id');
            $table->dropColumn('employee_id');
        });
    }
};
