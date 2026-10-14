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
        Schema::table('data_mahasiswa', function (Blueprint $table) {
            $table->foreign(['id_tahun_akademik'], 'data_mahasiswa_id_tahun_akademik_fkey')->references(['id'])->on('tahun_akademik')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['nim'], 'data_mahasiswa_nim_fkey')->references(['nim'])->on('mahasiswa')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_mahasiswa', function (Blueprint $table) {
            $table->dropForeign('data_mahasiswa_id_tahun_akademik_fkey');
            $table->dropForeign('data_mahasiswa_nim_fkey');
        });
    }
};
