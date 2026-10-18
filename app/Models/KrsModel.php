<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class KrsModel extends Model
{
    use HasUuids;

    protected $table = 'krs';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_krs_mahasiswa',
        'id_kelas',
    ];

    public function krsMahasiswa()
    {
        return $this->belongsTo(KrsMahasiswaModel::class, 'id_krs_mahasiswa', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(KelasModel::class, 'id_kelas', 'id');
    }
}
