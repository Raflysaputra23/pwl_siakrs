@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="mb-2 flex items-center gap-2 text-xs font-medium text-slate-400">
                <span>Perkuliahan</span>
                <span>/</span>
                <span>Jadwal Mengajar</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="size-10 text-white rounded-xl bg-primary shadow-sm shadow-primary/25 flex justify-center items-center shrink-0">
                    <x-lucide-calendar class="size-5" />
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Jadwal Mengajar Dosen</h1>
                    <p class="text-xs text-slate-500 mt-0.5">Kelola dan pantau jadwal perkuliahan, alokasi kelas, dan kapasitas ruangan.</p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-2 self-start sm:self-auto">
            <span class="inline-flex items-center gap-1.5 rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs font-semibold text-emerald-700">
                <span class="size-2 rounded-full bg-emerald-500"></span>
                Semester {{ ucfirst($tahunAkademikAktif->semester ?? 'Ganjil') }} {{ $tahunAkademikAktif->tahun ?? '2026/2027' }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <p class="text-xs text-slate-500 font-medium">Kelas Diampu</p>
                <h2 class="text-2xl font-bold text-slate-900">{{ $stats['kelas'] ?? ($totalKelas ?? 0) }}</h2>
                <p class="text-xs text-slate-400">Total kelas perkuliahan</p>
            </div>
            <div class="size-11 rounded-xl shadow-sm bg-primary/10 text-primary flex items-center justify-center shrink-0">
                <x-lucide-book-open class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <p class="text-xs text-slate-500 font-medium">Total SKS Mengajar</p>
                <h2 class="text-2xl font-bold text-slate-900">{{ $stats['sks'] ?? ($totalSks ?? 0) }}</h2>
                <p class="text-xs text-slate-400">Beban ajar semester ini</p>
            </div>
            <div class="size-11 rounded-xl shadow-sm bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <x-lucide-bookmark class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <p class="text-xs text-slate-500 font-medium">Total Mahasiswa</p>
                <h2 class="text-2xl font-bold text-slate-900">{{ $stats['mahasiswa'] ?? ($totalMahasiswa ?? 0) }}</h2>
                <p class="text-xs text-slate-400">Mahasiswa terdaftar di kelas</p>
            </div>
            <div class="size-11 rounded-xl shadow-sm bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                <x-lucide-users class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
            <div class="space-y-1">
                <p class="text-xs text-slate-500 font-medium">Kelas Hari Ini</p>
                <h2 class="text-2xl font-bold text-slate-900">{{ $stats['hariIni'] ?? ($hariIniCount ?? 0) }}</h2>
                <p class="text-xs text-slate-400">Jadwal mengajar aktif</p>
            </div>
            <div class="size-11 rounded-xl shadow-sm bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <x-lucide-clock class="size-5" />
            </div>
        </div>
    </div>

    <div class="rounded-2xl bg-surface shadow-sm border border-slate-200 p-5 space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-bold text-slate-900">Agenda Mengajar Mingguan</h2>
            <span class="text-xs text-slate-400">Senin &ndash; Sabtu</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-6 gap-3">
            @php
                $hariDaftar = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
                $hariIniNama = strtolower(date('l'));
                $hariMap = [
                    'monday' => 'senin',
                    'tuesday' => 'selasa',
                    'wednesday' => 'rabu',
                    'thursday' => 'kamis',
                    'friday' => 'jumat',
                    'saturday' => 'sabtu',
                    'sunday' => 'minggu',
                ];
                $hariIniKunci = $hariMap[$hariIniNama] ?? '';
            @endphp

            @foreach ($hariDaftar as $h)
                <div class="rounded-2xl border p-3 space-y-2 {{ $h === $hariIniKunci ? 'border-primary bg-primary/5' : 'border-slate-200 bg-slate-50/50' }}">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-bold uppercase text-slate-700">{{ $h }}</p>
                        @if ($h === $hariIniKunci)
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-primary text-white">Hari Ini</span>
                        @endif
                    </div>

                    @php
                        $kelasHari = collect($jadwalList ?? ($kelas ?? []))->filter(function($k) use ($h) {
                            $itemHari = is_object($k) ? ($k->hari ?? '') : ($k['hari'] ?? '');
                            return strtolower($itemHari) === $h;
                        });
                    @endphp

                    @forelse ($kelasHari as $item)
                        @php
                            $namaMk = is_object($item) ? ($item->mataKuliah->nama_mk ?? $item->nama_mk ?? $item->nama ?? '-') : ($item['nama_mk'] ?? $item['nama'] ?? '-');
                            $kelasNama = is_object($item) ? ($item->nama_kelas ?? $item->kelas ?? '-') : ($item['nama_kelas'] ?? $item['kelas'] ?? '-');
                            $jamMulai = is_object($item) ? ($item->jam_mulai ?? $item->mulai ?? '') : ($item['jam_mulai'] ?? $item['mulai'] ?? '');
                            $jamSelesai = is_object($item) ? ($item->jam_selesai ?? $item->selesai ?? '') : ($item['jam_selesai'] ?? $item['selesai'] ?? '');
                            $ruangan = is_object($item) ? ($item->ruangan ?? '-') : ($item['ruangan'] ?? '-');
                        @endphp
                        <div class="rounded-xl bg-surface border border-slate-200 p-2.5 space-y-1 shadow-xs">
                            <p class="text-xs font-semibold text-slate-900 leading-snug line-clamp-1">{{ $namaMk }}</p>
                            <p class="text-[11px] font-semibold text-primary">Kelas {{ $kelasNama }}</p>
                            <p class="text-[11px] text-slate-500 flex items-center gap-1">
                                <x-lucide-clock class="size-3 text-slate-400" />
                                {{ $jamMulai ? substr($jamMulai, 0, 5) : '-' }} - {{ $jamSelesai ? substr($jamSelesai, 0, 5) : '-' }}
                            </p>
                            <p class="text-[11px] text-slate-500 flex items-center gap-1">
                                <x-lucide-map-pin class="size-3 text-slate-400" />
                                {{ $ruangan }}
                            </p>
                        </div>
                    @empty
                        <p class="text-[11px] text-slate-400 py-3 text-center">Tidak ada kelas</p>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-surface shadow-sm">
        <div class="space-y-4 border-b border-slate-100 p-5">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-base font-bold text-slate-900">Daftar Kelas & Jadwal Perkuliahan</h2>
                    <p class="mt-1 text-xs text-slate-500">Daftar mata kuliah yang diampu beserta jadwal dan alokasi ruangannya.</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-2.5">
                    <div class="relative min-w-0 sm:w-64">
                        <x-lucide-search class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-slate-400" />
                        <input
                            type="text"
                            id="searchJadwal"
                            placeholder="Cari mata kuliah, kode, ruangan..."
                            class="w-full rounded-xl border border-slate-200 bg-white pl-9 pr-4 py-2 text-xs text-slate-800 placeholder-slate-400 focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all"
                        >
                    </div>

                    <select
                        id="filterHari"
                        class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all sm:w-36"
                    >
                        <option value="">Semua Hari</option>
                        <option value="senin">Senin</option>
                        <option value="selasa">Selasa</option>
                        <option value="rabu">Rabu</option>
                        <option value="kamis">Kamis</option>
                        <option value="jumat">Jumat</option>
                        <option value="sabtu">Sabtu</option>
                    </select>

                    <button
                        type="button"
                        id="btnResetFilter"
                        class="inline-flex items-center justify-center gap-1.5 rounded-xl border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition cursor-pointer"
                        title="Atur Ulang Filter"
                    >
                        <x-lucide-rotate-ccw class="size-3.5" />
                        <span>Reset</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[850px] border-collapse text-left text-sm">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-500">
                        <th class="px-5 py-4">Mata Kuliah</th>
                        <th class="px-4 py-4 text-center">Kelas</th>
                        <th class="px-5 py-4">Dosen Pengampu</th>
                        <th class="px-4 py-4 text-center">Peran</th>
                        <th class="px-5 py-4">Jadwal & Ruangan</th>
                        <th class="px-5 py-4 text-center">Kapasitas</th>
                        <th class="px-4 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody id="tbodyJadwal" class="divide-y divide-slate-100">
                    @forelse ($jadwalList ?? ($kelas ?? []) as $k)
                        @php
                            $kodeMk = is_object($k) ? ($k->mataKuliah->kode_mk ?? $k->kode_mk ?? $k->kode ?? '-') : ($k['kode_mk'] ?? $k['kode'] ?? '-');
                            $namaMk = is_object($k) ? ($k->mataKuliah->nama_mk ?? $k->nama_mk ?? $k->nama ?? '-') : ($k['nama_mk'] ?? $k['nama'] ?? '-');
                            $sks = is_object($k) ? ($k->mataKuliah->sks ?? $k->sks ?? 0) : ($k['sks'] ?? 0);
                            $jenis = is_object($k) ? ($k->mataKuliah->jenis ?? $k->jenis ?? 'wajib') : ($k['jenis'] ?? 'wajib');
                            $namaKelas = is_object($k) ? ($k->nama_kelas ?? $k->kelas ?? '-') : ($k['nama_kelas'] ?? $k['kelas'] ?? '-');
                            $dosenKoor = is_object($k) ? ($k->dosenKoor->nama ?? $k->dosen_koor ?? $k->koor ?? '-') : ($k['koor'] ?? $k['dosen_koor'] ?? '-');
                            $dosenPend = is_object($k) ? ($k->dosenPendamping->nama ?? $k->dosen_pendamping ?? $k->pendamping ?? null) : ($k['pendamping'] ?? $k['dosen_pendamping'] ?? null);
                            $peran = is_object($k) ? ($k->peran ?? 'koordinator') : ($k['peran'] ?? 'koordinator');
                            $hari = strtolower(is_object($k) ? ($k->hari ?? '') : ($k['hari'] ?? ''));
                            $jamMulai = is_object($k) ? ($k->jam_mulai ?? $k->mulai ?? '') : ($k['jam_mulai'] ?? $k['mulai'] ?? '');
                            $jamSelesai = is_object($k) ? ($k->jam_selesai ?? $k->selesai ?? '') : ($k['jam_selesai'] ?? $k['selesai'] ?? '');
                            $ruangan = is_object($k) ? ($k->ruangan ?? '-') : ($k['ruangan'] ?? '-');
                            $kapasitas = is_object($k) ? ($k->kapasitas ?? 0) : ($k['kapasitas'] ?? 0);
                            $terisi = is_object($k) ? ($k->terisi ?? 0) : ($k['terisi'] ?? 0);
                            $pct = $kapasitas > 0 ? min(round(($terisi / $kapasitas) * 100), 100) : 0;
                        @endphp

                        <tr
                            class="row-jadwal hover:bg-slate-50/70 transition"
                            data-hari="{{ $hari }}"
                            data-search="{{ strtolower($kodeMk . ' ' . $namaMk . ' ' . $ruangan . ' ' . $namaKelas . ' ' . $dosenKoor) }}"
                            data-nama="{{ $namaMk }}"
                            data-kode="{{ $kodeMk }}"
                            data-sks="{{ $sks }}"
                            data-kelas="{{ $namaKelas }}"
                            data-hari-teks="{{ ucfirst($hari) }}"
                            data-jam="{{ ($jamMulai ? substr($jamMulai, 0, 5) : '-') . ' - ' . ($jamSelesai ? substr($jamSelesai, 0, 5) : '-') }}"
                            data-ruang="{{ $ruangan }}"
                            data-koor="{{ $dosenKoor }}"
                            data-pend="{{ $dosenPend ?? '-' }}"
                            data-peran="{{ ucfirst($peran) }}"
                            data-terisi="{{ $terisi }}"
                            data-kapasitas="{{ $kapasitas }}"
                        >
                            <td class="px-5 py-4">
                                <p class="font-bold text-slate-900">{{ $namaMk }}</p>
                                <div class="mt-1 flex flex-wrap items-center gap-2">
                                    <span class="font-mono text-xs text-slate-500">{{ $kodeMk }}</span>
                                    <span class="text-xs text-slate-300">&bull;</span>
                                    <span class="text-xs text-slate-500">{{ $sks }} SKS</span>
                                    <span class="text-xs text-slate-300">&bull;</span>
                                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[10px] font-semibold {{ $jenis === 'wajib' ? 'bg-blue-50 text-blue-700' : 'bg-purple-50 text-purple-700' }}">
                                        {{ ucfirst($jenis) }}
                                    </span>
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-center">
                                <span class="rounded-lg border border-slate-200 bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                    {{ $namaKelas }}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <p class="text-xs font-semibold text-slate-800">{{ $dosenKoor }}</p>
                                @if ($dosenPend)
                                    <p class="text-[11px] text-slate-400 mt-0.5">Pendamping: {{ $dosenPend }}</p>
                                @endif
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-center">
                                <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $peran === 'koordinator' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-blue-50 text-blue-700 border border-blue-200' }}">
                                    {{ ucfirst($peran) }}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <p class="flex items-center gap-1.5 text-xs font-semibold text-slate-800">
                                    <x-lucide-clock class="size-3.5 text-slate-400" />
                                    {{ ucfirst($hari) }}, {{ $jamMulai ? substr($jamMulai, 0, 5) : '-' }} - {{ $jamSelesai ? substr($jamSelesai, 0, 5) : '-' }}
                                </p>
                                <p class="flex items-center gap-1.5 text-xs text-slate-500 mt-1">
                                    <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                    {{ $ruangan }}
                                </p>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <p class="text-xs font-semibold text-slate-800">{{ $terisi }} / {{ $kapasitas }}</p>
                                <div class="mt-1.5 h-1.5 w-20 mx-auto overflow-hidden rounded-full bg-slate-100">
                                    <div class="h-full rounded-full bg-primary" style="width: {{ $pct }}%"></div>
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-center">
                                <button
                                    type="button"
                                    onclick="bukaDetail(this.closest('tr'))"
                                    class="inline-flex items-center justify-center gap-1 rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition shadow-xs cursor-pointer"
                                >
                                    <x-lucide-eye class="size-3.5 text-slate-400" />
                                    <span>Detail</span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr id="emptyRow">
                            <td colspan="7" class="px-5 py-12 text-center">
                                <x-lucide-calendar-x class="mx-auto size-9 text-slate-300" />
                                <p class="mt-3 text-sm font-semibold text-slate-700">Belum Ada Jadwal Mengajar</p>
                                <p class="mt-1 text-xs text-slate-400">Data jadwal mengajar akan otomatis tampil setelah alokasi kelas diatur.</p>
                            </td>
                        </tr>
                    @endforelse

                    <tr id="clientEmptyRow" class="hidden">
                        <td colspan="7" class="px-5 py-12 text-center">
                            <x-lucide-search-x class="mx-auto size-8 text-slate-300" />
                            <p class="mt-3 text-sm font-semibold text-slate-700">Kelas tidak ditemukan</p>
                            <p class="mt-1 text-xs text-slate-400">Coba gunakan kata kunci pencarian atau filter hari yang lain.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modalDetail" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 backdrop-blur-xs p-4">
    <div class="w-full max-w-lg overflow-hidden rounded-3xl bg-surface border border-slate-200 shadow-2xl">
        <div class="flex items-start justify-between border-b border-slate-100 p-5">
            <div>
                <h3 id="mdlNama" class="text-base font-bold text-slate-900"></h3>
                <p id="mdlSub" class="text-xs text-slate-500 font-mono mt-0.5"></p>
            </div>
            <button
                type="button"
                onclick="tutupDetail()"
                class="flex size-8 items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-slate-200 transition cursor-pointer"
            >
                <x-lucide-x class="size-4" />
            </button>
        </div>

        <div class="p-5 grid grid-cols-2 gap-4 text-xs">
            <div>
                <span class="text-slate-400 block mb-1">Hari & Jam</span>
                <p id="mdlWaktu" class="font-semibold text-slate-800 text-sm"></p>
            </div>
            <div>
                <span class="text-slate-400 block mb-1">Ruangan</span>
                <p id="mdlRuang" class="font-semibold text-slate-800 text-sm"></p>
            </div>
            <div>
                <span class="text-slate-400 block mb-1">Dosen Koordinator</span>
                <p id="mdlKoor" class="font-semibold text-slate-800"></p>
            </div>
            <div>
                <span class="text-slate-400 block mb-1">Dosen Pendamping</span>
                <p id="mdlPend" class="font-semibold text-slate-800"></p>
            </div>
            <div class="col-span-2 pt-2 border-t border-slate-100">
                <span class="text-slate-400 block mb-1">Kapasitas Mahasiswa</span>
                <p id="mdlKapasitas" class="font-semibold text-slate-800 text-sm"></p>
            </div>
        </div>

        <div class="border-t border-slate-100 bg-slate-50/50 p-4 flex justify-end">
            <button
                type="button"
                onclick="tutupDetail()"
                class="rounded-xl bg-slate-200 px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-300 transition cursor-pointer"
            >
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchJadwal');
    const filterHari = document.getElementById('filterHari');
    const btnReset = document.getElementById('btnResetFilter');
    const rows = document.querySelectorAll('.row-jadwal');
    const emptyRow = document.getElementById('clientEmptyRow');

    function filterTable() {
        const query = searchInput ? searchInput.value.trim().toLowerCase() : '';
        const hari = filterHari ? filterHari.value.toLowerCase() : '';
        let visibleCount = 0;

        rows.forEach(function (row) {
            const matchSearch = !query || (row.dataset.search && row.dataset.search.includes(query));
            const matchHari = !hari || (row.dataset.hari === hari);

            if (matchSearch && matchHari) {
                row.classList.remove('hidden');
                visibleCount++;
            } else {
                row.classList.add('hidden');
            }
        });

        if (emptyRow) {
            emptyRow.classList.toggle('hidden', visibleCount > 0 || rows.length === 0);
        }
    }

    if (searchInput) searchInput.addEventListener('input', filterTable);
    if (filterHari) filterHari.addEventListener('change', filterTable);
    if (btnReset) {
        btnReset.addEventListener('click', function () {
            if (searchInput) searchInput.value = '';
            if (filterHari) filterHari.value = '';
            filterTable();
        });
    }
});

function bukaDetail(row) {
    if (!row) return;
    const d = row.dataset;
    document.getElementById('mdlNama').textContent = d.nama || '-';
    document.getElementById('mdlSub').textContent = (d.kode || '-') + ' • Kelas ' + (d.kelas || '-') + ' • ' + (d.sks || '-') + ' SKS';
    document.getElementById('mdlWaktu').textContent = (d.hariTeks || '-') + ', ' + (d.jam || '-');
    document.getElementById('mdlRuang').textContent = d.ruang || '-';
    document.getElementById('mdlKoor').textContent = d.koor || '-';
    document.getElementById('mdlPend').textContent = d.pend || '-';
    document.getElementById('mdlKapasitas').textContent = (d.terisi || 0) + ' / ' + (d.kapasitas || 0) + ' Mahasiswa';

    const modal = document.getElementById('modalDetail');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function tutupDetail() {
    const modal = document.getElementById('modalDetail');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
@endsection