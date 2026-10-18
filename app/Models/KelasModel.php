<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class KelasModel extends Model
{
    use HasUuids;

    protected $table = 'kelas';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama_kelas',
        'id_mata_kuliah',
        'dosen_koor',
        'dosen_pendamping',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruangan',
        'kapasitas',
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MatakuliahModel::class, 'id_mata_kuliah', 'id');
    }

    public function dosenKoor()
    {
        return $this->belongsTo(DosenModel::class, 'dosen_koor', 'nip');
    }

    public function dosenPendamping()
    {
        return $this->belongsTo(DosenModel::class, 'dosen_pendamping', 'nip');
    }

    public static function getAllKelas()
    {
        return self::with(['mataKuliah.programStudi', 'dosenKoor', 'dosenPendamping'])
            ->orderBy('hari', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->get();
    }

    public static function createKelas(array $data)
    {
        return self::create($data);
    }

    public static function updateKelas(string $id, array $data)
    {
        return self::where('id', $id)->update($data);
    }

    public static function deleteKelas(string $id)
    {
        return self::where('id', $id)->delete();
    }
}
