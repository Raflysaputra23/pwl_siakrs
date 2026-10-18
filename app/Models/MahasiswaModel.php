<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'nim',
        'id_user',
        'id_program_studi',
        'dosen_pa_nip',
        'nama_lengkap',
        'tgl_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'email',
        'no_telp',
        'alamat',
        'angkatan',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function getUser()
    {
        return $this->user();
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudiModel::class, 'id_program_studi');
    }

    public function dosenPa()
    {
        return $this->belongsTo(DosenModel::class, 'dosen_pa_nip', 'nip');
    }

    public function riwayatAkademik()
    {
        return $this->hasMany(DataMahasiswaModel::class, 'nim', 'nim');
    }

    public function dataAkademikAktif()
    {
        return $this->hasOne(DataMahasiswaModel::class, 'nim', 'nim')
            ->whereHas('tahunAkademik', function ($query) {
                $query->where('status', 'aktif');
            });
    }

    public function dataAkademikTerbaru()
    {
        return $this->hasOne(DataMahasiswaModel::class, 'nim', 'nim')
            ->orderBy('semester', 'desc')
            ->orderBy('created_at', 'desc');
    }

    public function getNpmAttribute()
    {
        return $this->attributes['nim'] ?? null;
    }

    public function getNamaAttribute()
    {
        return $this->attributes['nama_lengkap'] ?? null;
    }

    public function getKelasAttribute()
    {
        return 'A';
    }

    public function getSemesterAttribute()
    {
        $aktif = $this->dataAkademikAktif ?? $this->dataAkademikTerbaru;
        return $aktif ? $aktif->semester : 1;
    }

    public static function getAllMahasiswa()
    {
        return self::with(['user', 'programStudi', 'dosenPa'])->orderBy('created_at', 'desc')->get();
    }

    public static function createMahasiswa(array $data)
    {
        return self::create($data);
    }

    public static function updateMahasiswa(string $nim, array $data)
    {
        return self::where('nim', $nim)->update($data);
    }

    public static function deleteMahasiswa(string $nim)
    {
        return self::where('nim', $nim)->delete();
    }
}
