@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="relative overflow-hidden rounded-3xl bg-linear-to-r from-emerald-600 via-teal-600 to-primary p-6 sm:p-8 text-white shadow-lg">
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                <div class="w-20 h-20 rounded-2xl bg-white/20 border-2 border-white/40 backdrop-blur-md flex items-center justify-center text-white text-2xl font-bold shadow-inner">
                    {{ $inisialDosen ?? 'DS' }}
                </div>
                <div class="space-y-1">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/20 px-3 py-0.5 text-xs font-semibold backdrop-blur-md">
                            <span class="h-2 w-2 rounded-full bg-emerald-300 animate-pulse"></span>
                            Dosen & Pembimbing Akademik
                        </span>
                        <span class="rounded-full bg-white/10 px-2.5 py-0.5 text-xs font-medium text-emerald-100">
                            {{ $tahunAkademikAktif ? 'T.A. ' . $tahunAkademikAktif->tahun . ' (' . ucfirst($tahunAkademikAktif->semester) . ')' : 'T.A. 2026/2027 Ganjil' }}
                        </span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">{{ $dosen ? $dosen->nama : (Auth::user()->nama ?? 'Dosen') }}</h1>
                    <p class="text-emerald-100 text-sm font-mono flex flex-wrap items-center gap-x-3 gap-y-1">
                        <span>NIP: {{ $dosen->nip ?? '-' }}</span>
                        <span class="opacity-60">·</span>
                        <span>{{ $dosen->email ?? (Auth::user()->email ?? '-') }}</span>
                        @if($dosen && $dosen->no_telp)
                            <span class="opacity-60">·</span>
                            <span>{{ $dosen->no_telp }}</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="rounded-2xl bg-white/15 backdrop-blur-md border border-white/25 p-4 min-w-[280px]">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs uppercase tracking-wider text-emerald-100 font-bold">Verifikasi KRS Mahasiswa</span>
                    <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-amber-400 text-amber-950 {{ $krsMenungguCount > 0 ? 'animate-bounce' : '' }}">
                        {{ $krsMenungguCount }} Menunggu
                    </span>
                </div>
                <p class="text-xs text-emerald-50 mb-3">
                    @if($krsMenungguCount > 0)
                        Terdapat {{ $krsMenungguCount }} mahasiswa bimbingan akademik menunggu persetujuan Kartu Rencana Studi.
                    @else
                        Semua pengajuan KRS mahasiswa bimbingan telah diverifikasi.
                    @endif
                </p>
                <a href="{{ route('krs') }}" class="inline-flex items-center justify-center w-full gap-2 rounded-xl bg-white text-emerald-800 px-4 py-2 text-xs font-bold shadow hover:bg-emerald-50 transition">
                    <x-lucide-check-circle-2 class="size-4 text-emerald-700" />
                    Tinjau Pengajuan
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
                    <h3 class="text-2xl font-bold text-slate-900">{{ number_format($totalBimbingan) }} <span class="text-sm font-normal text-slate-400">Orang</span></h3>
                    <p class="text-xs text-slate-500 font-medium">
                        {{ number_format($bimbinganSudahKrs) }} Sudah Isi KRS · {{ number_format($bimbinganBelumKrs) }} Belum
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
                    <h3 class="text-2xl font-bold text-amber-600">{{ number_format($krsMenungguCount) }} <span class="text-sm font-normal text-slate-400">Pengajuan</span></h3>
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
                    <h3 class="text-2xl font-bold text-slate-900">{{ number_format($totalKelasDiampu) }} <span class="text-sm font-normal text-slate-400">Kelas</span></h3>
                    <p class="text-xs text-blue-600 font-medium">
                        {{ number_format($dosenKoorCount) }} Dosen Koor · {{ number_format($dosenPendampingCount) }} Pendamping
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
                    <h3 class="text-2xl font-bold text-slate-900">{{ number_format($totalSksMengajar) }} <span class="text-sm font-normal text-slate-400">SKS</span></h3>
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
                    {{ number_format($krsMenungguCount) }} Menunggu Verifikasi
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    {{ number_format($krsDisetujuiCount) }} Disetujui
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
                    @forelse($pengajuanBimbingan as $krs)
                        @php
                            $mhs = $krs->dataMahasiswa?->mahasiswa;
                            $namaMhs = $mhs->nama_lengkap ?? 'Mahasiswa';
                            $parts = array_values(array_filter(explode(' ', trim($namaMhs))));
                            $initials = strtoupper(substr($parts[0] ?? 'M', 0, 1) . substr($parts[1] ?? '', 0, 1));
                            if (strlen($initials) === 1 && isset($parts[0][1])) {
                                $initials = strtoupper(substr($parts[0], 0, 2));
                            }
                            $status = strtolower($krs->status);
                        @endphp
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-emerald-500/10 text-emerald-700 flex items-center justify-center font-bold text-xs">
                                        {{ $initials }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900">{{ $namaMhs }}</p>
                                        <p class="text-xs text-slate-500 font-mono">NIM: {{ $mhs->nim ?? '-' }} · {{ $mhs->programStudi->singkatan ?? ($mhs->programStudi->nama_prodi ?? 'Prodi') }} {{ $mhs->angkatan ?? '' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center font-semibold text-slate-800">Smt {{ $krs->dataMahasiswa->semester ?? 1 }}</td>
                            <td class="px-6 py-4 text-center font-bold text-emerald-600">{{ number_format((float)($krs->dataMahasiswa->ipk ?? 0), 2) }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-primary">
                                    {{ $krs->total_sks }} SKS ({{ $krs->krsItems->count() }} MK)
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($status === 'disetujui')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <x-lucide-check-circle-2 class="size-3.5 text-emerald-600" />
                                        Telah Disetujui
                                    </span>
                                @elseif($status === 'menunggu')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                        <x-lucide-clock class="size-3.5 text-amber-600" />
                                        Menunggu Review
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                        <x-lucide-alert-circle class="size-3.5 text-rose-600" />
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-end">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('krs') }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-xs font-bold bg-slate-100 hover:bg-slate-200 text-slate-700 transition">
                                        <x-lucide-eye class="size-3.5" />
                                        {{ $status === 'menunggu' ? 'Detail' : 'Lihat Berkas' }}
                                    </a>
                                    @if($status === 'menunggu')
                                        <a href="{{ route('krs') }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-xs font-bold bg-emerald-600 hover:bg-emerald-700 text-white shadow-sm transition">
                                            <x-lucide-check-circle-2 class="size-3.5" />
                                            Setujui
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-xs text-slate-400">
                                Belum ada data pengajuan KRS dari mahasiswa bimbingan akademik Anda
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="rounded-2xl bg-surface border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <x-lucide-calendar class="size-5 text-primary" />
                    Jadwal Mengajar Semester Aktif ({{ $tahunAkademikAktif ? $tahunAkademikAktif->tahun . ' ' . ucfirst($tahunAkademikAktif->semester) : '2026/2027 Ganjil' }})
                </h2>
                <p class="text-xs text-slate-500">Daftar kelas perkuliahan yang anda ampu.</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                Total {{ number_format($totalKelasDiampu) }} Kelas ({{ number_format($totalSksMengajar) }} SKS)
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
                    @forelse($jadwalMengajar as $kls)
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-900">{{ $kls->mataKuliah->nama_mk ?? '-' }}</span>
                                <span class="block text-xs text-slate-500 font-mono">Kode: {{ $kls->mataKuliah->kode_mk ?? '-' }} · {{ ucfirst($kls->mataKuliah->jenis ?? 'Wajib') }}</span>
                            </td>
                            <td class="px-4 py-4 text-center font-bold text-slate-800">{{ $kls->mataKuliah->sks ?? 0 }}</td>
                            <td class="px-4 py-4 text-center">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                    {{ $kls->nama_kelas }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($kls->peran === 'Dosen Koordinator')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-primary border border-blue-200">
                                        Dosen Koordinator
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                        Dosen Pendamping
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-xs font-semibold text-slate-800 flex items-center gap-1.5">
                                    <x-lucide-clock class="size-3.5 text-primary" />
                                    {{ ucfirst($kls->hari) }}, {{ substr($kls->jam_mulai, 0, 5) }} - {{ substr($kls->jam_selesai, 0, 5) }}
                                </p>
                                <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                    <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                    {{ $kls->ruangan ?? 'Ruang Kuliah' }}
                                </p>
                            </td>
                            <td class="px-6 py-4 text-end">
                                <span class="font-bold text-slate-800">{{ $kls->terisi }} / {{ $kls->kapasitas }}</span>
                                @if($kls->persentase_terisi >= 100)
                                    <span class="block text-xs text-rose-600 font-semibold">100% Penuh</span>
                                @else
                                    <span class="block text-xs text-emerald-600 font-medium">{{ $kls->persentase_terisi }}% Kuota Terisi</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-xs text-slate-400">
                                Belum ada kelas perkuliahan yang diampu pada semester ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection