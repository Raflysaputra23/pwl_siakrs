@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="mb-2 flex items-center gap-2 text-xs font-medium text-slate-400">
                <span>Akademik</span>
                <span>/</span>
                <span>Kartu Rencana Studi</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="size-10 text-white rounded-xl bg-primary shadow-sm shadow-primary/25 flex justify-center items-center shrink-0">
                    <x-lucide-calendar class="size-5" />
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Kartu Rencana Studi (KRS)</h1>
                    <p class="text-xs text-slate-500 mt-0.5">Pilih mata kuliah dan kelas yang akan ditempuh pada semester ini.</p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-2 self-start sm:self-auto">
            <span class="inline-flex items-center gap-1.5 rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs font-semibold text-emerald-700">
                <span class="size-2 rounded-full bg-emerald-500"></span>
                Periode KRS Aktif
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-5">
        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-surface p-5 shadow-sm">
            <div class="space-y-1">
                <p class="text-xs font-medium text-slate-500">Semester Aktif</p>
                <h2 class="text-2xl font-bold text-slate-900">{{ $semesterAktif ?? 'Semester 5' }}</h2>
                <p class="text-xs text-slate-400">Tahun Akademik 2026/2027</p>
            </div>
            <div class="size-11 rounded-xl shadow-sm bg-primary/10 text-primary flex items-center justify-center shrink-0">
                <x-lucide-calendar class="size-5" />
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-surface p-5 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <p class="text-xs font-medium text-slate-500">Total SKS Dipilih</p>
                <div class="size-11 rounded-xl shadow-sm bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <x-lucide-clock class="size-5" />
                </div>
            </div>
            <div class="mt-2">
                <div class="flex items-baseline gap-1.5">
                    <span id="totalSks" class="text-2xl font-bold text-slate-900">0</span>
                    <span class="text-xs text-slate-400">/ {{ $sksMaks ?? 24 }} SKS Maksimal</span>
                </div>
                <div class="mt-2.5 h-1.5 overflow-hidden rounded-full bg-slate-100">
                    <div
                        id="progressSks"
                        class="h-full rounded-full bg-primary transition-all duration-300"
                        style="width: 0%"
                    ></div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-surface p-5 shadow-sm">
            <div class="space-y-1">
                <p class="text-xs font-medium text-slate-500">Mata Kuliah Dipilih</p>
                <h2 id="totalMk" class="text-2xl font-bold text-slate-900">0</h2>
                <p class="text-xs text-slate-400">Mata kuliah dalam draft</p>
            </div>
            <div class="size-11 rounded-xl shadow-sm bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                <x-lucide-book-open class="size-5" />
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-surface p-5 shadow-sm">
            <div class="space-y-1">
                <p class="text-xs font-medium text-slate-500">Status KRS</p>
                @php
                    $rawStat = strtolower($statusKrs ?? '');
                    $colorClass = 'text-slate-600';
                    $keterangan = 'Pilih mata kuliah & ajukan';
                    if ($rawStat === 'disetujui') {
                        $colorClass = 'text-emerald-600';
                        $keterangan = 'KRS disetujui & terkunci';
                    } elseif ($rawStat === 'menunggu') {
                        $colorClass = 'text-amber-600';
                        $keterangan = 'Menunggu persetujuan Dosen PA';
                    } elseif ($rawStat === 'ditolak') {
                        $colorClass = 'text-red-600';
                        $keterangan = 'Perlu revisi / ditolak Dosen PA';
                    }
                @endphp
                <h2 id="statusKrs" class="text-base font-bold {{ $colorClass }} capitalize">
                    {{ $statusKrs ?? 'Belum Diajukan' }}
                </h2>
                <p class="text-xs text-slate-400">{{ $keterangan }}</p>
            </div>
            <div class="size-11 rounded-xl shadow-sm {{ $rawStat === 'disetujui' ? 'bg-emerald-50 text-emerald-600' : ($rawStat === 'ditolak' ? 'bg-red-50 text-red-600' : ($rawStat === 'menunggu' ? 'bg-amber-50 text-amber-600' : 'bg-slate-50 text-slate-400')) }} flex items-center justify-center shrink-0">
                <x-lucide-check-circle-2 class="size-5" />
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-surface shadow-sm">
        <div class="space-y-4 border-b border-slate-100 p-5">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-base font-bold text-slate-900">Daftar Mata Kuliah Ditawarkan</h2>
                    <p class="mt-1 text-xs text-slate-500">Pilih mata kuliah dan kelas sesuai dengan rencana studi semester Anda.</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-2.5">
                    <div class="relative min-w-0 sm:w-64">
                        <x-lucide-search class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-slate-400" />
                        <input
                            type="text"
                            id="searchMk"
                            placeholder="Cari mata kuliah, kode, dosen..."
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
            <table class="w-full min-w-212.5 border-collapse text-left text-sm">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-500">
                        <th class="px-5 py-4">Mata Kuliah</th>
                        <th class="px-4 py-4 text-center">SKS</th>
                        <th class="px-5 py-4">Dosen Pengampu</th>
                        <th class="px-5 py-4">Jadwal & Ruangan</th>
                        <th class="px-5 py-4 text-center">Kapasitas</th>
                        <th class="px-4 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody id="daftarMataKuliah" class="divide-y divide-slate-100">
                    @forelse ($mataKuliahList ?? ($mataKuliah ?? ($kelasTersedia ?? [])) as $mk)
                        @php
                            $idKelas = is_object($mk) ? ($mk->id ?? '') : '';
                            $kode = is_object($mk) ? ($mk->kode_mk ?? $mk->mataKuliah->kode_mk ?? $mk->kode ?? '-') : ($mk['kode_mk'] ?? $mk['kode'] ?? $mk[0] ?? '-');
                            $nama = is_object($mk) ? ($mk->nama_mk ?? $mk->mataKuliah->nama_mk ?? $mk->nama ?? '-') : ($mk['nama_mk'] ?? $mk['nama'] ?? $mk[1] ?? '-');
                            $sks = is_object($mk) ? ($mk->sks ?? $mk->mataKuliah->sks ?? 0) : ($mk['sks'] ?? $mk[2] ?? 0);
                            $dosen = is_object($mk) ? ($mk->dosenKoor->nama_lengkap ?? $mk->dosenKoor->nama ?? $mk->dosen_koor ?? $mk->dosen ?? '-') : ($mk['dosen'] ?? $mk['dosen_koor'] ?? $mk[3] ?? '-');
                            $hari = strtolower(is_object($mk) ? ($mk->hari ?? '') : ($mk['hari'] ?? $mk[4] ?? ''));
                            $jam = is_object($mk) ? (($mk->jam_mulai ? substr($mk->jam_mulai, 0, 5) : '') . ' - ' . ($mk->jam_selesai ? substr($mk->jam_selesai, 0, 5) : '')) : ($mk['jam'] ?? $mk[5] ?? '-');
                            $ruangan = is_object($mk) ? ($mk->ruangan ?? '-') : ($mk['ruangan'] ?? $mk[6] ?? '-');
                            $terisi = is_object($mk) ? ($mk->terisi ?? 0) : ($mk['terisi'] ?? $mk[7] ?? 0);
                            $kapasitas = is_object($mk) ? ($mk->kapasitas ?? 40) : ($mk['kapasitas'] ?? $mk[8] ?? 40);
                            $kelasNama = is_object($mk) ? ($mk->nama_kelas ?? $mk->kelas ?? 'Kelas A') : ($mk['nama_kelas'] ?? $mk['kelas'] ?? 'Kelas A');
                            $persentase = $kapasitas > 0 ? min(round(($terisi / $kapasitas) * 100), 100) : 0;
                            $isDipilih = in_array($idKelas, $krsSelectedKelasIds ?? []);
                        @endphp

                        <tr
                            class="course-row hover:bg-slate-50/70 transition"
                            data-id="{{ $idKelas }}"
                            data-kode="{{ $kode }}"
                            data-nama="{{ $nama }}"
                            data-sks="{{ $sks }}"
                            data-hari="{{ $hari }}"
                            data-search="{{ strtolower($kode . ' ' . $nama . ' ' . $dosen . ' ' . $ruangan . ' ' . $kelasNama) }}"
                        >
                            <td class="px-5 py-4">
                                <p class="font-bold text-slate-900">{{ $nama }}</p>
                                <div class="mt-1 flex flex-wrap items-center gap-2">
                                    <span class="font-mono text-xs text-slate-500">{{ $kode }}</span>
                                    <span class="text-xs text-slate-300">&bull;</span>
                                    <span class="text-xs text-slate-500">{{ $kelasNama }}</span>
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-center">
                                <span class="text-xs font-semibold text-slate-800">{{ $sks }} SKS</span>
                            </td>

                            <td class="px-5 py-4">
                                <p class="text-xs font-medium text-slate-700">{{ $dosen }}</p>
                            </td>

                            <td class="px-5 py-4">
                                <p class="flex items-center gap-1.5 text-xs font-semibold text-slate-800">
                                    <x-lucide-clock class="size-3.5 text-slate-400" />
                                    {{ ucfirst($hari) }}, {{ $jam }}
                                </p>
                                <p class="flex items-center gap-1.5 text-xs text-slate-500 mt-1">
                                    <x-lucide-map-pin class="size-3.5 text-slate-400" />
                                    {{ $ruangan }}
                                </p>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <p class="text-xs font-medium text-slate-800">{{ $terisi }} / {{ $kapasitas }}</p>
                                <div class="mt-1.5 h-1.5 w-20 mx-auto overflow-hidden rounded-full bg-slate-100">
                                    <div
                                        class="h-full rounded-full {{ $persentase >= 90 ? 'bg-amber-500' : 'bg-primary' }}"
                                        style="width: {{ $persentase }}%;"
                                    ></div>
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-4 py-4 text-center">
                                @if (strtolower($statusKrs ?? '') === 'disetujui')
                                    <button
                                        type="button"
                                        class="inline-flex items-center justify-center gap-1.5 rounded-xl {{ $isDipilih ? 'bg-emerald-600/80 text-white' : 'bg-slate-200 text-slate-400' }} px-4 py-2 text-xs font-bold shadow-xs cursor-not-allowed"
                                        disabled
                                        title="KRS telah disetujui Dosen PA dan terkunci."
                                    >
                                        {{ $isDipilih ? '✓ Terpilih' : '+ Pilih' }}
                                    </button>
                                @else
                                    <button
                                        type="button"
                                        class="pilihMk inline-flex items-center justify-center gap-1.5 rounded-xl {{ $isDipilih ? 'bg-emerald-600 hover:bg-emerald-700' : 'bg-primary hover:bg-primary-hover' }} px-4 py-2 text-xs font-bold text-white shadow-sm transition active:scale-95 cursor-pointer"
                                        data-id="{{ $idKelas }}"
                                        data-kode="{{ $kode }}"
                                        data-nama="{{ $nama }}"
                                        data-sks="{{ $sks }}"
                                    >
                                        {{ $isDipilih ? '✓ Dipilih' : '+ Pilih' }}
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr id="emptyRow">
                            <td colspan="6" class="px-5 py-12 text-center">
                                <x-lucide-book-x class="mx-auto size-9 text-slate-300" />
                                <p class="mt-3 text-sm font-semibold text-slate-700">Belum Ada Mata Kuliah yang Dibuka</p>
                                <p class="mt-1 text-xs text-slate-400">Daftar kelas perkuliahan belum dialokasikan oleh bagian akademik.</p>
                            </td>
                        </tr>
                    @endforelse

                    <tr id="clientEmptyRow" class="hidden">
                        <td colspan="6" class="px-5 py-12 text-center">
                            <x-lucide-search-x class="mx-auto size-8 text-slate-300" />
                            <p class="mt-3 text-sm font-semibold text-slate-700">Mata kuliah tidak ditemukan</p>
                            <p class="mt-1 text-xs text-slate-400">Coba gunakan kata kunci pencarian atau filter hari yang lain.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-t border-slate-100 p-5">
            <p class="text-xs text-slate-400">
                @if (strtolower($statusKrs ?? '') === 'disetujui')
                    <span class="text-emerald-700 font-medium">* KRS telah disetujui Dosen PA. Perubahan mata kuliah terkunci.</span>
                @else
                    * Pastikan mata kuliah yang dipilih tidak memiliki jadwal bentrok.
                @endif
            </p>

            <div class="flex flex-wrap items-center gap-2.5">
                @if (in_array(strtolower($statusKrs ?? ''), ['menunggu', 'ditolak']))
                    <button
                        type="button"
                        id="batalKrs"
                        class="inline-flex items-center justify-center gap-1.5 rounded-xl border border-red-200 bg-red-50 hover:bg-red-100 px-4 py-2.5 text-xs font-bold text-red-600 transition active:scale-95 cursor-pointer"
                    >
                        <x-lucide-undo-2 class="size-4" />
                        <span>Batalkan Pengajuan</span>
                    </button>
                @endif

                @if (strtolower($statusKrs ?? '') === 'disetujui')
                    <div class="inline-flex items-center gap-2 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-2.5 text-xs font-semibold text-emerald-800">
                        <x-lucide-lock class="size-4 text-emerald-600" />
                        <span>KRS telah disetujui Dosen PA dan terkunci.</span>
                    </div>
                @else
                    <button
                        type="button"
                        id="ajukanKrs"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary hover:bg-primary-hover px-5 py-2.5 text-xs font-bold text-white shadow-sm transition active:scale-95 cursor-pointer"
                    >
                        <span>{{ in_array(strtolower($statusKrs ?? ''), ['menunggu', 'ditolak']) ? 'Perbarui KRS' : 'Ajukan KRS' }}</span>
                        <x-lucide-arrow-right class="size-4" />
                    </button>
                @endif
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-blue-100 bg-blue-50/70 p-5">
        <div class="flex items-start gap-3.5">
            <div class="flex size-9 shrink-0 items-center justify-center rounded-xl bg-white text-blue-600 shadow-sm">
                <x-lucide-info class="size-5" />
            </div>
            <div>
                <h3 class="text-sm font-bold text-blue-900">Petunjuk Pengisian Kartu Rencana Studi</h3>
                <p class="mt-1.5 text-xs leading-5 text-blue-700">
                    Pastikan jumlah SKS yang Anda ambil tidak melebihi batas maksimal yang diperbolehkan berdasarkan IPS semester lalu.
                    Setelah memilih mata kuliah, klik tombol <strong>"Ajukan KRS"</strong> untuk mengirim draft ke Dosen Pembimbing Akademik (PA).
                </p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const terpilih = new Map();
    const batasSks = {{ $sksMaks ?? 24 }};

    const tombolPilih = document.querySelectorAll('.pilihMk');
    const barisMataKuliah = document.querySelectorAll('.course-row');
    const totalSksEl = document.getElementById('totalSks');
    const totalMkEl = document.getElementById('totalMk');
    const progressSksEl = document.getElementById('progressSks');
    const statusKrsEl = document.getElementById('statusKrs');
    const searchInput = document.getElementById('searchMk');
    const filterHari = document.getElementById('filterHari');
    const btnReset = document.getElementById('btnResetFilter');
    const emptyRow = document.getElementById('clientEmptyRow');

    function hitungTotalSks() {
        let total = 0;
        terpilih.forEach(function (mk) {
            total += mk.sks;
        });
        return total;
    }

    function updateKrs() {
        const total = hitungTotalSks();
        if (totalSksEl) totalSksEl.textContent = total;
        if (totalMkEl) totalMkEl.textContent = terpilih.size;
        if (progressSksEl) {
            progressSksEl.style.width = Math.min((total / batasSks) * 100, 100) + '%';
        }
    }

    tombolPilih.forEach(function (button) {
        if (button.classList.contains('bg-emerald-600')) {
            const id = button.dataset.id;
            const kode = button.dataset.kode;
            const nama = button.dataset.nama;
            const sks = Number(button.dataset.sks || 0);
            terpilih.set(kode, { id: id, nama: nama, sks: sks });
        }
    });

    tombolPilih.forEach(function (button) {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const kode = this.dataset.kode;
            const nama = this.dataset.nama;
            const sks = Number(this.dataset.sks || 0);

            if (terpilih.has(kode)) {
                terpilih.delete(kode);
            } else {
                if (hitungTotalSks() + sks > batasSks) {
                    alert('Total SKS tidak boleh melebihi ' + batasSks + ' SKS.');
                    return;
                }
                terpilih.set(kode, { id: id, nama: nama, sks: sks });
            }

            const dipilih = terpilih.has(kode);
            this.textContent = dipilih ? '✓ Dipilih' : '+ Pilih';
            this.classList.toggle('bg-emerald-600', dipilih);
            this.classList.toggle('hover:bg-emerald-700', dipilih);
            this.classList.toggle('bg-primary', !dipilih);
            this.classList.toggle('hover:bg-primary-hover', !dipilih);

            updateKrs();
        });
    });

    function filterTable() {
        const query = searchInput ? searchInput.value.trim().toLowerCase() : '';
        const hari = filterHari ? filterHari.value.toLowerCase() : '';
        let visibleCount = 0;

        barisMataKuliah.forEach(function (row) {
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
            emptyRow.classList.toggle('hidden', visibleCount > 0 || barisMataKuliah.length === 0);
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

    const ajukanBtn = document.getElementById('ajukanKrs');
    if (ajukanBtn) {
        ajukanBtn.addEventListener('click', function () {
            if (terpilih.size === 0) {
                alert('Pilih minimal satu mata kuliah terlebih dahulu sebelum mengajukan.');
                return;
            }

            const total = hitungTotalSks();
            const konfirmasi = confirm(
                'Ajukan KRS dengan ' + terpilih.size + ' mata kuliah (' + total + ' SKS)?\n\n' +
                'Setelah diajukan, status akan berubah menjadi Menunggu Persetujuan Dosen PA.'
            );

            if (!konfirmasi) return;

            const kelasIds = [];
            terpilih.forEach(function (mk) {
                if (mk.id) kelasIds.push(mk.id);
            });

            const originalBtnHtml = ajukanBtn.innerHTML;
            ajukanBtn.disabled = true;
            ajukanBtn.innerText = 'Mengajukan...';

            fetch('{{ route("krs.ajukan") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ kelas_ids: kelasIds })
            })
            .then(res => res.json())
            .then(data => {
                ajukanBtn.disabled = false;
                ajukanBtn.innerHTML = originalBtnHtml;

                if (data.success) {
                    if (statusKrsEl) {
                        statusKrsEl.textContent = 'Menunggu Persetujuan';
                        statusKrsEl.className = 'text-base font-bold text-amber-600 capitalize';
                    }
                    alert(data.message || 'KRS berhasil diajukan! Menunggu verifikasi oleh Dosen Pembimbing Akademik.');
                    window.location.reload();
                } else {
                    alert(data.message || 'Gagal mengajukan KRS');
                }
            })
            .catch(err => {
                ajukanBtn.disabled = false;
                ajukanBtn.innerHTML = originalBtnHtml;
                alert('Terjadi kesalahan saat memproses pengajuan KRS.');
            });
        });
    }

    const batalBtn = document.getElementById('batalKrs');
    if (batalBtn) {
        batalBtn.addEventListener('click', function () {
            const konfirmasi = confirm(
                'Apakah Anda yakin ingin membatalkan pengajuan KRS ini?\n\n' +
                'Semua mata kuliah yang telah dipilih akan dihapus dan status akan kembali menjadi Belum Diajukan.'
            );

            if (!konfirmasi) return;

            const originalBtnHtml = batalBtn.innerHTML;
            batalBtn.disabled = true;
            batalBtn.innerText = 'Membatalkan...';

            fetch('{{ route("krs.batal") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                batalBtn.disabled = false;
                batalBtn.innerHTML = originalBtnHtml;

                if (data.success) {
                    alert(data.message || 'Pengajuan KRS berhasil dibatalkan');
                    window.location.reload();
                } else {
                    alert(data.message || 'Gagal membatalkan KRS');
                }
            })
            .catch(err => {
                batalBtn.disabled = false;
                batalBtn.innerHTML = originalBtnHtml;
                alert('Terjadi kesalahan saat membatalkan pengajuan KRS.');
            });
        });
    }

    updateKrs();
});
</script>
@endsection