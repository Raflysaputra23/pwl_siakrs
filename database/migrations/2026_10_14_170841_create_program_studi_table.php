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
        Schema::create('program_studi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_prodi', 10)->nullable()->unique('program_studi_kode_prodi_key');
            $table->string('nama_prodi', 100)->nullable();
            $table->string('singkatan', 50)->nullable();
            $table->uuid('id_fakultas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_studi');
    }
};
