<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_program_studi');
            $table->string('kode_mk', 10)->nullable()->unique('mata_kuliah_kode_mk_key');
            $table->string('nama_mk', 100)->nullable();
            $table->enum('jenis', ['wajib','peminatan'])->nullable();
            $table->integer('semester')->nullable();
            $table->integer('sks')->nullable();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_kuliah');
    }
};
