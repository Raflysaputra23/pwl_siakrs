<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenModel extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nip',
        'id_user',
        'nama_lengkap',
        'gelar_depan',
        'gelar_belakang',
        'email',
        'no_telp',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function mahasiswaBimbingan()
    {
        return $this->hasMany(MahasiswaModel::class, 'dosen_pa_nip', 'nip');
    }

    public function kelasKoor()
    {
        return $this->hasMany(KelasModel::class, 'dosen_koor', 'nip');
    }

    public function kelasPendamping()
    {
        return $this->hasMany(KelasModel::class, 'dosen_pendamping', 'nip');
    }

    public function getNamaAttribute()
    {
        $gelarDepan = $this->gelar_depan ? trim($this->gelar_depan) . ' ' : '';
        $gelarBelakang = $this->gelar_belakang ? ', ' . trim($this->gelar_belakang) : '';
        return $gelarDepan . $this->nama_lengkap . $gelarBelakang;
    }

    public static function getAllDosen()
    {
        return self::with('user')->orderBy('nama_lengkap', 'asc')->get();
    }

    public static function createDosen(array $data)
    {
        return self::create($data);
    }

    public static function updateDosen(string $nip, array $data)
    {
        return self::where('nip', $nip)->update($data);
    }

    public static function deleteDosen(string $nip)
    {
        return self::where('nip', $nip)->delete();
    }
}
