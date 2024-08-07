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
        Schema::table('pemeriksaan_minors', function (Blueprint $table) {
            //
            $table->foreign('id_pemeriksaan_major')
                  ->references('id')
                  ->on('pemeriksaan_majors')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemeriksaan_minors', function (Blueprint $table) {
            //
             $table->dropForeign(['id_pemeriksaan_major']);
        });
    }
};
