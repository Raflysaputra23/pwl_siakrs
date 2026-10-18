<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class MatakuliahModel extends Model
{
    use HasUuids;

    protected $table = 'mata_kuliah';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_program_studi',
        'kode_mk',
        'nama_mk',
        'jenis',
        'semester',
        'sks',
    ];

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudiModel::class, 'id_program_studi', 'id');
    }

    public function kelas()
    {
        return $this->hasMany(KelasModel::class, 'id_mata_kuliah', 'id');
    }

    public static function getAllMatakuliah()
    {
        return self::with('programStudi')
            ->withCount('kelas')
            ->orderBy('semester', 'asc')
            ->orderBy('kode_mk', 'asc')
            ->get();
    }

    public static function createMatakuliah(array $data)
    {
        return self::create($data);
    }

    public static function updateMatakuliah(string $id, array $data)
    {
        return self::where('id', $id)->update($data);
    }

    public static function deleteMatakuliah(string $id)
    {
        return self::where('id', $id)->delete();
    }
}
