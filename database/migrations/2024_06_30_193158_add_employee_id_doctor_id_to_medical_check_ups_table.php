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
        Schema::table('medical_check_ups', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('id_employee');
            $table->foreign('id_employee')->references('id')->on('employees')->onDelete('cascade');
            $table->unsignedBigInteger('id_doctor');
            $table->foreign('id_doctor')->references('id')->on('doctors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_check_ups', function (Blueprint $table) {
            //
            $table->dropForeign('id_employee');
            $table->dropForeign('id_doctor');
            $table->dropColumn('id_employee');
            $table->dropColumn('id_doctor');
        });
    }
};
