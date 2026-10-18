<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class DataMahasiswaModel extends Model
{
    use HasUuids;

    protected $table = 'data_mahasiswa';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nim',
        'id_tahun_akademik',
        'semester',
        'ipk',
        'total_sks',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'nim', 'nim');
    }

    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademikModel::class, 'id_tahun_akademik', 'id');
    }

    public function krsMahasiswa()
    {
        return $this->hasMany(KrsMahasiswaModel::class, 'id_data_mahasiswa', 'id');
    }

    public static function getAkademikAktif(string $nim)
    {
        return self::where('nim', $nim)
            ->whereHas('tahunAkademik', function ($query) {
                $query->where('status', 'aktif');
            })
            ->with(['tahunAkademik', 'mahasiswa'])
            ->first();
    }

    public static function getAkademikTerbaru(string $nim)
    {
        return self::where('nim', $nim)
            ->with(['tahunAkademik', 'mahasiswa'])
            ->orderBy('semester', 'desc')
            ->orderBy('created_at', 'desc')
            ->first();
    }
}
