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
        Schema::create('nilai_rujukans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pemeriksaan_minor');
            $table->enum('gender', ['L', 'P']);
            $table->string('reference_value');
            $table->string('satuan');
            $table->timestamps();
            $table->foreign('id_pemeriksaan_minor')->references('id')->on('pemeriksaan_minors')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_rujukans');
    }
};
