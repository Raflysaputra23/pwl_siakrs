@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="relative overflow-hidden rounded-3xl bg-linear-to-r from-primary to-blue-700 p-6 sm:p-8 text-white shadow-lg">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1 text-xs font-medium backdrop-blur-md">
                    <span class="inline-block h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Tahun Akademik: 2026/2027 - Ganjil (Aktif)
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Dashboard Administrator</h1>
                <p class="text-blue-100 text-sm max-w-2xl leading-relaxed">
                    Sistem Pemantauan Terpadu SIAKRS: Kelola data akademik, distribusi fakultas & prodi, kapasitas kelas kuliah, dan persetujuan KRS mahasiswa secara real-time.
                </p>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('kelola.user') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-primary shadow-sm hover:bg-blue-50 transition">
                    <x-lucide-user-plus class="size-4" />
                    Kelola Pengguna
                </a>
                <a href="{{ route('kelola.matakuliah') }}" class="inline-flex items-center gap-2 rounded-xl bg-white/20 hover:bg-white/30 backdrop-blur-sm px-4 py-2.5 text-sm font-semibold text-white transition border border-white/20">
                    <x-lucide-book-open class="size-4" />
                    Mata Kuliah
                </a>
            </div>
        </div>
        <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <div class="rounded-2xl bg-surface p-5 border border-slate-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Mahasiswa</p>
                    <h3 class="text-2xl font-bold text-slate-900">1,248</h3>
                    <p class="text-xs text-emerald-600 flex items-center gap-1 font-medium">
                        <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        1,180 Aktif · 42 Cuti · 26 Lulus
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-primary flex items-center justify-center shadow-inner">
                    <x-lucide-graduation-cap class="size-6" />
                </div>
            </div>
        </div>

        <div class="rounded-2xl bg-surface p-5 border border-slate-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Dosen</p>
                    <h3 class="text-2xl font-bold text-slate-900">86</h3>
                    <p class="text-xs text-slate-500 font-medium">
                        64 Dosen PA · 22 Dosen Pengampu
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
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Mata Kuliah & Kelas</p>
                    <h3 class="text-2xl font-bold text-slate-900">142 <span class="text-sm font-normal text-slate-500">MK</span></h3>
                    <p class="text-xs text-blue-600 font-medium">
                        110 Wajib · 32 Peminatan (58 Kelas)
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center shadow-inner">
                    <x-lucide-library-big class="size-6" />
                </div>
            </div>
        </div>

        <div class="rounded-2xl bg-surface p-5 border border-slate-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">KRS Diajukan</p>
                    <h3 class="text-2xl font-bold text-slate-900">920 <span class="text-sm font-normal text-slate-500">/ 1,180</span></h3>
                    <p class="text-xs text-amber-600 font-medium flex items-center gap-1">
                        <x-lucide-clock class="size-3.5" />
                        145 Menunggu Verifikasi Dosen PA
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center shadow-inner">
                    <x-lucide-file-text class="size-6" />
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="rounded-2xl bg-surface p-6 border border-slate-200 shadow-sm flex flex-col justify-between">
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                        <x-lucide-calendar class="size-5 text-primary" />
                        Periode Akademik Aktif
                    </h2>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                        Aktif
                    </span>
                </div>

                <div class="rounded-xl bg-slate-50 p-4 border border-slate-100 space-y-3">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500">Tahun Akademik</span>
                        <span class="font-semibold text-slate-800">2026/2027</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500">Semester</span>
                        <span class="font-semibold text-slate-800 capitalize">Ganjil</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500">Status Akademik</span>
                        <span class="inline-flex items-center gap-1.5 font-semibold text-emerald-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            Aktif
                        </span>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 mt-4 flex items-center justify-between text-xs text-slate-500">
                <span>Update sinkronisasi otomatis</span>
                <span class="font-medium text-slate-700">Hari ini, 00:45 WIB</span>
            </div>
        </div>

        <div class="lg:col-span-2 rounded-2xl bg-surface p-6 border border-slate-200 shadow-sm space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                        <x-lucide-building class="size-5 text-primary" />
                        Statistik Fakultas & Program Studi
                    </h2>
                    <p class="text-xs text-slate-500">Distribusi kuota kelas dan mahasiswa per program studi terdaftar</p>
                </div>
                <span class="text-xs font-medium text-slate-400">Total 4 Program Studi</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-100 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            <th class="pb-3">Program Studi</th>
                            <th class="pb-3">Fakultas</th>
                            <th class="pb-3 text-center">Mata Kuliah</th>
                            <th class="pb-3 text-center">Kelas Dibuka</th>
                            <th class="pb-3 text-center">Mahasiswa Aktif</th>
                            <th class="pb-3 text-end">Okupansi Kuota</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50/75 transition">
                            <td class="py-3.5">
                                <span class="font-semibold text-slate-800">S1 Teknik Informatika</span>
                                <span class="block text-xs text-slate-500">Kode: IF · Fasilkom</span>
                            </td>
                            <td class="py-3.5 text-slate-600">Fasilkom</td>
                            <td class="py-3.5 text-center font-medium text-slate-700">42</td>
                            <td class="py-3.5 text-center font-medium text-slate-700">18</td>
                            <td class="py-3.5 text-center font-semibold text-slate-800">420</td>
                            <td class="py-3.5 text-end">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    92% Terisi
                                </span>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/75 transition">
                            <td class="py-3.5">
                                <span class="font-semibold text-slate-800">S1 Sistem Informasi</span>
                                <span class="block text-xs text-slate-500">Kode: SI · Fasilkom</span>
                            </td>
                            <td class="py-3.5 text-slate-600">Fasilkom</td>
                            <td class="py-3.5 text-center font-medium text-slate-700">38</td>
                            <td class="py-3.5 text-center font-medium text-slate-700">15</td>
                            <td class="py-3.5 text-center font-semibold text-slate-800">350</td>
                            <td class="py-3.5 text-end">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    86% Terisi
                                </span>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/75 transition">
                            <td class="py-3.5">
                                <span class="font-semibold text-slate-800">S1 Rekayasa Perangkat Lunak</span>
                                <span class="block text-xs text-slate-500">Kode: RPL · FT</span>
                            </td>
                            <td class="py-3.5 text-slate-600">Fakultas Teknik</td>
                            <td class="py-3.5 text-center font-medium text-slate-700">34</td>
                            <td class="py-3.5 text-center font-medium text-slate-700">14</td>
                            <td class="py-3.5 text-center font-semibold text-slate-800">260</td>
                            <td class="py-3.5 text-end">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                    75% Terisi
                                </span>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/75 transition">
                            <td class="py-3.5">
                                <span class="font-semibold text-slate-800">D3 Manajemen Informatika</span>
                                <span class="block text-xs text-slate-500">Kode: MI · Vokasi</span>
                            </td>
                            <td class="py-3.5 text-slate-600">Vokasi</td>
                            <td class="py-3.5 text-center font-medium text-slate-700">28</td>
                            <td class="py-3.5 text-center font-medium text-slate-700">11</td>
                            <td class="py-3.5 text-center font-semibold text-slate-800">150</td>
                            <td class="py-3.5 text-end">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                    64% Terisi
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="rounded-2xl bg-surface border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    <x-lucide-clipboard-check class="size-5 text-primary" />
                    Aktivitas Pengajuan KRS Mahasiswa Terkini
                </h2>
                <p class="text-xs text-slate-500">Daftar pengajuan rencana studi semester ganjil yang diajukan ke Dosen PA</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200">
                    <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                    145 Menunggu
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    745 Disetujui
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-medium bg-rose-50 text-rose-700 border border-rose-200">
                    <span class="h-2 w-2 rounded-full bg-rose-500"></span>
                    30 Ditolak
                </span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200/80 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-3.5">Mahasiswa</th>
                        <th class="px-6 py-3.5">Program Studi</th>
                        <th class="px-6 py-3.5 text-center">Semester / IPK</th>
                        <th class="px-6 py-3.5 text-center">Total SKS</th>
                        <th class="px-6 py-3.5">Dosen Pembimbing Akademik</th>
                        <th class="px-6 py-3.5 text-center">Status KRS</th>
                        <th class="px-6 py-3.5 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xs">
                                    RS
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-900">Rafly Saputra</p>
                                    <p class="text-xs text-slate-500 font-mono">NIM: 2201010045</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-700">
                            S1 Teknik Informatika
                            <span class="block text-xs text-slate-400">Angkatan 2022</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-slate-800">Smt 5</span>
                            <span class="block text-xs font-medium text-emerald-600">IPK: 3.82</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-primary">
                                22 SKS
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-slate-800">Dr. Ir. Hendra Wijaya, M.T.</p>
                            <p class="text-xs text-slate-400 font-mono">NIP: 198005122005011002</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <x-lucide-check-circle-2 class="size-3.5 text-emerald-600" />
                                Disetujui
                            </span>
                        </td>
                        <td class="px-6 py-4 text-end">
                            <button class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200 transition">
                                <x-lucide-eye class="size-3.5" />
                                Review
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-amber-500/10 text-amber-600 flex items-center justify-center font-bold text-xs">
                                    NA
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-900">Nurul Aisyah</p>
                                    <p class="text-xs text-slate-500 font-mono">NIM: 2301020012</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-700">
                            S1 Sistem Informasi
                            <span class="block text-xs text-slate-400">Angkatan 2023</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-slate-800">Smt 3</span>
                            <span class="block text-xs font-medium text-emerald-600">IPK: 3.65</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-primary">
                                20 SKS
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-slate-800">Siti Rahmawati, S.Kom., M.Cs.</p>
                            <p class="text-xs text-slate-400 font-mono">NIP: 198503202008122001</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                <x-lucide-clock class="size-3.5 text-amber-600" />
                                Menunggu
                            </span>
                        </td>
                        <td class="px-6 py-4 text-end">
                            <button class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200 transition">
                                <x-lucide-eye class="size-3.5" />
                                Review
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-rose-500/10 text-rose-600 flex items-center justify-center font-bold text-xs">
                                    BP
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-900">Bagus Pratama</p>
                                    <p class="text-xs text-slate-500 font-mono">NIM: 2101010098</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-700">
                            S1 Teknik Informatika
                            <span class="block text-xs text-slate-400">Angkatan 2021</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="font-semibold text-slate-800">Smt 7</span>
                            <span class="block text-xs font-medium text-amber-600">IPK: 2.85</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-primary">
                                24 SKS
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-slate-800">Dr. Ir. Hendra Wijaya, M.T.</p>
                            <p class="text-xs text-slate-400 font-mono">NIP: 198005122005011002</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                <x-lucide-alert-circle class="size-3.5 text-rose-600" />
                                Ditolak (Kelebihan SKS)
                            </span>
                        </td>
                        <td class="px-6 py-4 text-end">
                            <button class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200 transition">
                                <x-lucide-eye class="size-3.5" />
                                Review
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="p-4 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <span>Menampilkan 3 dari 920 data KRS pengajuan mahasiswa</span>
            <a href="#" class="font-semibold text-primary hover:underline flex items-center gap-1">
                Lihat Seluruh Data Pengajuan
                <x-lucide-chevron-right class="size-4" />
            </a>
        </div>
    </div>
</div>
@endsection