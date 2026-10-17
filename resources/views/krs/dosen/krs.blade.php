@extends('layouts.app')

@section('content')

@php
    $pengajuan = [
        ['2417051001', 'Aditya Pratama', 'Ilmu Komputer', 'A', 20, 'Menunggu'],
        ['2417051008', 'Citra Lestari', 'Ilmu Komputer', 'A', 22, 'Menunggu'],
        ['2417051012', 'Dimas Saputra', 'Ilmu Komputer', 'B', 21, 'Disetujui'],
        ['2417051020', 'Nadia Putri', 'Ilmu Komputer', 'A', 18, 'Perlu Revisi'],
        ['2417051045', 'Muhamad Arif', 'Ilmu Komputer', 'B', 22, 'Menunggu'],
        ['2417051051', 'Rizky Ramadhan', 'Ilmu Komputer', 'A', 20, 'Disetujui'],
        ['2417051055', 'Siti Amelia', 'Ilmu Komputer', 'B', 19, 'Menunggu'],
    ];

    $totalPengajuan = count($pengajuan);
    $totalMenunggu = count(array_filter($pengajuan, fn($mhs) => $mhs[5] === 'Menunggu'));
    $totalDisetujui = count(array_filter($pengajuan, fn($mhs) => $mhs[5] === 'Disetujui'));
    $totalRevisi = count(array_filter($pengajuan, fn($mhs) => $mhs[5] === 'Perlu Revisi'));

    $field = 'w-full rounded-xl border border-slate-200 bg-surface px-3 py-2.5 text-xs font-medium text-slate-700 outline-transparent transition focus:border-primary focus:outline-4 focus:outline-primary/10';
@endphp

<div class="dosen-krs space-y-6">

    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <div class="mb-2 flex items-center gap-2 text-xs font-medium text-slate-400">
                <span>Akademik</span>
                <span>/</span>
                <span>Persetujuan KRS</span>
            </div>

            <h1 class="text-2xl font-bold text-slate-900">
                Persetujuan KRS Mahasiswa
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Kelola dan tinjau pengajuan KRS mahasiswa.
            </p>
        </div>

        <span class="inline-flex items-center gap-1.5 self-start rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs font-semibold text-emerald-700">
            <span class="size-2 rounded-full bg-emerald-500"></span>
            Semester Ganjil 2026/2027
        </span>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-surface p-5 shadow-sm">
            <div class="space-y-1">
                <p class="text-xs font-medium text-slate-500">
                    Total Pengajuan
                </p>

                <h2 id="totalPengajuan" class="mt-3 text-3xl font-bold text-slate-900">
                    {{ $totalPengajuan }}
                </h2>

                <p class="text-xs text-slate-400">
                    Pengajuan mahasiswa
                </p>
            </div>

            <div class="flex size-11 items-center justify-center rounded-xl bg-primary/10 text-primary">
                <x-lucide-clipboard-list class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-surface p-5 shadow-sm">
            <div class="space-y-1">
                <p class="text-xs font-medium text-slate-500">
                    Menunggu Persetujuan
                </p>

                <h2 id="totalMenunggu" class="mt-3 text-3xl font-bold text-slate-900">
                    {{ $totalMenunggu }}
                </h2>

                <p class="text-xs text-slate-400">
                    Perlu ditinjau
                </p>
            </div>

            <div class="flex size-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                <x-lucide-clock class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-surface p-5 shadow-sm">
            <div class="space-y-1">
                <p class="text-xs font-medium text-slate-500">
                    Disetujui
                </p>

                <h2 id="totalDisetujui" class="mt-3 text-3xl font-bold text-slate-900">
                    {{ $totalDisetujui }}
                </h2>

                <p class="text-xs text-slate-400">
                    KRS telah disetujui
                </p>
            </div>

            <div class="flex size-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                <x-lucide-check-circle class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-surface p-5 shadow-sm">
            <div class="space-y-1">
                <p class="text-xs font-medium text-slate-500">
                    Perlu Revisi
                </p>

                <h2 id="totalRevisi" class="mt-3 text-3xl font-bold text-slate-900">
                    {{ $totalRevisi }}
                </h2>

                <p class="text-xs text-slate-400">
                    Menunggu perbaikan
                </p>
            </div>

            <div class="flex size-11 items-center justify-center rounded-xl bg-red-50 text-red-600">
                <x-lucide-alert-circle class="size-5" />
            </div>
        </div>

    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-surface shadow-sm">

        <div class="space-y-4 border-b border-slate-100 p-5">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <h2 class="text-base font-bold text-slate-900">
                        Daftar Pengajuan KRS
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Lihat informasi mahasiswa dan status pengajuannya.
                    </p>
                </div>

                <div class="flex flex-col gap-2 sm:flex-row">
                    <div class="relative min-w-0 sm:w-56">
                        <x-lucide-search class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-slate-400" />

                        <input
                            type="text"
                            id="cariMahasiswa"
                            class="{{ $field }} pl-9"
                            placeholder="Cari nama atau NPM..."
                        >
                    </div>

                    <select
                        id="filterStatus"
                        class="{{ $field }} sm:w-40"
                    >
                        <option value="">Semua Status</option>
                        <option value="Menunggu">Menunggu</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Perlu Revisi">Perlu Revisi</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[850px] border-collapse text-left text-sm">

                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-500">
                        <th class="px-5 py-4">
                            Mahasiswa
                        </th>

                        <th class="px-5 py-4">
                            Program Studi
                        </th>

                        <th class="px-4 py-4">
                            Kelas
                        </th>

                        <th class="px-4 py-4">
                            Total SKS
                        </th>

                        <th class="px-5 py-4">
                            Status
                        </th>

                        <th class="px-5 py-4 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody id="daftarMahasiswa" class="divide-y divide-slate-100">

                    @foreach ($pengajuan as $mhs)

                        <tr
                            class="student-row transition hover:bg-slate-50/70"
                            data-npm="{{ $mhs[0] }}"
                            data-nama="{{ $mhs[1] }}"
                            data-prodi="{{ $mhs[2] }}"
                            data-kelas="{{ $mhs[3] }}"
                            data-sks="{{ $mhs[4] }}"
                            data-status="{{ $mhs[5] }}"
                        >

                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-primary/10 font-bold text-primary">
                                        {{ strtoupper(substr($mhs[1], 0, 1)) }}
                                    </div>

                                    <div>
                                        <p class="font-bold text-slate-900">
                                            {{ $mhs[1] }}
                                        </p>

                                        <p class="mt-1 font-mono text-xs text-slate-500">
                                            {{ $mhs[0] }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-5 py-4">
                                <p class="text-xs font-medium text-slate-700">
                                    {{ $mhs[2] }}
                                </p>
                            </td>

                            <td class="px-4 py-4">
                                <span class="inline-flex rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-700">
                                    {{ $mhs[3] }}
                                </span>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4">
                                <span class="text-xs font-semibold text-slate-800">
                                    {{ $mhs[4] }} SKS
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <span class="status-badge inline-flex items-center rounded-xl px-3 py-1.5 text-xs font-semibold
                                    {{ $mhs[5] === 'Disetujui' ? 'bg-emerald-50 text-emerald-700' : '' }}
                                    {{ $mhs[5] === 'Menunggu' ? 'bg-amber-50 text-amber-700' : '' }}
                                    {{ $mhs[5] === 'Perlu Revisi' ? 'bg-red-50 text-red-700' : '' }}">
                                    {{ $mhs[5] }}
                                </span>
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button
                                        type="button"
                                        class="detailKrs inline-flex items-center justify-center gap-1.5 rounded-xl border border-slate-200 bg-surface px-3 py-2.5 text-xs font-bold text-slate-700 transition hover:bg-slate-50"
                                    >
                                        <x-lucide-eye class="size-4" />
                                        Detail
                                    </button>

                                    <button
                                        type="button"
                                        class="setujuiKrs inline-flex items-center justify-center gap-1.5 whitespace-nowrap rounded-xl bg-primary px-3 py-2.5 text-xs font-bold text-white shadow-sm transition hover:opacity-90 disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-400"
                                        {{ $mhs[5] !== 'Menunggu' ? 'disabled' : '' }}
                                    >
                                        <x-lucide-check class="size-4" />
                                        Setujui
                                    </button>
                                </div>
                            </td>

                        </tr>

                    @endforeach

                    <tr id="emptyRow" class="hidden">
                        <td colspan="6" class="px-5 py-12 text-center">
                            <x-lucide-search-x class="mx-auto size-8 text-slate-300" />

                            <p class="mt-3 text-sm font-semibold text-slate-700">
                                Pengajuan KRS tidak ditemukan
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Coba gunakan kata kunci atau filter status yang berbeda.
                            </p>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="flex flex-col justify-between gap-3 border-t border-slate-100 p-5 sm:flex-row sm:items-center">
            <p id="jumlahData" class="text-xs text-slate-400">
                Menampilkan {{ $totalPengajuan }} pengajuan mahasiswa.
            </p>

            <p class="text-xs text-slate-400">
                Data pengajuan merupakan data contoh.
            </p>
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
                    Periksa jumlah SKS dan rencana studi mahasiswa sebelum memberikan
                    persetujuan. Perubahan status pada halaman ini hanya simulasi
                    tampilan dan belum disimpan ke database.
                </p>
            </div>
        </div>
    </div>

</div>

<div
    id="modalDetail"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 p-4"
>
    <div class="w-full max-w-md rounded-2xl border border-slate-200 bg-surface p-6 shadow-xl">
        <div class="flex items-center justify-between gap-3">
            <h2 class="text-lg font-bold text-slate-900">
                Detail Pengajuan KRS
            </h2>

            <button
                type="button"
                id="tutupModal"
                class="flex size-9 items-center justify-center rounded-xl text-slate-500 transition hover:bg-slate-100"
            >
                <x-lucide-x class="size-5" />
            </button>
        </div>

        <div class="mt-5 space-y-4">
            <div>
                <p class="text-xs text-slate-400">Nama Mahasiswa</p>
                <p id="detailNama" class="mt-1 text-sm font-semibold text-slate-900">-</p>
            </div>

            <div>
                <p class="text-xs text-slate-400">NPM</p>
                <p id="detailNpm" class="mt-1 text-sm font-semibold text-slate-900">-</p>
            </div>

            <div>
                <p class="text-xs text-slate-400">Program Studi</p>
                <p id="detailProdi" class="mt-1 text-sm font-semibold text-slate-900">-</p>
            </div>

            <div>
                <p class="text-xs text-slate-400">Kelas</p>
                <p id="detailKelas" class="mt-1 text-sm font-semibold text-slate-900">-</p>
            </div>

            <div>
                <p class="text-xs text-slate-400">Total SKS</p>
                <p id="detailSks" class="mt-1 text-sm font-semibold text-slate-900">-</p>
            </div>

            <div>
                <p class="text-xs text-slate-400">Status Pengajuan</p>
                <p id="detailStatus" class="mt-1 text-sm font-semibold text-slate-900">-</p>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button
                type="button"
                id="tutupModalBawah"
                class="rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-white transition hover:opacity-90"
            >
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('.dosen-krs');

    if (!container) return;

    const rows = Array.from(container.querySelectorAll('.student-row'));
    const inputCari = document.getElementById('cariMahasiswa');
    const filterStatus = document.getElementById('filterStatus');
    const emptyRow = document.getElementById('emptyRow');
    const jumlahData = document.getElementById('jumlahData');

    const modal = document.getElementById('modalDetail');
    const tutupModal = document.getElementById('tutupModal');
    const tutupModalBawah = document.getElementById('tutupModalBawah');

    function hitungStatus() {
        let menunggu = 0;
        let disetujui = 0;
        let revisi = 0;

        rows.forEach(function (row) {
            if (row.dataset.status === 'Menunggu') menunggu++;
            if (row.dataset.status === 'Disetujui') disetujui++;
            if (row.dataset.status === 'Perlu Revisi') revisi++;
        });

        document.getElementById('totalPengajuan').textContent = rows.length;
        document.getElementById('totalMenunggu').textContent = menunggu;
        document.getElementById('totalDisetujui').textContent = disetujui;
        document.getElementById('totalRevisi').textContent = revisi;
    }

    function filterMahasiswa() {
        const keyword = inputCari.value.trim().toLowerCase();
        const status = filterStatus.value;
        let jumlahTerlihat = 0;

        rows.forEach(function (row) {
            const npm = row.dataset.npm.toLowerCase();
            const nama = row.dataset.nama.toLowerCase();
            const prodi = row.dataset.prodi.toLowerCase();

            const cocokKeyword =
                npm.includes(keyword) ||
                nama.includes(keyword) ||
                prodi.includes(keyword);

            const cocokStatus =
                !status || row.dataset.status === status;

            const tampil = cocokKeyword && cocokStatus;

            row.classList.toggle('hidden', !tampil);

            if (tampil) jumlahTerlihat++;
        });

        emptyRow.classList.toggle('hidden', jumlahTerlihat > 0);

        jumlahData.textContent =
            'Menampilkan ' + jumlahTerlihat + ' dari ' + rows.length + ' pengajuan mahasiswa.';
    }

    function bukaModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function tutupModalDetail() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    inputCari.addEventListener('input', filterMahasiswa);
    filterStatus.addEventListener('change', filterMahasiswa);

    container.querySelectorAll('.detailKrs').forEach(function (button) {
        button.addEventListener('click', function () {
            const row = this.closest('.student-row');

            document.getElementById('detailNama').textContent = row.dataset.nama;
            document.getElementById('detailNpm').textContent = row.dataset.npm;
            document.getElementById('detailProdi').textContent = row.dataset.prodi;
            document.getElementById('detailKelas').textContent = row.dataset.kelas;
            document.getElementById('detailSks').textContent = row.dataset.sks + ' SKS';
            document.getElementById('detailStatus').textContent = row.dataset.status;

            bukaModal();
        });
    });

    container.querySelectorAll('.setujuiKrs').forEach(function (button) {
        button.addEventListener('click', function () {
            const row = this.closest('.student-row');

            if (row.dataset.status !== 'Menunggu') return;

            const konfirmasi = confirm(
                'Setujui KRS mahasiswa ' + row.dataset.nama + '?'
            );

            if (!konfirmasi) return;

            row.dataset.status = 'Disetujui';

            const badge = row.querySelector('.status-badge');

            badge.textContent = 'Disetujui';
            badge.className =
                'status-badge inline-flex items-center rounded-xl bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700';

            this.disabled = true;

            hitungStatus();
            filterMahasiswa();

            alert('KRS berhasil disetujui pada simulasi tampilan.');
        });
    });

    tutupModal.addEventListener('click', tutupModalDetail);
    tutupModalBawah.addEventListener('click', tutupModalDetail);

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            tutupModalDetail();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            tutupModalDetail();
        }
    });

    hitungStatus();
    filterMahasiswa();
});
</script>

@endsection