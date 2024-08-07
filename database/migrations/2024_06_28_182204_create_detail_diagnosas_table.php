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
        Schema::create('detail_diagnosas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_diagnosis');
            $table->foreign('id_diagnosis')->references('id')->on('diagnoses');
            $table->unsignedBigInteger('id_medicine');
            $table->foreign('id_medicine')->references('id')->on('medicines');
            $table->string('dosis_obat');
            $table->timestamps();
            $table->primary(['id_diagnosis', 'id_medicine']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_diagnosas');
    }
};
