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
          Schema::table('diagnoses', function (Blueprint $table) {
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete()->after('appointment_id');
            $table->foreignId('doctor_id')->constrained('doctors')->cascadeOnDelete()->after('employee_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('diagnoses', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->dropColumn('employee_id');
            $table->dropForeign(['doctor_id']);
            $table->dropColumn('doctor_id');
        });
    }
};
