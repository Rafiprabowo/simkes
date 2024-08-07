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
        Schema::create('detail_pemeriksaans', function (Blueprint $table) {
            $table->unsignedBigInteger('id_medical_check_up');
            $table->foreign('id_medical_check_up')->references('id')->on('medical_check_ups')->cascadeOnDelete();
            $table->unsignedBigInteger('id_pemeriksaan_minor');
            $table->foreign('id_pemeriksaan_minor')->references('id')->on('pemeriksaan_minors')->cascadeOnDelete();
            $table->string('result');
            $table->timestamps();
            $table->primary(['id_medical_check_up', 'id_pemeriksaan_minor']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pemeriksaans');
    }
};
