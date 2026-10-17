<?php

namespace App\Http\Controllers\Jadwal;

use App\Http\Controllers\Controller;

class JadwalMahasiswaController extends Controller
{
    public function index()
    {
        $hariList = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
        $hariIni = $hariList[now()->dayOfWeekIso - 1] ?? null;

        $rows = [
            ['IF5101', 'Pemrograman Web Lanjut', 'wajib', 5, 3, 'A', 'Ahmad Fauzi, M.Kom.', null, 'senin', '08:00', '10:30', 'Gedung D - Ruang D301', 40, 36, 'S1 Teknik Informatika', true],
            ['IF5102', 'Rekayasa Perangkat Lunak', 'wajib', 5, 3, 'A', 'Dr. Ir. Hendra Wijaya, M.T.', 'Dewi Lestari, M.Cs.', 'senin', '13:00', '15:30', 'Gedung D - Ruang D304', 40, 40, 'S1 Teknik Informatika', true],
            ['IF5103', 'Kecerdasan Buatan (AI)', 'wajib', 5, 3, 'A', 'Dr. Budi Santoso, M.Cs.', null, 'selasa', '09:30', '12:00', 'Gedung D - Ruang D302', 40, 31, 'S1 Teknik Informatika', true],
            ['IF5201', 'Cloud Computing & DevOps', 'peminatan', 5, 3, 'A', 'Eko Prasetyo, M.T.', null, 'rabu', '10:00', '12:30', 'Gedung D - Ruang D201', 30, 22, 'S1 Teknik Informatika', true],
            ['IF5104', 'Keamanan Informasi & Jaringan', 'wajib', 5, 3, 'A', 'Wartariyus, S.Kom., M.T.I.', null, 'kamis', '08:00', '10:30', 'Gedung D - Ruang D303', 40, 38, 'S1 Teknik Informatika', true],
            ['IF5101', 'Pemrograman Web Lanjut', 'wajib', 5, 3, 'B', 'Ahmad Fauzi, M.Kom.', null, 'senin', '13:00', '15:30', 'Gedung D - Ruang D301', 40, 29, 'S1 Teknik Informatika', false],
            ['IF5103', 'Kecerdasan Buatan (AI)', 'wajib', 5, 3, 'B', 'Dr. Budi Santoso, M.Cs.', null, 'selasa', '13:00', '15:30', 'Gedung D - Ruang D302', 40, 40, 'S1 Teknik Informatika', false],
            ['IF5202', 'Data Mining', 'peminatan', 5, 3, 'A', 'Riska Amalia Praptiwi, M.Cs.', null, 'rabu', '13:00', '15:30', 'Gedung D - Lab 1', 25, 17, 'S1 Teknik Informatika', false],
            ['IF4105', 'Jaringan Komputer', 'wajib', 4, 3, 'A', 'Tristiyanto, M.I.S., Ph.D.', null, 'kamis', '13:00', '15:30', 'Gedung D - Ruang D305', 40, 33, 'S1 Teknik Informatika', false],
            ['SI5101', 'Sistem Informasi Enterprise', 'wajib', 5, 3, 'A', 'Dewi Asiah Shofiana, M.Kom.', null, 'jumat', '08:00', '10:30', 'Gedung C - Ruang C201', 40, 35, 'S1 Sistem Informasi', false],
            ['SI5201', 'Business Intelligence', 'peminatan', 5, 3, 'A', 'Febi Eka Febriansyah, M.T.', null, 'jumat', '13:00', '15:30', 'Gedung C - Lab 2', 30, 12, 'S1 Sistem Informasi', false],
            ['RPL5101', 'Pengujian Perangkat Lunak', 'wajib', 5, 2, 'A', 'Muhammad Ikhsan, M.Cs.', null, 'sabtu', '08:00', '09:40', 'Gedung E - Ruang E101', 35, 20, 'S1 Rekayasa Perangkat Lunak', false],
            ['MI3101', 'Pemrograman Basis Data', 'wajib', 3, 3, 'A', 'Favorisen R. Lumbanraja, Ph.D.', null, 'sabtu', '10:00', '12:30', 'Gedung E - Lab 3', 30, 27, 'D3 Manajemen Informatika', false],
        ];

        $keys = ['kode', 'nama', 'jenis', 'semester', 'sks', 'kelas', 'koor', 'pendamping', 'hari', 'mulai', 'selesai', 'ruangan', 'kapasitas', 'terisi', 'prodi', 'mine'];

        $kelas = collect($rows)
            ->map(fn ($r) => array_combine($keys, $r) + ['ta' => 'ganjil-2026'])
            ->sortBy(fn ($k) => array_search($k['hari'], $hariList) . $k['mulai'])
            ->values()
            ->map(fn ($k, $i) => ['id' => $i + 1] + $k);

        $saya = $kelas->where('mine', true);

        return view('jadwal.mahasiswa.jadwal', [
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
                'hari' => $saya->pluck('hari')->unique()->count(),
                'hariIni' => $hariIni ? $saya->where('hari', $hariIni)->count() : 0,
            ],
        ]);
    }
}