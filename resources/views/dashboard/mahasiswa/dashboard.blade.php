@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="relative overflow-hidden rounded-3xl bg-linear-to-r from-primary via-blue-600 to-indigo-700 p-6 sm:p-8 text-white shadow-lg">
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                <div class="w-20 h-20 rounded-2xl bg-white/20 border-2 border-white/40 backdrop-blur-md flex items-center justify-center text-white text-2xl font-bold shadow-inner">
                    RS
                </div>
                <div class="space-y-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/20 px-3 py-0.5 text-xs font-semibold backdrop-blur-md">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            Mahasiswa Aktif
                        </span>
                        <span class="rounded-full bg-white/10 px-2.5 py-0.5 text-xs font-medium text-blue-100">
                            Angkatan 2022
                        </span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Rafly Saputra</h1>
                    <p class="text-blue-100 text-sm font-mono flex flex-wrap items-center gap-x-3 gap-y-1">
                        <span>NIM: 2201010045</span>
                        <span class="opacity-60">·</span>
                        <span>S1 Teknik Informatika</span>
                        <span class="opacity-60">·</span>
                        <span>Fakultas Ilmu Komputer</span>
                    </p>
                </div>
            </div>

            <div class="rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 p-4 min-w-[280px]">
                <p class="text-xs uppercase tracking-wider text-blue-200 font-semibold mb-1">Dosen Pembimbing Akademik (PA)</p>
                <p class="font-bold text-sm text-white">Dr. Ir. Hendra Wijaya, M.T.</p>
                <p class="text-xs text-blue-200 font-mono mb-3">NIP: 198005122005011002</p>
                <div class="flex items-center gap-2">
                    <button class="inline-flex items-center gap-1.5 rounded-xl bg-white text-primary px-3 py-1.5 text-xs font-semibold shadow hover:bg-blue-50 transition">
                        <x-lucide-printer class="size-3.5" />
                        Cetak KRS
                    </button>
                    <a href="mailto:hendra.wijaya@univ.ac.id" class="inline-flex items-center gap-1.5 rounded-xl bg-white/20 hover:bg-white/30 text-white px-3 py-1.5 text-xs font-semibold transition border border-white/20">
                        <x-lucide-mail class="size-3.5" />
                        Konsultasi
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute -right-16 -top-16 w-60 h-60 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <div class="rounded-2xl bg-surface p-5 border border-slate-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Semester Berjalan</p>
                    <h3 class="text-2xl font-bold text-slate-900">Semester 5</h3>
                    <p class="text-xs text-slate-500 font-medium">
                        T.A. 2026/2027 Ganjil
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-primary flex items-center justify-center shadow-inner">
                    <x-lucide-calendar class="size-6" />
                </div>
            </div>
        </div>

        <div class="rounded-2xl bg-surface p-5 border border-slate-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">IPK Kumulatif</p>
                    <h3 class="text-2xl font-bold text-emerald-600">3.82 <span class="text-xs font-medium text-slate-400">/ 4.00</span></h3>
                    <p class="text-xs text-emerald-700 font-medium flex items-center gap-1">
                        <x-lucide-trending-up class="size-3.5" />
                        IPS Semester Lalu: 3.88
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shadow-inner">
                    <x-lucide-award class="size-6" />
                </div>
            </div>
        </div>

        <div class="rounded-2xl bg-surface p-5 border border-slate-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">SKS Semester Ini</p>
                    <h3 class="text-2xl font-bold text-slate-900">21 <span class="text-xs font-medium text-slate-400">/ 24 Maks</span></h3>
                    <p class="text-xs text-blue-600 font-medium">
                        7 Mata Kuliah Diambil
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center shadow-inner">
                    <x-lucide-book-open class="size-6" />
                </div>
            </div>
        </div>

        <div class="rounded-2xl bg-surface p-5 border border-slate-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Status KRS</p>
                    <div class="pt-0.5">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <x-lucide-check-circle-2 class="size-4 text-emerald-600" />
                            Disetujui Dosen PA
                        </span>
                    </div>
                    <p class="text-xs text-slate-400 mt-1">Disetujui: 16 Okt 2026</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shadow-inner">
                    <x-lucide-badge-check class="size-6" />
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-emerald-200 bg-emerald-50/70 p-4 sm:p-5 flex items-start sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-sm">
                <x-lucide-check-circle-2 class="size-5" />
            </div>
            <div>
                <h4 class="text-sm font-bold text-emerald-950">Kartu Rencana Studi (KRS) Anda Telah Diverifikasi & Disetujui</h4>
                <p class="text-xs text-emerald-800 mt-0.5">Semua kelas telah divalidasi oleh Pembimbing Akademik. Anda dapat mencetak Kartu Rencana Studi resmi untuk bukti presensi kuliah.</p>
            </div>
        </div>
        <button class="shrink-0 inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold bg-emerald-600 hover:bg-emerald-700 text-white shadow-sm transition">
            <x-lucide-printer class="size-4" />
            Unduh KRS (PDF)
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 rounded-2xl bg-surface border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                        <x-lucide-file-text class="size-5 text-primary" />
                        Daftar Rencana Studi (KRS) Semester Ini
                    </h2>
                    <p class="text-xs text-slate-500">Mata kuliah dan jadwal kelas yang Anda ambil di Semester Ganjil 2026/2027</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-bold bg-blue-50 text-primary border border-blue-100">
                    Total: 21 SKS
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200/80 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            <th class="px-5 py-3.5">Mata Kuliah</th>
                            <th class="px-4 py-3.5 text-center">SKS</th>
                            <th class="px-4 py-3.5 text-center">Kelas</th>
                            <th class="px-5 py-3.5">Jadwal & Ruangan</th>
                            <th class="px-5 py-3.5">Dosen Pengampu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-5 py-4">
                                <span class="font-bold text-slate-900">Pemrograman Web Lanjut</span>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-xs text-slate-500 font-mono">IF5101</span>
                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-blue-100 text-blue-700">Wajib</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-center font-bold text-slate-800">3</td>
                            <td class="px-4 py-4 text-center">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                    IF-A
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-medium text-slate-800 text-xs flex items-center gap-1.5">
                                    <x-lucide-clock class="size-3.5 text-primary" />
                                    Senin, 08:00 - 10:30
                                </p>
                                <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                    <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                    Lab Rekayasa Komputer (LRK-02)
                                </p>
                            </td>
                            <td class="px-5 py-4">
                                <p class="text-xs font-semibold text-slate-800">Ahmad Fauzi, M.Kom.</p>
                                <p class="text-[11px] text-slate-400">Koor: NIP 198207142010011003</p>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-5 py-4">
                                <span class="font-bold text-slate-900">Rekayasa Perangkat Lunak</span>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-xs text-slate-500 font-mono">IF5102</span>
                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-blue-100 text-blue-700">Wajib</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-center font-bold text-slate-800">3</td>
                            <td class="px-4 py-4 text-center">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                    IF-A
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-medium text-slate-800 text-xs flex items-center gap-1.5">
                                    <x-lucide-clock class="size-3.5 text-primary" />
                                    Senin, 13:00 - 15:30
                                </p>
                                <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                    <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                    Gedung D - Ruang D304
                                </p>
                            </td>
                            <td class="px-5 py-4">
                                <p class="text-xs font-semibold text-slate-800">Dr. Ir. Hendra Wijaya, M.T.</p>
                                <p class="text-[11px] text-slate-400">Koor: NIP 198005122005011002</p>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-5 py-4">
                                <span class="font-bold text-slate-900">Kecerdasan Buatan (AI)</span>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-xs text-slate-500 font-mono">IF5103</span>
                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-blue-100 text-blue-700">Wajib</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-center font-bold text-slate-800">3</td>
                            <td class="px-4 py-4 text-center">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                    IF-B
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-medium text-slate-800 text-xs flex items-center gap-1.5">
                                    <x-lucide-clock class="size-3.5 text-primary" />
                                    Selasa, 09:30 - 12:00
                                </p>
                                <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                    <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                    Lab Artificial Intelligence
                                </p>
                            </td>
                            <td class="px-5 py-4">
                                <p class="text-xs font-semibold text-slate-800">Dr. Budi Santoso, M.Cs.</p>
                                <p class="text-[11px] text-slate-400">Koor: NIP 197801122003121001</p>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-5 py-4">
                                <span class="font-bold text-slate-900">Cloud Computing & DevOps</span>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-xs text-slate-500 font-mono">IF5201</span>
                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-purple-100 text-purple-700">Peminatan</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-center font-bold text-slate-800">3</td>
                            <td class="px-4 py-4 text-center">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                    IF-P1
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-medium text-slate-800 text-xs flex items-center gap-1.5">
                                    <x-lucide-clock class="size-3.5 text-primary" />
                                    Rabu, 10:00 - 12:30
                                </p>
                                <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                    <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                    Gedung D - Ruang D201
                                </p>
                            </td>
                            <td class="px-5 py-4">
                                <p class="text-xs font-semibold text-slate-800">Eko Prasetyo, M.T.</p>
                                <p class="text-[11px] text-slate-400">Koor: NIP 198904152014041002</p>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-5 py-4">
                                <span class="font-bold text-slate-900">Keamanan Informasi & Jaringan</span>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-xs text-slate-500 font-mono">IF5104</span>
                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-blue-100 text-blue-700">Wajib</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-center font-bold text-slate-800">3</td>
                            <td class="px-4 py-4 text-center">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                    IF-A
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-medium text-slate-800 text-xs flex items-center gap-1.5">
                                    <x-lucide-clock class="size-3.5 text-primary" />
                                    Kamis, 08:00 - 10:30
                                </p>
                                <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                    <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                    Lab Jaringan Komputer
                                </p>
                            </td>
                            <td class="px-5 py-4">
                                <p class="text-xs font-semibold text-slate-800">Dian Safitri, M.Kom.</p>
                                <p class="text-[11px] text-slate-400">Koor: NIP 198611292012102001</p>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-5 py-4">
                                <span class="font-bold text-slate-900">Manajemen Proyek TI</span>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-xs text-slate-500 font-mono">IF5105</span>
                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-blue-100 text-blue-700">Wajib</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-center font-bold text-slate-800">3</td>
                            <td class="px-4 py-4 text-center">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                    IF-B
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-medium text-slate-800 text-xs flex items-center gap-1.5">
                                    <x-lucide-clock class="size-3.5 text-primary" />
                                    Kamis, 13:30 - 16:00
                                </p>
                                <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                    <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                    Gedung D - Ruang D301
                                </p>
                            </td>
                            <td class="px-5 py-4">
                                <p class="text-xs font-semibold text-slate-800">Siti Rahmawati, M.Cs.</p>
                                <p class="text-[11px] text-slate-400">Koor: NIP 198503202008122001</p>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-5 py-4">
                                <span class="font-bold text-slate-900">Interaksi Manusia & Komputer</span>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-xs text-slate-500 font-mono">IF5106</span>
                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-blue-100 text-blue-700">Wajib</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-center font-bold text-slate-800">3</td>
                            <td class="px-4 py-4 text-center">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                    IF-A
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-medium text-slate-800 text-xs flex items-center gap-1.5">
                                    <x-lucide-clock class="size-3.5 text-primary" />
                                    Jumat, 08:30 - 11:00
                                </p>
                                <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                    <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                    Lab Multimedia & Grafika
                                </p>
                            </td>
                            <td class="px-5 py-4">
                                <p class="text-xs font-semibold text-slate-800">Rina Kusuma, M.Ds.</p>
                                <p class="text-[11px] text-slate-400">Koor: NIP 199008242018032002</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-2xl bg-surface border border-slate-200 p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                        <x-lucide-clock class="size-5 text-primary" />
                        Jadwal Hari Ini (Senin)
                    </h3>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-primary">
                        2 Kelas
                    </span>
                </div>

                <div class="space-y-3">
                    <div class="rounded-xl border border-primary/20 bg-primary/5 p-4 space-y-2 relative overflow-hidden">
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-primary"></div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-primary">08:00 - 10:30 WIB</span>
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-white text-primary border border-primary/20">3 SKS</span>
                        </div>
                        <h4 class="text-sm font-bold text-slate-900">Pemrograman Web Lanjut</h4>
                        <div class="text-xs text-slate-500 space-y-1">
                            <p class="flex items-center gap-1.5">
                                <x-lucide-door-open class="size-3.5 text-slate-400" />
                                Lab Rekayasa Komputer (LRK-02)
                            </p>
                            <p class="flex items-center gap-1.5">
                                <x-lucide-user class="size-3.5 text-slate-400" />
                                Ahmad Fauzi, M.Kom.
                            </p>
                        </div>
                    </div>

                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4 space-y-2 relative overflow-hidden">
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-indigo-500"></div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-indigo-700">13:00 - 15:30 WIB</span>
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-white text-indigo-700 border border-slate-200">3 SKS</span>
                        </div>
                        <h4 class="text-sm font-bold text-slate-900">Rekayasa Perangkat Lunak</h4>
                        <div class="text-xs text-slate-500 space-y-1">
                            <p class="flex items-center gap-1.5">
                                <x-lucide-door-open class="size-3.5 text-slate-400" />
                                Gedung D - Ruang D304
                            </p>
                            <p class="flex items-center gap-1.5">
                                <x-lucide-user class="size-3.5 text-slate-400" />
                                Dr. Ir. Hendra Wijaya, M.T.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl bg-surface border border-slate-200 p-6 shadow-sm space-y-3">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <x-lucide-info class="size-4 text-primary" />
                    Ketentuan Beban Studi (SKS)
                </h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Berdasarkan IPK semester lalu (<strong>3.88</strong>), batas maksimal pengambilan mata kuliah semester ini adalah <strong>24 SKS</strong>. Anda telah menggunakan <strong>21 SKS</strong> (Sisa Kuota: 3 SKS).
                </p>
                <div class="pt-2">
                    <div class="flex justify-between text-xs font-semibold mb-1">
                        <span class="text-slate-600">Alokasi SKS Terpakai</span>
                        <span class="text-primary">21 / 24 SKS</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                        <div class="bg-primary h-2 rounded-full" style="width: 87.5%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection