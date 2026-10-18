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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->char('nim', 10)->primary();
            $table->uuid('id_user')->unique('mahasiswa_id_user_key');
            $table->uuid('id_program_studi')->nullable();
            $table->char('dosen_pa_nip', 20)->nullable();
            $table->string('nama_lengkap', 200)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->text('tempat_lahir')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable();
            $table->string('email', 200)->nullable();
            $table->string('no_telp', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->string('angkatan', 10)->nullable();
            $table->enum('status', ['aktif', 'lulus', 'cuti','keluar'])->default('aktif');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
