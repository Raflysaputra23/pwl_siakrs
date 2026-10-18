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
        Schema::table('krs', function (Blueprint $table) {
            $table->foreign(['id_kelas'], 'krs_id_kelas_fkey')->references(['id'])->on('kelas')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_krs_mahasiswa'], 'krs_id_krs_mahasiswa_fkey')->references(['id'])->on('krs_mahasiswa')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('krs', function (Blueprint $table) {
            $table->dropForeign('krs_id_kelas_fkey');
            $table->dropForeign('krs_id_krs_mahasiswa_fkey');
        });
    }
};
