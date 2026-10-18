<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ProgramStudiModel extends Model
{
    use HasUuids;

    protected $table = 'program_studi';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_prodi',
        'nama_prodi',
        'singkatan',
        'id_fakultas',
    ];

    public function fakultas()
    {
        return $this->belongsTo(FakultasModel::class, 'id_fakultas', 'id');
    }

    public function mahasiswa()
    {
        return $this->hasMany(MahasiswaModel::class, 'id_program_studi', 'id');
    }

    public function mataKuliah()
    {
        return $this->hasMany(MatakuliahModel::class, 'id_program_studi', 'id');
    }

    public static function getAllProgramStudi()
    {
        return self::with('fakultas')->withCount('mahasiswa')->orderBy('created_at', 'desc')->get();
    }

    public static function createProgramStudi(array $data)
    {
        return self::create($data);
    }

    public static function updateProgramStudi(string $id, array $data)
    {
        return self::where('id', $id)->update($data);
    }

    public static function deleteProgramStudi(string $id)
    {
        return self::where('id', $id)->delete();
    }
}
