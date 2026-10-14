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
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->foreign(['dosen_pa_nip'], 'mahasiswa_dosen_pa_nip_fkey')->references(['nip'])->on('dosen')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_user'], 'mahasiswa_id_user_fkey')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropForeign('mahasiswa_dosen_pa_nip_fkey');
            $table->dropForeign('mahasiswa_id_user_fkey');
        });
    }
};
