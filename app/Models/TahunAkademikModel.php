<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class TahunAkademikModel extends Model
{
    use HasUuids;

    protected $table = 'tahun_akademik';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'tahun',
        'semester',
        'status',
    ];

    public static function getAllTahunAkademik()
    {
        return self::orderByRaw("CASE WHEN status = 'aktif' THEN 1 ELSE 2 END")
            ->orderBy('tahun', 'desc')
            ->orderBy('semester', 'asc')
            ->get();
    }

    public static function getAktif()
    {
        return self::where('status', 'aktif')->first();
    }

    public static function createTahunAkademik(array $data)
    {
        if (($data['status'] ?? '') === 'aktif') {
            self::where('status', 'aktif')->update(['status' => 'non-aktif']);
        }
        return self::create($data);
    }

    public static function updateTahunAkademik(string $id, array $data)
    {
        if (($data['status'] ?? '') === 'aktif') {
            self::where('id', '!=', $id)->where('status', 'aktif')->update(['status' => 'non-aktif']);
        }
        return self::where('id', $id)->update($data);
    }

    public static function setAktif(string $id)
    {
        self::where('status', 'aktif')->update(['status' => 'non-aktif']);
        return self::where('id', $id)->update(['status' => 'aktif']);
    }

    public static function deleteTahunAkademik(string $id)
    {
        return self::where('id', $id)->delete();
    }
}
