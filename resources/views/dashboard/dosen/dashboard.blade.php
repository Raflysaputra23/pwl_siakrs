@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="relative overflow-hidden rounded-3xl bg-linear-to-r from-emerald-600 via-teal-600 to-primary p-6 sm:p-8 text-white shadow-lg">
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                <div class="w-20 h-20 rounded-2xl bg-white/20 border-2 border-white/40 backdrop-blur-md flex items-center justify-center text-white text-2xl font-bold shadow-inner">
                    HW
                </div>
                <div class="space-y-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/20 px-3 py-0.5 text-xs font-semibold backdrop-blur-md">
                            <span class="h-2 w-2 rounded-full bg-emerald-300 animate-pulse"></span>
                            Dosen Tetap & Pembimbing Akademik
                        </span>
                        <span class="rounded-full bg-white/10 px-2.5 py-0.5 text-xs font-medium text-emerald-100">
                            Fakultas Ilmu Komputer
                        </span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Dr. Ir. Hendra Wijaya, M.T.</h1>
                    <p class="text-emerald-100 text-sm font-mono flex flex-wrap items-center gap-x-3 gap-y-1">
                        <span>NIP: 198005122005011002</span>
                        <span class="opacity-60">·</span>
                        <span>hendra.wijaya@univ.ac.id</span>
                        <span class="opacity-60">·</span>
                        <span>0812-3456-7890</span>
                    </p>
                </div>
            </div>

            <div class="rounded-2xl bg-white/15 backdrop-blur-md border border-white/25 p-4 min-w-[280px]">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs uppercase tracking-wider text-emerald-100 font-bold">Verifikasi KRS Mahasiswa</span>
                    <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-amber-400 text-amber-950 animate-bounce">
                        4 Menunggu
                    </span>
                </div>
                <p class="text-xs text-emerald-50 mb-3">Terdapat 4 mahasiswa bimbingan akademik menunggu persetujuan Kartu Rencana Studi.</p>
                <a href="#tabel-approval-krs" class="inline-flex items-center justify-center w-full gap-2 rounded-xl bg-white text-emerald-800 px-4 py-2 text-xs font-bold shadow hover:bg-emerald-50 transition">
                    <x-lucide-check-circle-2 class="size-4 text-emerald-700" />
                    Tinjau Pengajuan Sekarang
                </a>
            </div>
        </div>
        <div class="absolute -right-16 -top-16 w-60 h-60 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <div class="rounded-2xl bg-surface p-5 border border-slate-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Mahasiswa Bimbingan (PA)</p>
                    <h3 class="text-2xl font-bold text-slate-900">32 <span class="text-sm font-normal text-slate-400">Orang</span></h3>
                    <p class="text-xs text-slate-500 font-medium">
                        28 Sudah Isi KRS · 4 Belum
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shadow-inner">
                    <x-lucide-users class="size-6" />
                </div>
            </div>
        </div>

        <div class="rounded-2xl bg-surface p-5 border border-slate-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">KRS Menunggu Approval</p>
                    <h3 class="text-2xl font-bold text-amber-600">4 <span class="text-sm font-normal text-slate-400">Pengajuan</span></h3>
                    <p class="text-xs text-amber-600 font-medium flex items-center gap-1">
                        <x-lucide-clock class="size-3.5" />
                        Perlu verifikasi Dosen PA
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center shadow-inner">
                    <x-lucide-file-text class="size-6" />
                </div>
            </div>
        </div>

        <div class="rounded-2xl bg-surface p-5 border border-slate-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Kelas Diampu</p>
                    <h3 class="text-2xl font-bold text-slate-900">4 <span class="text-sm font-normal text-slate-400">Kelas</span></h3>
                    <p class="text-xs text-blue-600 font-medium">
                        3 Dosen Koor · 1 Pendamping
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-primary flex items-center justify-center shadow-inner">
                    <x-lucide-library-big class="size-6" />
                </div>
            </div>
        </div>

        <div class="rounded-2xl bg-surface p-5 border border-slate-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total SKS Mengajar</p>
                    <h3 class="text-2xl font-bold text-slate-900">12 <span class="text-sm font-normal text-slate-400">SKS</span></h3>
                    <p class="text-xs text-emerald-600 font-medium flex items-center gap-1">
                        <x-lucide-check-circle-2 class="size-3.5" />
                        Sesuai BKD (Beban Kerja Dosen)
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center shadow-inner">
                    <x-lucide-award class="size-6" />
                </div>
            </div>
        </div>
    </div>

    <div id="tabel-approval-krs" class="rounded-2xl bg-surface border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <x-lucide-clipboard-check class="size-5 text-emerald-600" />
                    Persetujuan KRS Mahasiswa Bimbingan Akademik
                </h2>
                <p class="text-xs text-slate-500">Evaluasi dan berikan persetujuan pengambilan mata kuliah mahasiswa bimbingan Anda</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200">
                    <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                    4 Menunggu Verifikasi
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    24 Disetujui
                </span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200/80 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-3.5">Mahasiswa</th>
                        <th class="px-6 py-3.5 text-center">Semester</th>
                        <th class="px-6 py-3.5 text-center">IPK</th>
                        <th class="px-6 py-3.5 text-center">SKS Diambil</th>
                        <th class="px-6 py-3.5 text-center">Status</th>
                        <th class="px-6 py-3.5 text-end">Aksi Verifikasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-amber-500/10 text-amber-600 flex items-center justify-center font-bold text-xs">
                                    AP
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900">Aditya Pratama</p>
                                    <p class="text-xs text-slate-500 font-mono">NIM: 2201010018 · IF 2022</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center font-semibold text-slate-800">Smt 5</td>
                        <td class="px-6 py-4 text-center font-bold text-emerald-600">3.72</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-primary">
                                21 SKS (7 MK)
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                <x-lucide-clock class="size-3.5 text-amber-600" />
                                Menunggu Review
                            </span>
                        </td>
                        <td class="px-6 py-4 text-end">
                            <div class="inline-flex items-center gap-2">
                                <button class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-xs font-bold bg-slate-100 hover:bg-slate-200 text-slate-700 transition">
                                    <x-lucide-eye class="size-3.5" />
                                    Detail
                                </button>
                                <button class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-xs font-bold bg-emerald-600 hover:bg-emerald-700 text-white shadow-sm transition">
                                    <x-lucide-check-circle-2 class="size-3.5" />
                                    Setujui
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-amber-500/10 text-amber-600 flex items-center justify-center font-bold text-xs">
                                    DW
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900">Dina Wahyuni</p>
                                    <p class="text-xs text-slate-500 font-mono">NIM: 2201010052 · IF 2022</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center font-semibold text-slate-800">Smt 5</td>
                        <td class="px-6 py-4 text-center font-bold text-emerald-600">3.55</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-primary">
                                20 SKS (7 MK)
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                <x-lucide-clock class="size-3.5 text-amber-600" />
                                Menunggu Review
                            </span>
                        </td>
                        <td class="px-6 py-4 text-end">
                            <div class="inline-flex items-center gap-2">
                                <button class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-xs font-bold bg-slate-100 hover:bg-slate-200 text-slate-700 transition">
                                    <x-lucide-eye class="size-3.5" />
                                    Detail
                                </button>
                                <button class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-xs font-bold bg-emerald-600 hover:bg-emerald-700 text-white shadow-sm transition">
                                    <x-lucide-check-circle-2 class="size-3.5" />
                                    Setujui
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xs">
                                    RS
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900">Rafly Saputra</p>
                                    <p class="text-xs text-slate-500 font-mono">NIM: 2201010045 · IF 2022</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center font-semibold text-slate-800">Smt 5</td>
                        <td class="px-6 py-4 text-center font-bold text-emerald-600">3.82</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-primary">
                                21 SKS (7 MK)
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <x-lucide-check-circle-2 class="size-3.5 text-emerald-600" />
                                Telah Disetujui
                            </span>
                        </td>
                        <td class="px-6 py-4 text-end">
                            <button class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-xs font-bold bg-slate-100 hover:bg-slate-200 text-slate-700 transition">
                                <x-lucide-eye class="size-3.5" />
                                Lihat Berkas
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="rounded-2xl bg-surface border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <x-lucide-calendar class="size-5 text-primary" />
                    Jadwal Mengajar Semester Aktif (2026/2027 Ganjil)
                </h2>
                <p class="text-xs text-slate-500">Daftar kelas perkuliahan di mana Anda bertindak sebagai Dosen Koordinator atau Pendamping</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                Total 4 Kelas (12 SKS)
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200/80 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-3.5">Mata Kuliah & Kode</th>
                        <th class="px-4 py-3.5 text-center">SKS</th>
                        <th class="px-4 py-3.5 text-center">Kelas</th>
                        <th class="px-6 py-3.5">Peran Dosen</th>
                        <th class="px-6 py-3.5">Waktu & Ruangan</th>
                        <th class="px-6 py-3.5 text-end">Okupansi Mahasiswa</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4">
                            <span class="font-bold text-slate-900">Rekayasa Perangkat Lunak</span>
                            <span class="block text-xs text-slate-500 font-mono">Kode: IF5102 · Wajib</span>
                        </td>
                        <td class="px-4 py-4 text-center font-bold text-slate-800">3</td>
                        <td class="px-4 py-4 text-center">
                            <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                IF-A
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-primary border border-blue-200">
                                Dosen Koordinator
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-xs font-semibold text-slate-800 flex items-center gap-1.5">
                                <x-lucide-clock class="size-3.5 text-primary" />
                                Senin, 13:00 - 15:30
                            </p>
                            <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                Gedung D - Ruang D304
                            </p>
                        </td>
                        <td class="px-6 py-4 text-end">
                            <span class="font-bold text-slate-800">38 / 40</span>
                            <span class="block text-xs text-emerald-600 font-medium">95% Kuota Terisi</span>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4">
                            <span class="font-bold text-slate-900">Rekayasa Perangkat Lunak</span>
                            <span class="block text-xs text-slate-500 font-mono">Kode: IF5102 · Wajib</span>
                        </td>
                        <td class="px-4 py-4 text-center font-bold text-slate-800">3</td>
                        <td class="px-4 py-4 text-center">
                            <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                IF-B
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-primary border border-blue-200">
                                Dosen Koordinator
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-xs font-semibold text-slate-800 flex items-center gap-1.5">
                                <x-lucide-clock class="size-3.5 text-primary" />
                                Selasa, 08:00 - 10:30
                            </p>
                            <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                Gedung D - Ruang D305
                            </p>
                        </td>
                        <td class="px-6 py-4 text-end">
                            <span class="font-bold text-slate-800">35 / 40</span>
                            <span class="block text-xs text-emerald-600 font-medium">87% Kuota Terisi</span>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4">
                            <span class="font-bold text-slate-900">Arsitektur Perangkat Lunak</span>
                            <span class="block text-xs text-slate-500 font-mono">Kode: IF7101 · Peminatan</span>
                        </td>
                        <td class="px-4 py-4 text-center font-bold text-slate-800">3</td>
                        <td class="px-4 py-4 text-center">
                            <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                IF-P1
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-primary border border-blue-200">
                                Dosen Koordinator
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-xs font-semibold text-slate-800 flex items-center gap-1.5">
                                <x-lucide-clock class="size-3.5 text-primary" />
                                Rabu, 13:00 - 15:30
                            </p>
                            <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                Lab Rekayasa Komputer (LRK-01)
                            </p>
                        </td>
                        <td class="px-6 py-4 text-end">
                            <span class="font-bold text-slate-800">30 / 35</span>
                            <span class="block text-xs text-emerald-600 font-medium">85% Kuota Terisi</span>
                        </td>
                    </tr>

                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4">
                            <span class="font-bold text-slate-900">Pemrograman Berorientasi Objek</span>
                            <span class="block text-xs text-slate-500 font-mono">Kode: IF3102 · Wajib</span>
                        </td>
                        <td class="px-4 py-4 text-center font-bold text-slate-800">3</td>
                        <td class="px-4 py-4 text-center">
                            <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                IF-C
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                Dosen Pendamping
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-xs font-semibold text-slate-800 flex items-center gap-1.5">
                                <x-lucide-clock class="size-3.5 text-primary" />
                                Kamis, 09:30 - 12:00
                            </p>
                            <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                Gedung D - Ruang D202
                            </p>
                        </td>
                        <td class="px-6 py-4 text-end">
                            <span class="font-bold text-slate-800">40 / 40</span>
                            <span class="block text-xs text-rose-600 font-semibold">100% Penuh</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection