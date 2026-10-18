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
        Schema::table('kelas', function (Blueprint $table) {
            $table->foreign(['dosen_koor'], 'kelas_dosen_koor_fkey')->references(['nip'])->on('dosen')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['dosen_pendamping'], 'kelas_dosen_pendamping_fkey')->references(['nip'])->on('dosen')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_mata_kuliah'], 'kelas_id_mata_kuliah_fkey')->references(['id'])->on('mata_kuliah')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropForeign('kelas_dosen_koor_fkey');
            $table->dropForeign('kelas_dosen_pendamping_fkey');
            $table->dropForeign('kelas_id_mata_kuliah_fkey');
        });
    }
};
