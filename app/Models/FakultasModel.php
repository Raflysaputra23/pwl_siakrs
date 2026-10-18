<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class FakultasModel extends Model
{
    use HasUuids;

    protected $table = 'fakultas';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_fakultas',
        'nama_fakultas',
        'singkatan',
    ];

    public function programStudi()
    {
        return $this->hasMany(ProgramStudiModel::class, 'id_fakultas', 'id');
    }

    public static function getAllFakultas()
    {
        return self::withCount('programStudi')->orderBy('created_at', 'desc')->get();
    }

    public static function createFakultas(array $data)
    {
        return self::create($data);
    }

    public static function updateFakultas(string $id, array $data)
    {
        return self::where('id', $id)->update($data);
    }

    public static function deleteFakultas(string $id)
    {
        return self::where('id', $id)->delete();
    }
}
