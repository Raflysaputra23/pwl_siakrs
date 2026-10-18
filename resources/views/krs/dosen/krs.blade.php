@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        @if($errors->any())
            <div class="mb-5 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-3.5 text-xs text-red-700">
                <x-lucide-alert-circle class="size-4 shrink-0 text-red-600 mt-0.5" />
                <span>Krs gagal disimpan</span>
            </div>
        @endif
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="mb-2 flex items-center gap-2 text-xs font-medium text-slate-400">
                    <span>Akademik</span>
                    <span>/</span>
                    <span>Persetujuan KRS</span>
                </div>
                <div class="flex items-center gap-3">
                    <div
                        class="size-10 text-white rounded-xl bg-primary shadow-sm shadow-primary/25 flex justify-center items-center shrink-0">
                        <x-lucide-clipboard-check class="size-5" />
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900">Persetujuan KRS Mahasiswa</h1>
                        <p class="text-xs text-slate-500 mt-0.5">Tinjau dan verifikasi rencana studi (KRS) mahasiswa
                            bimbingan akademik Anda.</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2 self-start sm:self-auto">
                <span
                    class="inline-flex items-center gap-1.5 rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs font-semibold text-emerald-700">
                    <span class="size-2 rounded-full bg-emerald-500"></span>
                    Semester Ganjil 2026/2027
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
            <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
                <div class="space-y-1">
                    <p class="text-xs text-slate-500 font-medium">Total Pengajuan</p>
                    <h2 id="totalPengajuan" class="text-2xl font-bold text-slate-900">
                        {{ $stats['total'] ?? ($totalPengajuan ?? 0) }}</h2>
                    <p class="text-xs text-slate-400">Mahasiswa bimbingan</p>
                </div>
                <div
                    class="size-11 rounded-xl shadow-sm bg-primary/10 text-primary flex items-center justify-center shrink-0">
                    <x-lucide-clipboard-list class="size-5" />
                </div>
            </div>

            <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
                <div class="space-y-1">
                    <p class="text-xs text-slate-500 font-medium">Menunggu Persetujuan</p>
                    <h2 id="totalMenunggu" class="text-2xl font-bold text-amber-600">
                        {{ $stats['menunggu'] ?? ($totalMenunggu ?? 0) }}</h2>
                    <p class="text-xs text-slate-400">Perlu ditinjau Dosen PA</p>
                </div>
                <div
                    class="size-11 rounded-xl shadow-sm bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <x-lucide-clock class="size-5" />
                </div>
            </div>

            <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
                <div class="space-y-1">
                    <p class="text-xs text-slate-500 font-medium">Telah Disetujui</p>
                    <h2 id="totalDisetujui" class="text-2xl font-bold text-emerald-600">
                        {{ $stats['disetujui'] ?? ($totalDisetujui ?? 0) }}</h2>
                    <p class="text-xs text-slate-400">KRS siap cetak</p>
                </div>
                <div
                    class="size-11 rounded-xl shadow-sm bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <x-lucide-check-circle-2 class="size-5" />
                </div>
            </div>

            <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
                <div class="space-y-1">
                    <p class="text-xs text-slate-500 font-medium">Perlu Revisi / Ditolak</p>
                    <h2 id="totalRevisi" class="text-2xl font-bold text-red-600">
                        {{ $stats['ditolak'] ?? ($totalRevisi ?? 0) }}</h2>
                    <p class="text-xs text-slate-400">Menunggu perbaikan</p>
                </div>
                <div class="size-11 rounded-xl shadow-sm bg-red-50 text-red-600 flex items-center justify-center shrink-0">
                    <x-lucide-alert-circle class="size-5" />
                </div>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-surface shadow-sm">
            <div class="space-y-4 border-b border-slate-100 p-5">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-base font-bold text-slate-900">Daftar Pengajuan Rencana Studi</h2>
                        <p class="mt-1 text-xs text-slate-500">Daftar mahasiswa bimbingan akademik yang mengajukan KRS untuk
                            semester aktif.</p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-2.5">
                        <div class="relative min-w-0 sm:w-64">
                            <x-lucide-search class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-slate-400" />
                            <input type="text" id="cariMahasiswa" placeholder="Cari nama, NPM, prodi..."
                                class="w-full rounded-xl border border-slate-200 bg-white pl-9 pr-4 py-2 text-xs text-slate-800 placeholder-slate-400 focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all">
                        </div>

                        <select id="filterStatus"
                            class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-primary focus:outline-none focus:ring-4 focus:ring-primary/10 transition-all sm:w-40">
                            <option value="">Semua Status</option>
                            <option value="menunggu">Menunggu</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak / Revisi</option>
                        </select>

                        <button type="button" id="btnResetFilter"
                            class="inline-flex items-center justify-center gap-1.5 rounded-xl border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition cursor-pointer"
                            title="Atur Ulang Filter">
                            <x-lucide-rotate-ccw class="size-3.5" />
                            <span>Reset</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[850px] border-collapse text-left text-sm">
                    <thead>
                        <tr
                            class="border-b border-slate-200 bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <th class="px-5 py-4">Mahasiswa</th>
                            <th class="px-5 py-4">Program Studi</th>
                            <th class="px-4 py-4 text-center">Semester / Kelas</th>
                            <th class="px-4 py-4 text-center">Beban SKS</th>
                            <th class="px-5 py-4 text-center">Status</th>
                            <th class="px-5 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="daftarMahasiswa" class="divide-y divide-slate-100">
                        @forelse ($pengajuanList ?? ($pengajuan ?? []) as $mhs)
                            @php
                                $idKrs = is_object($mhs) ? ($mhs->id ?? '') : ($mhs['id'] ?? '');
                                $npm = is_object($mhs) ? ($mhs->mahasiswa->npm ?? $mhs->mahasiswa->nim ?? $mhs->npm ?? '-') : ($mhs['npm'] ?? $mhs[0] ?? '-');
                                $nama = is_object($mhs) ? ($mhs->mahasiswa->nama ?? $mhs->mahasiswa->nama_lengkap ?? $mhs->nama ?? '-') : ($mhs['nama'] ?? $mhs[1] ?? '-');
                                $prodi = is_object($mhs) ? ($mhs->mahasiswa->programStudi->nama_prodi ?? $mhs->prodi ?? '-') : ($mhs['prodi'] ?? $mhs[2] ?? '-');
                                $kelas = is_object($mhs) ? ($mhs->mahasiswa->kelas ?? $mhs->kelas ?? 'A') : ($mhs['kelas'] ?? $mhs[3] ?? '-');
                                $semester = is_object($mhs) ? ($mhs->dataMahasiswa->semester ?? $mhs->mahasiswa->semester ?? $mhs->semester ?? '1') : ($mhs['semester'] ?? '-');
                                $totalSks = is_object($mhs) ? ($mhs->total_sks ?? $mhs->sks ?? 0) : ($mhs['sks'] ?? $mhs[4] ?? 0);
                                $rawStatus = is_object($mhs) ? ($mhs->status ?? 'menunggu') : ($mhs['status'] ?? $mhs[5] ?? 'menunggu');
                                $status = strtolower($rawStatus);
                            @endphp

                            <tr class="student-row hover:bg-slate-50/70 transition" data-id="{{ $idKrs }}" data-npm="{{ $npm }}"
                                data-nama="{{ $nama }}" data-prodi="{{ $prodi }}" data-kelas="{{ $kelas }}"
                                data-semester="{{ $semester }}" data-sks="{{ $totalSks }}" data-status="{{ $status }}"
                                data-search="{{ strtolower($npm . ' ' . $nama . ' ' . $prodi . ' ' . $kelas) }}">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-primary/10 font-bold text-primary">
                                            {{ strtoupper(substr($nama, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900">{{ $nama }}</p>
                                            <p class="mt-0.5 font-mono text-xs text-slate-500">{{ $npm }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <p class="text-xs font-medium text-slate-700">{{ $prodi }}</p>
                                </td>

                                <td class="whitespace-nowrap px-4 py-4 text-center">
                                    <span
                                        class="rounded-lg border border-slate-200 bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                        Kelas {{ $kelas }} @if($semester !== '-') &bull; Smt {{ $semester }} @endif
                                    </span>
                                </td>

                                <td class="whitespace-nowrap px-4 py-4 text-center">
                                    <span class="text-xs font-semibold text-slate-800">{{ $totalSks }} SKS</span>
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-center">
                                    @if ($status === 'disetujui')
                                        <span
                                            class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            Disetujui
                                        </span>
                                    @elseif ($status === 'menunggu')
                                        <span
                                            class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                            Menunggu
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold bg-red-50 text-red-700 border border-red-200">
                                            Perlu Revisi
                                        </span>
                                    @endif
                                </td>

                                <td class="whitespace-nowrap px-5 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button type="button" onclick="bukaModalDetail(this.closest('tr'))"
                                            class="inline-flex items-center justify-center gap-1 rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition shadow-xs cursor-pointer">
                                            <x-lucide-eye class="size-3.5 text-slate-400" />
                                            <span>Detail</span>
                                        </button>

                                        @if ($status === 'menunggu')
                                            <button type="button" onclick="konfirmasiSetujui(this.closest('tr'))"
                                                class="inline-flex items-center justify-center gap-1 rounded-xl bg-primary hover:bg-primary-hover px-3 py-1.5 text-xs font-semibold text-white transition shadow-xs shadow-primary/20 cursor-pointer">
                                                <x-lucide-check class="size-3.5" />
                                                <span>Setujui</span>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyRow">
                                <td colspan="6" class="px-5 py-12 text-center">
                                    <x-lucide-clipboard-check class="mx-auto size-9 text-slate-300" />
                                    <p class="mt-3 text-sm font-semibold text-slate-700">Belum Ada Pengajuan KRS</p>
                                    <p class="mt-1 text-xs text-slate-400">Data pengajuan KRS dari mahasiswa bimbingan akademik
                                        akan muncul di sini.</p>
                                </td>
                            </tr>
                        @endforelse

                        <tr id="clientEmptyRow" class="hidden">
                            <td colspan="6" class="px-5 py-12 text-center">
                                <x-lucide-search-x class="mx-auto size-8 text-slate-300" />
                                <p class="mt-3 text-sm font-semibold text-slate-700">Pengajuan KRS tidak ditemukan</p>
                                <p class="mt-1 text-xs text-slate-400">Coba gunakan kata kunci pencarian atau filter status
                                    yang lain.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modalDetail"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 backdrop-blur-xs p-4">
        <div class="w-full max-w-lg overflow-hidden rounded-3xl bg-surface border border-slate-200 shadow-2xl">
            <div class="flex items-start justify-between border-b border-slate-100 p-5">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Detail Pengajuan KRS</h3>
                    <p id="mdlSub" class="text-xs text-slate-500 font-mono mt-0.5"></p>
                </div>
                <button type="button" onclick="tutupModalDetail()"
                    class="flex size-8 items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-slate-200 transition cursor-pointer">
                    <x-lucide-x class="size-4" />
                </button>
            </div>

            <div class="p-5 space-y-4 text-xs">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-slate-400 block mb-1">Nama Mahasiswa</span>
                        <p id="mdlNama" class="font-semibold text-slate-800 text-sm"></p>
                    </div>
                    <div>
                        <span class="text-slate-400 block mb-1">NPM / NIM</span>
                        <p id="mdlNpm" class="font-semibold text-slate-800 text-sm font-mono"></p>
                    </div>
                    <div>
                        <span class="text-slate-400 block mb-1">Program Studi</span>
                        <p id="mdlProdi" class="font-semibold text-slate-800"></p>
                    </div>
                    <div>
                        <span class="text-slate-400 block mb-1">Kelas Perkuliahan</span>
                        <p id="mdlKelas" class="font-semibold text-slate-800"></p>
                    </div>
                    <div>
                        <span class="text-slate-400 block mb-1">Beban SKS Diajukan</span>
                        <p id="mdlSks" class="font-semibold text-slate-800 text-sm"></p>
                    </div>
                    <div>
                        <span class="text-slate-400 block mb-1">Status Pengajuan</span>
                        <p id="mdlStatus" class="font-semibold text-slate-800 capitalize"></p>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-100 bg-slate-50/50 p-4 flex justify-end">
                <button type="button" onclick="tutupModalDetail()"
                    class="rounded-xl bg-slate-200 px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-300 transition cursor-pointer">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputCari = document.getElementById('cariMahasiswa');
            const filterStatus = document.getElementById('filterStatus');
            const btnReset = document.getElementById('btnResetFilter');
            const rows = document.querySelectorAll('.student-row');
            const emptyRow = document.getElementById('clientEmptyRow');

            function filterTable() {
                const query = inputCari ? inputCari.value.trim().toLowerCase() : '';
                const status = filterStatus ? filterStatus.value.toLowerCase() : '';
                let visibleCount = 0;

                rows.forEach(function (row) {
                    const matchSearch = !query || (row.dataset.search && row.dataset.search.includes(query));
                    const matchStatus = !status || (row.dataset.status && row.dataset.status === status);

                    if (matchSearch && matchStatus) {
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

            if (inputCari) inputCari.addEventListener('input', filterTable);
            if (filterStatus) filterStatus.addEventListener('change', filterTable);
            if (btnReset) {
                btnReset.addEventListener('click', function () {
                    if (inputCari) inputCari.value = '';
                    if (filterStatus) filterStatus.value = '';
                    filterTable();
                });
            }
        });

        function bukaModalDetail(row) {
            if (!row) return;
            const d = row.dataset;
            document.getElementById('mdlNama').textContent = d.nama || '-';
            document.getElementById('mdlNpm').textContent = d.npm || '-';
            document.getElementById('mdlSub').textContent = (d.nama || '-') + ' (' + (d.npm || '-') + ')';
            document.getElementById('mdlProdi').textContent = d.prodi || '-';
            document.getElementById('mdlKelas').textContent = 'Kelas ' + (d.kelas || '-');
            document.getElementById('mdlSks').textContent = (d.sks || 0) + ' SKS';
            document.getElementById('mdlStatus').textContent = d.status || '-';

            const modal = document.getElementById('modalDetail');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function tutupModalDetail() {
            const modal = document.getElementById('modalDetail');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function konfirmasiSetujui(row) {
            if (!row) return;
            const id = row.dataset.id;
            const nama = row.dataset.nama || 'mahasiswa ini';
            if (!id) {
                alert('ID pengajuan KRS tidak valid.');
                return;
            }

            if (confirm('Setujui pengajuan KRS untuk ' + nama + '?')) {
                fetch('{{ url("/krs/setujui") }}/' + id, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            row.dataset.status = 'disetujui';
                            const badgeCell = row.querySelector('td:nth-child(5)');
                            if (badgeCell) {
                                badgeCell.innerHTML = '<span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">Disetujui</span>';
                            }
                            const actionCell = row.querySelector('td:nth-child(6) .flex');
                            if (actionCell) {
                                const btnSetujui = actionCell.querySelector('button:last-child');
                                if (btnSetujui && btnSetujui !== actionCell.firstElementChild) {
                                    btnSetujui.remove();
                                }
                            }
                            alert(data.message || ('KRS untuk ' + nama + ' berhasil disetujui.'));
                            window.location.reload();
                        } else {
                            alert(data.message || 'Gagal menyetujui KRS');
                        }
                    })
                    .catch(err => {
                        alert('Terjadi kesalahan saat memproses persetujuan KRS.');
                    });
            }
        }
    </script>
@endsection