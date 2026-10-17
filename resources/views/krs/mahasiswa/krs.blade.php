@extends('layouts.app')

@section('content')

@php
    $mataKuliah = [
        ['IF2101', 'Pemrograman Web Lanjut', 3, 'Ahmad Fauzi, M.Kom.', 'Senin', '08:00 - 10:30', 'D301', 28, 40],
        ['IF2102', 'Rekayasa Perangkat Lunak', 3, 'Hendro Wijaya, M.T.', 'Senin', '13:00 - 15:30', 'D304', 35, 40],
        ['IF2103', 'Kecerdasan Buatan', 3, 'Budi Santoso, M.Cs.', 'Selasa', '09:30 - 12:00', 'D302', 24, 40],
        ['IF2104', 'Cloud Computing', 3, 'Eko Prasetyo, M.T.', 'Rabu', '10:00 - 12:30', 'D301', 20, 30],
        ['IF2105', 'Keamanan Informasi', 3, 'Wartariya, M.T.I.', 'Kamis', '08:00 - 10:30', 'D303', 32, 40],
        ['IF2106', 'Interaksi Manusia dan Komputer', 2, 'Dina Kurniawati, M.Kom.', 'Jumat', '13:00 - 14:40', 'C201', 22, 35],
    ];

    $field = 'w-full rounded-xl border border-slate-200 bg-surface px-3 py-2.5 text-xs font-medium text-slate-700 outline-transparent transition focus:border-primary focus:outline-4 focus:outline-primary/10';
@endphp

<div class="space-y-6">

    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <div class="mb-2 flex items-center gap-2 text-xs font-medium text-slate-400">
                <span>Akademik</span>
                <span>/</span>
                <span>Kartu Rencana Studi</span>
            </div>

            <h1 class="text-2xl font-bold text-slate-900">
                Kartu Rencana Studi
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Pilih mata kuliah untuk semester yang sedang berjalan.
            </p>
        </div>

        <span class="inline-flex items-center gap-1.5 self-start rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs font-semibold text-emerald-700">
            <span class="size-2 rounded-full bg-emerald-500"></span>
            Periode KRS Aktif
        </span>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-surface p-5 shadow-sm">
            <div class="space-y-1">
                <p class="text-xs font-medium text-slate-500">
                    Semester Aktif
                </p>

                <h2 class="mt-3 text-lg font-bold text-slate-900">
                    Semester 5
                </h2>

                <p class="text-xs text-slate-400">
                    Ganjil 2026/2027
                </p>
            </div>

            <div class="flex size-11 items-center justify-center rounded-xl bg-primary/10 text-primary">
                <x-lucide-calendar class="size-5" />
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-surface p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-xs font-medium text-slate-500">
                    Total SKS Dipilih
                </p>

                <div class="flex size-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                    <x-lucide-clock class="size-5" />
                </div>
            </div>

            <div class="mt-3 flex items-end gap-2">
                <strong id="totalSks" class="text-3xl font-bold text-slate-900">
                    0
                </strong>

                <span class="mb-1 text-xs text-slate-400">
                    / 24 SKS
                </span>
            </div>

            <div class="mt-3 h-1.5 overflow-hidden rounded-full bg-slate-100">
                <div
                    id="progressSks"
                    class="h-full rounded-full bg-primary transition-all duration-300"
                    style="width: 0%"
                ></div>
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-surface p-5 shadow-sm">
            <div class="space-y-1">
                <p class="text-xs font-medium text-slate-500">
                    Mata Kuliah Dipilih
                </p>

                <h2 id="totalMk" class="mt-3 text-3xl font-bold text-slate-900">
                    0
                </h2>

                <p class="text-xs text-slate-400">
                    Mata kuliah terpilih
                </p>
            </div>

            <div class="flex size-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                <x-lucide-book-open class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-surface p-5 shadow-sm">
            <div class="space-y-1">
                <p class="text-xs font-medium text-slate-500">
                    Status KRS
                </p>

                <h2 id="statusKrs" class="mt-3 text-base font-bold text-amber-600">
                    Belum Diajukan
                </h2>

                <p class="text-xs text-slate-400">
                    Menunggu pengajuan
                </p>
            </div>

            <div class="flex size-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                <x-lucide-check-circle class="size-5" />
            </div>
        </div>

    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-surface shadow-sm">

        <div class="space-y-4 border-b border-slate-100 p-5">

            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <h2 class="text-base font-bold text-slate-900">
                        Daftar Mata Kuliah
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Pilih mata kuliah yang ingin kamu ambil.
                    </p>
                </div>

                <div class="flex flex-col gap-2 sm:flex-row">
                    <div class="relative min-w-0 sm:w-56">
                        <x-lucide-search class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-slate-400" />

                        <input
                            type="text"
                            id="searchMk"
                            class="{{ $field }} pl-9"
                            placeholder="Cari mata kuliah..."
                        >
                    </div>

                    <select
                        id="filterHari"
                        class="{{ $field }} sm:w-36"
                    >
                        <option value="">Semua Hari</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[850px] border-collapse text-left text-sm">

                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-500">
                        <th class="px-5 py-4">
                            Mata Kuliah
                        </th>

                        <th class="px-4 py-4">
                            SKS
                        </th>

                        <th class="px-5 py-4">
                            Dosen Pengampu
                        </th>

                        <th class="px-5 py-4">
                            Jadwal
                        </th>

                        <th class="px-5 py-4">
                            Kapasitas
                        </th>

                        <th class="px-4 py-4 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody id="daftarMataKuliah" class="divide-y divide-slate-100">

                    @foreach ($mataKuliah as $mk)

                        @php
                            $persentase = $mk[8] > 0
                                ? round(($mk[7] / $mk[8]) * 100)
                                : 0;
                        @endphp

                        <tr
                            class="course-row transition hover:bg-slate-50/70"
                            data-kode="{{ $mk[0] }}"
                            data-nama="{{ $mk[1] }}"
                            data-sks="{{ $mk[2] }}"
                            data-search="{{ strtolower($mk[0].' '.$mk[1].' '.$mk[3]) }}"
                            data-hari="{{ $mk[4] }}"
                        >

                            <td class="px-5 py-4">
                                <p class="font-bold text-slate-900">
                                    {{ $mk[1] }}
                                </p>

                                <div class="mt-1 flex flex-wrap items-center gap-2">
                                    <span class="font-mono text-xs text-slate-500">
                                        {{ $mk[0] }}
                                    </span>

                                    <span class="text-xs text-slate-300">
                                        ·
                                    </span>

                                    <span class="text-xs text-slate-500">
                                        Kelas A
                                    </span>
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4">
                                <span class="text-xs font-semibold text-slate-800">
                                    {{ $mk[2] }} SKS
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <p class="text-xs font-medium text-slate-700">
                                    {{ $mk[3] }}
                                </p>
                            </td>

                            <td class="px-5 py-4">
                                <p class="text-xs font-semibold text-slate-800">
                                    {{ $mk[4] }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $mk[5] }}
                                </p>

                                <p class="mt-1 text-xs text-slate-400">
                                    Ruang {{ $mk[6] }}
                                </p>
                            </td>

                            <td class="px-5 py-4">
                                <p class="text-xs font-medium text-slate-800">
                                    {{ $mk[7] }}/{{ $mk[8] }}
                                </p>

                                <div class="mt-2 h-1.5 w-20 overflow-hidden rounded-full bg-slate-100">
                                    <div
                                        class="h-full rounded-full {{ $persentase >= 90 ? 'bg-amber-500' : 'bg-primary' }}"
                                        style="width: {{ $persentase }}%"
                                    ></div>
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-center">
                                <button
                                    type="button"
                                    class="pilihMk inline-flex items-center justify-center gap-1.5 whitespace-nowrap rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-white shadow-sm transition hover:opacity-90 cursor-pointer"
                                    data-kode="{{ $mk[0] }}"
                                    data-nama="{{ $mk[1] }}"
                                    data-sks="{{ $mk[2] }}"
                                >
                                    + Pilih
                                </button>
                            </td>

                        </tr>

                    @endforeach

                    <tr id="emptyRow" class="hidden">
                        <td colspan="6" class="px-5 py-12 text-center">
                            <x-lucide-search-x class="mx-auto size-8 text-slate-300" />

                            <p class="mt-3 text-sm font-semibold text-slate-700">
                                Mata kuliah tidak ditemukan
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Coba gunakan kata kunci atau filter hari yang berbeda.
                            </p>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="flex flex-col justify-between gap-4 border-t border-slate-100 p-5 sm:flex-row sm:items-center">
            <p class="text-xs text-slate-400">
                * Data mata kuliah merupakan data contoh.
            </p>

            <button
                type="button"
                id="ajukanKrs"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-white shadow-sm transition hover:opacity-90 cursor-pointer"
            >
                Ajukan KRS
                <x-lucide-arrow-right class="size-4" />
            </button>
        </div>

    </div>

    <div class="rounded-2xl border border-blue-100 bg-blue-50 p-5">
        <div class="flex items-start gap-3">
            <div class="flex size-9 shrink-0 items-center justify-center rounded-xl bg-white text-blue-600 shadow-sm">
                <x-lucide-info class="size-5" />
            </div>

            <div>
                <h3 class="text-sm font-bold text-blue-800">
                    Informasi Akademik
                </h3>

                <p class="mt-2 text-xs leading-6 text-blue-700">
                    Pastikan mata kuliah yang dipilih sesuai dengan rencana studi.
                    Periksa jadwal perkuliahan agar tidak terjadi bentrok.
                    Maksimal pengambilan pada tampilan ini adalah 24 SKS.
                </p>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const terpilih = new Map();
    const batasSks = 24;

    const tombolPilih = document.querySelectorAll('.pilihMk');
    const barisMataKuliah = document.querySelectorAll('.course-row');

    const totalSks = document.getElementById('totalSks');
    const totalMk = document.getElementById('totalMk');
    const progressSks = document.getElementById('progressSks');
    const statusKrs = document.getElementById('statusKrs');

    function hitungTotalSks() {
        let total = 0;

        terpilih.forEach(function (mk) {
            total += mk.sks;
        });

        return total;
    }

    function updateKrs() {
        const total = hitungTotalSks();

        totalSks.textContent = total;
        totalMk.textContent = terpilih.size;

        progressSks.style.width =
            Math.min((total / batasSks) * 100, 100) + '%';
    }

    tombolPilih.forEach(function (button) {
        button.addEventListener('click', function () {
            const kode = this.dataset.kode;
            const nama = this.dataset.nama;
            const sks = Number(this.dataset.sks);

            if (terpilih.has(kode)) {
                terpilih.delete(kode);
            } else {
                if (hitungTotalSks() + sks > batasSks) {
                    alert('Total SKS tidak boleh melebihi 24 SKS.');
                    return;
                }

                terpilih.set(kode, {
                    nama: nama,
                    sks: sks
                });
            }

            const dipilih = terpilih.has(kode);

            this.textContent = dipilih ? '✓ Dipilih' : '+ Pilih';

            this.classList.toggle('bg-emerald-600', dipilih);
            this.classList.toggle('hover:bg-emerald-700', dipilih);
            this.classList.toggle('bg-primary', !dipilih);
            this.classList.toggle('hover:opacity-90', !dipilih);

            updateKrs();
        });
    });

    function filterMataKuliah() {
        const keyword = document
            .getElementById('searchMk')
            .value
            .trim()
            .toLowerCase();

        const hari = document.getElementById('filterHari').value;

        let jumlahTerlihat = 0;

        barisMataKuliah.forEach(function (row) {
            const cocokNama = row.dataset.search.includes(keyword);
            const cocokHari = !hari || row.dataset.hari === hari;

            const tampil = cocokNama && cocokHari;

            row.classList.toggle('hidden', !tampil);

            if (tampil) {
                jumlahTerlihat++;
            }
        });

        document.getElementById('emptyRow')
            .classList.toggle('hidden', jumlahTerlihat > 0);
    }

    document.getElementById('searchMk')
        .addEventListener('input', filterMataKuliah);

    document.getElementById('filterHari')
        .addEventListener('change', filterMataKuliah);

    document.getElementById('ajukanKrs')
        .addEventListener('click', function () {
            if (terpilih.size === 0) {
                alert('Pilih minimal satu mata kuliah terlebih dahulu.');
                return;
            }

            const total = hitungTotalSks();

            const daftar = Array.from(terpilih.values())
                .map(function (mk) {
                    return '- ' + mk.nama + ' (' + mk.sks + ' SKS)';
                })
                .join('\n');

            const konfirmasi = confirm(
                'Apakah kamu yakin ingin mengajukan KRS?\n\n' +
                daftar +
                '\n\nTotal mata kuliah: ' + terpilih.size +
                '\nTotal SKS: ' + total
            );

            if (!konfirmasi) {
                return;
            }

            statusKrs.textContent = 'Siap Diajukan';
            statusKrs.classList.remove('text-amber-600');
            statusKrs.classList.add('text-emerald-600');

            alert(
                'Simulasi pengajuan KRS berhasil.\n\n' +
                'Jumlah mata kuliah: ' + terpilih.size +
                '\nTotal SKS: ' + total +
                '\n\nData ini belum disimpan ke database.'
            );
        });

    updateKrs();
});
</script>

@endsection