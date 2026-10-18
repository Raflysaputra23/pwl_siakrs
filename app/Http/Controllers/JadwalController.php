<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataMahasiswaModel;
use App\Models\DosenModel;
use App\Models\KelasModel;
use App\Models\KrsMahasiswaModel;
use App\Models\KrsModel;
use App\Models\MahasiswaModel;
use App\Models\TahunAkademikModel;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user && $user->role === 'mahasiswa') {
            return $this->indexMahasiswa($user);
        }

        return $this->indexDosen($user);
    }

    private function indexMahasiswa($user)
    {
        $mahasiswa = MahasiswaModel::where('id_user', $user->id)->first();
        $tahunAkademikAktif = TahunAkademikModel::getAktif() ?? TahunAkademikModel::orderBy('created_at', 'desc')->first();

        $jadwalList = collect();

        if ($mahasiswa && $tahunAkademikAktif) {
            $dataMahasiswa = DataMahasiswaModel::where('nim', $mahasiswa->nim)
                ->where('id_tahun_akademik', $tahunAkademikAktif->id)
                ->first();

            if ($dataMahasiswa) {
                $krsMahasiswa = KrsMahasiswaModel::where('id_data_mahasiswa', $dataMahasiswa->id)
                    ->with([
                        'krsItems.kelas.mataKuliah.programStudi',
                        'krsItems.kelas.dosenKoor',
                        'krsItems.kelas.dosenPendamping',
                    ])
                    ->latest()
                    ->first();

                if ($krsMahasiswa) {
                    $jadwalList = $krsMahasiswa->krsItems->map(function ($item) use ($krsMahasiswa) {
                        $kelas = $item->kelas;
                        if ($kelas) {
                            $kelas->status = $krsMahasiswa->status;
                            $kelas->terisi = KrsModel::where('id_kelas', $kelas->id)
                                ->whereHas('krsMahasiswa', fn($q) => $q->whereIn('status', ['menunggu', 'disetujui']))
                                ->count();
                        }
                        return $kelas;
                    })->filter()->sortBy(function ($k) {
                        $hariOrder = ['senin' => 1, 'selasa' => 2, 'rabu' => 3, 'kamis' => 4, 'jumat' => 5, 'sabtu' => 6, 'minggu' => 7];
                        $order = $hariOrder[strtolower($k->hari)] ?? 99;
                        $jam = (int) str_replace(':', '', substr($k->jam_mulai, 0, 5));
                        return $order * 100000 + $jam;
                    })->values();
                }
            }
        }

        $hariMap = [
            'monday' => 'senin',
            'tuesday' => 'selasa',
            'wednesday' => 'rabu',
            'thursday' => 'kamis',
            'friday' => 'jumat',
            'saturday' => 'sabtu',
            'sunday' => 'minggu',
        ];
        $hariIni = $hariMap[strtolower(date('l'))] ?? '';

        $stats = [
            'kelas' => $jadwalList->count(),
            'sks' => $jadwalList->sum(fn($k) => $k->mataKuliah->sks ?? 0),
            'hari' => $jadwalList->pluck('hari')->map(fn($h) => strtolower($h))->unique()->count(),
            'hariIni' => $jadwalList->filter(fn($k) => strtolower($k->hari) === $hariIni)->count(),
        ];

        $data = [
            'mahasiswa' => $mahasiswa,
            'tahunAkademikAktif' => $tahunAkademikAktif,
            'jadwalList' => $jadwalList,
            'stats' => $stats,
        ];

        return view('jadwal.mahasiswa.jadwal', $data);
    }

    private function indexDosen($user)
    {
        $dosen = DosenModel::where('id_user', $user->id)->first();
        $tahunAkademikAktif = TahunAkademikModel::getAktif() ?? TahunAkademikModel::orderBy('created_at', 'desc')->first();
        $nip = $dosen ? trim($dosen->nip) : null;

        $jadwalList = collect();

        if ($nip) {
            $jadwalList = KelasModel::with([
                'mataKuliah.programStudi',
                'dosenKoor',
                'dosenPendamping',
            ])
            ->where(function ($q) use ($nip) {
                $q->where('dosen_koor', $nip)
                  ->orWhere('dosen_pendamping', $nip);
            })
            ->get()
            ->map(function ($kls) use ($nip) {
                $kls->peran = (trim($kls->dosen_koor) === $nip) ? 'koordinator' : 'pendamping';
                $kls->terisi = KrsModel::where('id_kelas', $kls->id)
                    ->whereHas('krsMahasiswa', fn($q) => $q->whereIn('status', ['menunggu', 'disetujui']))
                    ->count();
                return $kls;
            })
            ->sortBy(function ($k) {
                $hariOrder = ['senin' => 1, 'selasa' => 2, 'rabu' => 3, 'kamis' => 4, 'jumat' => 5, 'sabtu' => 6, 'minggu' => 7];
                $order = $hariOrder[strtolower($k->hari)] ?? 99;
                $jam = (int) str_replace(':', '', substr($k->jam_mulai, 0, 5));
                return $order * 100000 + $jam;
            })
            ->values();
        }

        $hariMap = [
            'monday' => 'senin',
            'tuesday' => 'selasa',
            'wednesday' => 'rabu',
            'thursday' => 'kamis',
            'friday' => 'jumat',
            'saturday' => 'sabtu',
            'sunday' => 'minggu',
        ];
        $hariIni = $hariMap[strtolower(date('l'))] ?? '';

        $stats = [
            'kelas' => $jadwalList->count(),
            'sks' => $jadwalList->sum(fn($k) => $k->mataKuliah->sks ?? 0),
            'mahasiswa' => $jadwalList->sum('terisi'),
            'hariIni' => $jadwalList->filter(fn($k) => strtolower($k->hari) === $hariIni)->count(),
        ];

        $data = [
            'dosen' => $dosen,
            'tahunAkademikAktif' => $tahunAkademikAktif,
            'jadwalList' => $jadwalList,
            'stats' => $stats,
        ];

        return view('jadwal.dosen.jadwal', $data);
    }
}