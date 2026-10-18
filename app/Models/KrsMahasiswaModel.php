<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class KrsMahasiswaModel extends Model
{
    use HasUuids;

    protected $table = 'krs_mahasiswa';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_data_mahasiswa',
        'dosen_pa_nip',
        'status',
    ];

    public function dataMahasiswa()
    {
        return $this->belongsTo(DataMahasiswaModel::class, 'id_data_mahasiswa', 'id');
    }

    public function dosenPa()
    {
        return $this->belongsTo(DosenModel::class, 'dosen_pa_nip', 'nip');
    }

    public function krsItems()
    {
        return $this->hasMany(KrsModel::class, 'id_krs_mahasiswa', 'id');
    }

    public function getMahasiswaAttribute()
    {
        return $this->dataMahasiswa ? $this->dataMahasiswa->mahasiswa : null;
    }

    public function getTotalSksAttribute()
    {
        return $this->krsItems->sum(function ($item) {
            return $item->kelas && $item->kelas->mataKuliah ? $item->kelas->mataKuliah->sks : 0;
        });
    }

    public static function getPengajuanByDosen(string $nipDosen, ?string $idTahunAkademik = null)
    {
        $query = self::with([
            'dataMahasiswa.mahasiswa.programStudi',
            'dataMahasiswa.tahunAkademik',
            'krsItems.kelas.mataKuliah',
            'dosenPa'
        ])->where('dosen_pa_nip', $nipDosen);

        if ($idTahunAkademik) {
            $query->whereHas('dataMahasiswa', function ($q) use ($idTahunAkademik) {
                $q->where('id_tahun_akademik', $idTahunAkademik);
            });
        }

        return $query->latest()->get();
    }
}
