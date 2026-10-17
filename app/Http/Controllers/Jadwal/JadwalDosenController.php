<?php

namespace App\Http\Controllers\Jadwal;

use App\Http\Controllers\Controller;

class JadwalDosenController extends Controller
{
    public function index()
    {
        $hariList = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
        $hariIni = $hariList[now()->dayOfWeekIso - 1] ?? null;
        $dosen = 'Dr. Ir. Hendra Wijaya, M.T.';

        $rows = [
            ['IF5102', 'Rekayasa Perangkat Lunak', 'wajib', 5, 3, 'A', $dosen, 'Dewi Lestari, M.Cs.', 'senin', '13:00', '15:30', 'Gedung D - Ruang D304', 40, 38, 'S1 Teknik Informatika', 'koordinator'],
            ['IF5102', 'Rekayasa Perangkat Lunak', 'wajib', 5, 3, 'B', $dosen, null, 'selasa', '08:00', '10:30', 'Gedung D - Ruang D305', 40, 35, 'S1 Teknik Informatika', 'koordinator'],
            ['IF7101', 'Arsitektur Perangkat Lunak', 'peminatan', 7, 3, 'A', $dosen, null, 'rabu', '13:00', '15:30', 'Gedung D - Ruang D306', 35, 30, 'S1 Teknik Informatika', 'koordinator'],
            ['IF3102', 'Pemrograman Berorientasi Objek', 'wajib', 3, 3, 'A', 'Eko Prasetyo, M.T.', $dosen, 'kamis', '09:30', '12:00', 'Gedung D - Ruang D202', 40, 40, 'S1 Teknik Informatika', 'pendamping'],
            ['IF5101', 'Pemrograman Web Lanjut', 'wajib', 5, 3, 'A', 'Ahmad Fauzi, M.Kom.', null, 'senin', '08:00', '10:30', 'Gedung D - Ruang D301', 40, 36, 'S1 Teknik Informatika', null],
            ['IF5103', 'Kecerdasan Buatan (AI)', 'wajib', 5, 3, 'A', 'Dr. Budi Santoso, M.Cs.', null, 'selasa', '09:30', '12:00', 'Gedung D - Ruang D302', 40, 31, 'S1 Teknik Informatika', null],
            ['IF5201', 'Cloud Computing & DevOps', 'peminatan', 5, 3, 'A', 'Eko Prasetyo, M.T.', null, 'rabu', '10:00', '12:30', 'Gedung D - Ruang D201', 30, 22, 'S1 Teknik Informatika', null],
            ['IF5104', 'Keamanan Informasi & Jaringan', 'wajib', 5, 3, 'A', 'Wartariyus, S.Kom., M.T.I.', null, 'kamis', '13:00', '15:30', 'Gedung D - Ruang D303', 40, 38, 'S1 Teknik Informatika', null],
            ['SI5101', 'Sistem Informasi Enterprise', 'wajib', 5, 3, 'A', 'Dewi Asiah Shofiana, M.Kom.', null, 'jumat', '08:00', '10:30', 'Gedung C - Ruang C201', 40, 35, 'S1 Sistem Informasi', null],
            ['SI5201', 'Business Intelligence', 'peminatan', 5, 3, 'A', 'Febi Eka Febriansyah, M.T.', null, 'jumat', '13:00', '15:30', 'Gedung C - Lab 2', 30, 12, 'S1 Sistem Informasi', null],
            ['RPL5101', 'Pengujian Perangkat Lunak', 'wajib', 5, 2, 'A', 'Muhammad Ikhsan, M.Cs.', null, 'sabtu', '08:00', '09:40', 'Gedung E - Ruang E101', 35, 20, 'S1 Rekayasa Perangkat Lunak', null],
            ['MI3101', 'Pemrograman Basis Data', 'wajib', 3, 3, 'A', 'Favorisen R. Lumbanraja, Ph.D.', null, 'sabtu', '10:00', '12:30', 'Gedung E - Lab 3', 30, 27, 'D3 Manajemen Informatika', null],
        ];

        $keys = ['kode', 'nama', 'jenis', 'semester', 'sks', 'kelas', 'koor', 'pendamping', 'hari', 'mulai', 'selesai', 'ruangan', 'kapasitas', 'terisi', 'prodi', 'peran'];

        $kelas = collect($rows)
            ->map(fn ($r) => array_combine($keys, $r) + ['ta' => 'ganjil-2026'])
            ->sortBy(fn ($k) => array_search($k['hari'], $hariList) . $k['mulai'])
            ->values()
            ->map(fn ($k, $i) => ['id' => $i + 1] + $k);

        $saya = $kelas->whereNotNull('peran');

        return view('jadwal.dosen.jadwal', [
            'kelas' => $kelas->all(),
            'hariList' => $hariList,
            'hariIni' => $hariIni,
            'mingguan' => collect($hariList)->mapWithKeys(fn ($h) => [$h => $saya->where('hari', $h)->values()->all()])->all(),
            'tahunAkademik' => [
                ['value' => 'ganjil-2026', 'label' => 'Ganjil 2026/2027 (Aktif)'],
                ['value' => 'genap-2025', 'label' => 'Genap 2025/2026'],
            ],
            'prodiList' => $kelas->pluck('prodi')->unique()->values()->all(),
            'stats' => [
                'saya' => $saya->count(),
                'sks' => $saya->sum('sks'),
                'mahasiswa' => $saya->sum('terisi'),
                'hariIni' => $hariIni ? $saya->where('hari', $hariIni)->count() : 0,
            ],
        ]);
    }
}