@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="relative overflow-hidden rounded-3xl bg-linear-to-r from-primary via-blue-600 to-indigo-700 p-6 sm:p-8 text-white shadow-lg">
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                <div class="w-20 h-20 rounded-2xl bg-white/20 border-2 border-white/40 backdrop-blur-md flex items-center justify-center text-white text-2xl font-bold shadow-inner">
                    {{ $inisialMhs ?? 'MH' }}
                </div>
                <div class="space-y-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/20 px-3 py-0.5 text-xs font-semibold backdrop-blur-md">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            Mahasiswa {{ ucfirst($mahasiswa->status ?? 'Aktif') }}
                        </span>
                        <span class="rounded-full bg-white/10 px-2.5 py-0.5 text-xs font-medium text-blue-100">
                            Angkatan {{ $mahasiswa->angkatan ?? '2024' }}
                        </span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">{{ $mahasiswa->nama_lengkap ?? (Auth::user()->nama ?? 'Mahasiswa') }}</h1>
                    <p class="text-blue-100 text-sm font-mono flex flex-wrap items-center gap-x-3 gap-y-1">
                        <span>NPM: {{ $mahasiswa->nim ?? '-' }}</span>
                        <span class="opacity-60">·</span>
                        <span>{{ $mahasiswa->programStudi->nama_prodi ?? '-' }}</span>
                        <span class="opacity-60">·</span>
                        <span>{{ $mahasiswa->programStudi->fakultas->nama_fakultas ?? 'Fakultas MIPA' }}</span>
                    </p>
                </div>
            </div>

            <div class="rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 p-4 min-w-[280px]">
                <p class="text-xs uppercase tracking-wider text-blue-200 font-semibold mb-1">Dosen Pembimbing Akademik (PA)</p>
                <p class="font-bold text-sm text-white">{{ $mahasiswa->dosenPa ? $mahasiswa->dosenPa->nama : 'Belum Ditentukan' }}</p>
                <p class="text-xs text-blue-200 font-mono mb-3">NIP: {{ $mahasiswa->dosen_pa_nip ?? '-' }}</p>
                <div class="flex items-center gap-2">
                    @if($mahasiswa->dosenPa && $mahasiswa->dosenPa->email)
                        <a href="mailto:{{ $mahasiswa->dosenPa->email }}" class="inline-flex items-center gap-1.5 rounded-xl bg-white/20 hover:bg-white/30 text-white px-3 py-1.5 text-xs font-semibold transition border border-white/20">
                            <x-lucide-mail class="size-3.5" />
                            Konsultasi
                        </a>
                    @endif
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
                    <h3 class="text-2xl font-bold text-slate-900">Semester {{ $dataMahasiswa->semester ?? 1 }}</h3>
                    <p class="text-xs text-slate-500 font-medium">
                        {{ $tahunAkademikAktif ? 'T.A. ' . $tahunAkademikAktif->tahun . ' ' . ucfirst($tahunAkademikAktif->semester) : 'T.A. 2026/2027 Ganjil' }}
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
                    <h3 class="text-2xl font-bold text-emerald-600">{{ number_format((float)($dataMahasiswa->ipk ?? 0), 2) }} <span class="text-xs font-medium text-slate-400">/ 4.00</span></h3>
                    <p class="text-xs text-emerald-700 font-medium flex items-center gap-1">
                        Total SKS: {{ $dataMahasiswa->total_sks ?? 0 }} SKS
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
                    <h3 class="text-2xl font-bold text-slate-900">{{ $totalSksDiambil }} <span class="text-xs font-medium text-slate-400">/ {{ $sksMaks }} Maks</span></h3>
                    <p class="text-xs text-blue-600 font-medium">
                        {{ $totalMkDiambil }} Mata Kuliah Diambil
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
                        @if(strtolower($statusKrs) === 'disetujui')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <x-lucide-check-circle-2 class="size-4 text-emerald-600" />
                                Disetujui
                            </span>
                        @elseif(strtolower($statusKrs) === 'menunggu')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                <x-lucide-clock class="size-4 text-amber-600" />
                                Menunggu Verifikasi
                            </span>
                        @elseif(strtolower($statusKrs) === 'ditolak')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                <x-lucide-alert-circle class="size-4 text-rose-600" />
                                Ditolak Dosen PA
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                <x-lucide-file-question class="size-4 text-slate-500" />
                                Belum Diajukan
                            </span>
                        @endif
                    </div>
                    <p class="text-xs text-slate-400 mt-1">
                        @if($tanggalPersetujuan)
                            Update: {{ $tanggalPersetujuan }}
                        @else
                            Silakan lakukan pengisian KRS
                        @endif
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shadow-inner">
                    <x-lucide-badge-check class="size-6" />
                </div>
            </div>
        </div>
    </div>

    @if(strtolower($statusKrs) === 'disetujui')
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50/70 p-4 sm:p-5 flex items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-sm">
                    <x-lucide-check-circle-2 class="size-5" />
                </div>
                <div>
                    <h4 class="text-sm font-bold text-emerald-950">KRS Anda Telah Diverifikasi & Disetujui</h4>
                    <p class="text-xs text-emerald-800 mt-0.5">Semua kelas telah divalidasi oleh Pembimbing Akademik.</p>
                </div>
            </div>
            <a href="{{ route('krs') }}" class="shrink-0 inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold bg-emerald-600 hover:bg-emerald-700 text-white shadow-sm transition">
                <x-lucide-printer class="size-4" />
                Lihat
            </a>
        </div>
    @elseif(strtolower($statusKrs) === 'menunggu')
        <div class="rounded-2xl border border-amber-200 bg-amber-50/70 p-4 sm:p-5 flex items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-amber-600 text-white flex items-center justify-center shrink-0 shadow-sm">
                    <x-lucide-clock class="size-5" />
                </div>
                <div>
                    <h4 class="text-sm font-bold text-amber-950">Pengajuan KRS Anda Sedang Menunggu Verifikasi Dosen PA</h4>
                    <p class="text-xs text-amber-800 mt-0.5">Rencana studi Anda telah terkirim dan sedang dievaluasi oleh Dosen Pembimbing Akademik.</p>
                </div>
            </div>
            <a href="{{ route('krs') }}" class="shrink-0 inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold bg-amber-600 hover:bg-amber-700 text-white shadow-sm transition">
                <x-lucide-eye class="size-4" />
                Lihat
            </a>
        </div>
    @elseif(strtolower($statusKrs) === 'ditolak')
        <div class="rounded-2xl border border-rose-200 bg-rose-50/70 p-4 sm:p-5 flex items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-rose-600 text-white flex items-center justify-center shrink-0 shadow-sm">
                    <x-lucide-alert-circle class="size-5" />
                </div>
                <div>
                    <h4 class="text-sm font-bold text-rose-950">Pengajuan KRS Anda ditolak</h4>
                    <p class="text-xs text-rose-800 mt-0.5">Dosen PA telah menolak pengajuan KRS Anda.</p>
                </div>
            </div>
            <a href="{{ route('krs') }}" class="shrink-0 inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold bg-rose-600 hover:bg-rose-700 text-white shadow-sm transition">
                <x-lucide-edit-3 class="size-4" />
                Lihat
            </a>
        </div>
    @else
        <div class="rounded-2xl border border-blue-200 bg-blue-50/70 p-4 sm:p-5 flex items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-primary text-white flex items-center justify-center shrink-0 shadow-sm">
                    <x-lucide-file-text class="size-5" />
                </div>
                <div>
                    <h4 class="text-sm font-bold text-blue-950">Periode Pengisian Kartu Rencana Studi (KRS) Telah Dibuka</h4>
                    <p class="text-xs text-blue-800 mt-0.5">Silakan pilih mata kuliah pada semester ini dan ajukan persetujuan ke Dosen Pembimbing Akademik.</p>
                </div>
            </div>
            <a href="{{ route('krs') }}" class="shrink-0 inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold bg-primary hover:bg-blue-700 text-white shadow-sm transition">
                <x-lucide-plus-circle class="size-4" />
                Lihat
            </a>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 rounded-2xl bg-surface border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                        <x-lucide-file-text class="size-5 text-primary" />
                        Daftar Rencana Studi (KRS) Semester Ini
                    </h2>
                    <p class="text-xs text-slate-500">Mata kuliah dan jadwal kelas yang Anda ambil di {{ $tahunAkademikAktif ? 'Semester ' . ucfirst($tahunAkademikAktif->semester) . ' ' . $tahunAkademikAktif->tahun : 'Semester Ganjil 2026/2027' }}</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-bold bg-blue-50 text-primary border border-blue-100">
                    Total: {{ $totalSksDiambil }} SKS
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
                        @forelse($krsItems as $item)
                            @php
                                $kelas = $item->kelas;
                                $mk = $kelas ? $kelas->mataKuliah : null;
                                $dosenKoor = $kelas ? $kelas->dosenKoor : null;
                            @endphp
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="px-5 py-4">
                                    <span class="font-bold text-slate-900">{{ $mk->nama_mk ?? '-' }}</span>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="text-xs text-slate-500 font-mono">{{ $mk->kode_mk ?? '-' }}</span>
                                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full {{ strtolower($mk->jenis ?? '') === 'peminatan' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                            {{ ucfirst($mk->jenis ?? 'Wajib') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center font-bold text-slate-800">{{ $mk->sks ?? 0 }}</td>
                                <td class="px-4 py-4 text-center">
                                    <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                        {{ $kelas->nama_kelas ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-5 py-4">
                                    <p class="font-medium text-slate-800 text-xs flex items-center gap-1.5">
                                        <x-lucide-clock class="size-3.5 text-primary" />
                                        {{ ucfirst($kelas->hari ?? '-') }}, {{ substr($kelas->jam_mulai ?? '', 0, 5) }} - {{ substr($kelas->jam_selesai ?? '', 0, 5) }}
                                    </p>
                                    <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                        <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                        {{ $kelas->ruangan ?? 'Ruang Kuliah' }}
                                    </p>
                                </td>
                                <td class="px-5 py-4">
                                    <p class="text-xs font-semibold text-slate-800">{{ $dosenKoor ? $dosenKoor->nama : 'Dosen Pengampu' }}</p>
                                    @if($kelas && $kelas->dosen_koor)
                                        <p class="text-[11px] text-slate-400">Koor: NIP {{ $kelas->dosen_koor }}</p>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-8 text-center text-xs text-slate-400">
                                    Anda belum memilih mata kuliah pada semester ini. Silakan kunjungi menu <a href="{{ route('krs') }}" class="font-bold text-primary hover:underline">KRS</a>.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-2xl bg-surface border border-slate-200 p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                        <x-lucide-clock class="size-5 text-primary" />
                        Jadwal Hari Ini ({{ $namaHariLabel }})
                    </h3>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-primary">
                        {{ $jadwalHariIni->count() }} Kelas
                    </span>
                </div>

                <div class="space-y-3">
                    @forelse($jadwalHariIni as $kls)
                        <div class="rounded-xl border border-primary/20 bg-primary/5 p-4 space-y-2 relative overflow-hidden">
                            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-primary"></div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-primary">{{ substr($kls->jam_mulai, 0, 5) }} - {{ substr($kls->jam_selesai, 0, 5) }} WIB</span>
                                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-white text-primary border border-primary/20">{{ $kls->mataKuliah->sks ?? 0 }} SKS</span>
                            </div>
                            <h4 class="text-sm font-bold text-slate-900">{{ $kls->mataKuliah->nama_mk ?? '-' }}</h4>
                            <div class="text-xs text-slate-500 space-y-1">
                                <p class="flex items-center gap-1.5">
                                    <x-lucide-door-open class="size-3.5 text-slate-400" />
                                    {{ $kls->ruangan ?? 'Ruang Kuliah' }} (Kelas {{ $kls->nama_kelas }})
                                </p>
                                <p class="flex items-center gap-1.5">
                                    <x-lucide-user class="size-3.5 text-slate-400" />
                                    {{ $kls->dosenKoor ? $kls->dosenKoor->nama : 'Dosen Pengampu' }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-xl border border-slate-100 bg-slate-50/70 p-6 text-center text-xs text-slate-400">
                            <x-lucide-calendar-x class="size-8 text-slate-300 mx-auto mb-2" />
                            Tidak ada jadwal perkuliahan untuk hari ini ({{ $namaHariLabel }}).
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="rounded-2xl bg-surface border border-slate-200 p-6 shadow-sm space-y-3">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <x-lucide-info class="size-4 text-primary" />
                    Ketentuan Beban Studi (SKS)
                </h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Berdasarkan ketentuan akademik semester ini, batas maksimal pengambilan mata kuliah Anda adalah <strong>{{ $sksMaks }} SKS</strong>. Anda telah menggunakan <strong>{{ $totalSksDiambil }} SKS</strong> (Sisa Kuota: {{ $sisaSks }} SKS).
                </p>
                <div class="pt-2">
                    <div class="flex justify-between text-xs font-semibold mb-1">
                        <span class="text-slate-600">SKS yang diambil</span>
                        <span class="text-primary">{{ $totalSksDiambil }} / {{ $sksMaks }} SKS</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                        <div class="bg-primary h-2 rounded-full" style="width: {{ $sksPersen }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection