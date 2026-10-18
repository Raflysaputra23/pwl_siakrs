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
        Schema::table('krs_mahasiswa', function (Blueprint $table) {
            $table->foreign(['dosen_pa_nip'], 'krs_mahasiswa_dosen_pa_nip_fkey')->references(['nip'])->on('dosen')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_data_mahasiswa'], 'krs_mahasiswa_id_data_mahasiswa_fkey')->references(['id'])->on('data_mahasiswa')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('krs_mahasiswa', function (Blueprint $table) {
            $table->dropForeign('krs_mahasiswa_dosen_pa_nip_fkey');
            $table->dropForeign('krs_mahasiswa_id_data_mahasiswa_fkey');
        });
    }
};
