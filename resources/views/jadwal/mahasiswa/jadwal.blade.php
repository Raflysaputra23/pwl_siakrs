@extends('layouts.app')

@section('content')
@php
    $field = 'px-3 py-2 focus:outline-primary/10 focus:border-primary outline-transparent text-sm font-medium focus:outline-4 transition rounded-xl border border-slate-200 bg-surface w-full';
    $cards = [
        ['Kelas Saya', $stats['saya'], 'bg-primary/10 text-primary', 'book-open'],
        ['Total SKS', $stats['sks'], 'bg-blue-50 text-blue-600', 'bookmark'],
        ['Hari Kuliah / Minggu', $stats['hari'], 'bg-purple-50 text-purple-600', 'calendar'],
        ['Kelas Hari Ini', $stats['hariIni'], 'bg-emerald-50 text-emerald-600', 'clock'],
    ];
    $detail = [
        ['m-prodi', 'Program Studi', false], ['m-meta', 'Jenis / SKS / Semester', false],
        ['m-hari', 'Hari', false], ['m-jam', 'Jam', false],
        ['m-ruang', 'Ruangan', false], ['m-kelas', 'Kelas', false],
        ['m-koor', 'Dosen Koordinator', true], ['m-pend', 'Dosen Pendamping', true],
    ];
@endphp

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 text-white rounded-xl bg-primary shadow flex justify-center items-center shrink-0">
                <x-lucide-calendar class="size-5" />
            </div>
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Jadwal Kelas</h1>
                <p class="text-xs text-slate-600">Jadwal kuliah kamu dan daftar kelas yang dibuka pada Semester Ganjil 2026/2027.</p>
            </div>
        </div>
        <div class="inline-flex rounded-2xl bg-surface p-1.5 border border-slate-200 shadow-sm self-start sm:self-auto">
            <button type="button" data-scope="mine" class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 cursor-pointer bg-primary text-white shadow-sm">Kelas Saya</button>
            <button type="button" data-scope="all" class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 cursor-pointer text-slate-600 hover:text-slate-900">Semua Kelas</button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        @foreach ($cards as $c)
            <div class="flex items-center justify-between rounded-2xl bg-surface shadow-sm border border-slate-200 p-5">
                <div class="space-y-1">
                    <h2 class="text-xs text-slate-500 font-medium">{{ $c[0] }}</h2>
                    <p class="text-2xl font-bold text-slate-900">{{ $c[1] }}</p>
                </div>
                <div class="w-11 h-11 rounded-xl shadow-sm flex items-center justify-center {{ $c[2] }}">
                    <x-dynamic-component :component="'lucide-' . $c[3]" class="size-5" />
                </div>
            </div>
        @endforeach
    </div>

    <div class="rounded-2xl bg-surface shadow-sm border border-slate-200 p-5 space-y-4">
        <h2 class="text-sm font-bold text-slate-900">Jadwal Mingguan Saya</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-6 gap-3">
            @foreach ($hariList as $h)
                <div class="rounded-2xl border p-3 space-y-2 {{ $h === $hariIni ? 'border-primary bg-primary/5' : 'border-slate-200 bg-background' }}">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-bold uppercase text-slate-700">{{ $h }}</p>
                        @if ($h === $hariIni)
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-primary text-white">Hari ini</span>
                        @endif
                    </div>
                    @forelse ($mingguan[$h] as $m)
                        <div class="rounded-xl bg-surface border border-slate-200 p-2.5 space-y-1">
                            <p class="text-xs font-semibold text-slate-900 leading-snug">{{ $m['nama'] }}</p>
                            <p class="text-[11px] text-slate-500 flex items-center gap-1"><x-lucide-clock class="size-3" /> {{ $m['mulai'] }} - {{ $m['selesai'] }}</p>
                            <p class="text-[11px] text-slate-500 flex items-center gap-1"><x-lucide-map-pin class="size-3" /> {{ $m['ruangan'] }}</p>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400">Tidak ada kelas</p>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>

    <div class="rounded-2xl shadow-sm overflow-hidden bg-surface border border-slate-200">
        <div class="p-5 border-b border-slate-100 space-y-4">
            <div class="flex flex-wrap items-center gap-3">
                <div class="relative min-w-56 max-w-sm flex-1">
                    <input type="text" id="f-q" placeholder="Cari mata kuliah, kode, dosen, ruangan..." class="{{ $field }} ps-10" />
                    <x-lucide-search class="size-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
                </div>
                <select id="f-ta" class="{{ $field }} max-w-52">
                    @foreach ($tahunAkademik as $ta)
                        <option value="{{ $ta['value'] }}">{{ $ta['label'] }}</option>
                    @endforeach
                </select>
                <select id="f-prodi" class="{{ $field }} max-w-56">
                    <option value="">Semua Program Studi</option>
                    @foreach ($prodiList as $p)
                        <option value="{{ $p }}">{{ $p }}</option>
                    @endforeach
                </select>
                <select id="f-jenis" class="{{ $field }} max-w-40">
                    <option value="">Semua Jenis</option>
                    <option value="wajib">Wajib</option>
                    <option value="peminatan">Peminatan</option>
                </select>
                <button type="button" id="btn-reset" class="h-10 w-10 flex items-center justify-center rounded-xl border border-slate-200 text-slate-600 hover:bg-background cursor-pointer" title="Atur ulang filter">
                    <x-lucide-rotate-ccw class="size-4" />
                </button>
            </div>
            <div class="flex items-center flex-wrap gap-2">
                <button type="button" data-tab="semua" class="flex items-center gap-2 px-3.5 py-1.5 rounded-2xl border text-xs font-semibold cursor-pointer transition bg-primary text-white border-primary">
                    Semua <span data-count class="px-1.5 rounded-full bg-white/20">0</span>
                </button>
                @foreach ($hariList as $h)
                    <button type="button" data-tab="{{ $h }}" class="flex items-center gap-2 px-3.5 py-1.5 rounded-2xl border text-xs font-semibold cursor-pointer transition bg-surface text-slate-600 border-slate-200 hover:bg-background">
                        {{ ucfirst($h) }} <span data-count class="px-1.5 rounded-full bg-slate-100">0</span>
                    </button>
                @endforeach
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse min-w-250">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                        <th class="px-5 py-4">Mata Kuliah</th>
                        <th class="px-4 py-4 text-center">Kelas</th>
                        <th class="px-5 py-4">Dosen Pengampu</th>
                        <th class="px-5 py-4">Jadwal & Ruangan</th>
                        <th class="px-5 py-4 w-44">Kapasitas</th>
                        <th class="px-4 py-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody id="tbody" class="divide-y divide-slate-100">
                    @foreach ($kelas as $k)
                        @php
                            $pct = $k['kapasitas'] > 0 ? round($k['terisi'] / $k['kapasitas'] * 100) : 0;
                            $penuh = $k['terisi'] >= $k['kapasitas'];
                            $bar = $penuh ? 'bg-danger' : ($pct >= 80 ? 'bg-warning' : 'bg-success');
                            $jenisCls = $k['jenis'] === 'wajib' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700';
                        @endphp
                        <tr data-row data-id="{{ $k['id'] }}" data-ta="{{ $k['ta'] }}" data-prodi="{{ $k['prodi'] }}" data-jenis="{{ $k['jenis'] }}" data-hari="{{ $k['hari'] }}" data-mine="{{ $k['mine'] ? '1' : '0' }}" data-search="{{ strtolower(implode(' ', [$k['kode'], $k['nama'], $k['kelas'], $k['koor'], $k['pendamping'], $k['ruangan']])) }}" class="hover:bg-slate-50/70 transition">
                            <td class="px-5 py-4">
                                <p class="font-bold text-slate-900">{{ $k['nama'] }}</p>
                                <div class="flex items-center flex-wrap gap-2 mt-1">
                                    <span class="text-xs text-slate-500 font-mono">{{ $k['kode'] }}</span>
                                    <span class="text-xs text-slate-500">{{ $k['sks'] }} SKS</span>
                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full {{ $jenisCls }}">{{ ucfirst($k['jenis']) }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">{{ $k['kelas'] }}</span>
                            </td>
                            <td class="px-5 py-4">
                                <p class="text-xs font-semibold text-slate-800">{{ $k['koor'] }}</p>
                                @if ($k['pendamping'])
                                    <p class="text-[11px] text-slate-400">Pendamping: {{ $k['pendamping'] }}</p>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-medium text-slate-800 text-xs flex items-center gap-1.5"><x-lucide-clock class="size-3.5 text-slate-400" /> {{ ucfirst($k['hari']) }}, {{ $k['mulai'] }} - {{ $k['selesai'] }}</p>
                                <p class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5"><x-lucide-map-pin class="size-3.5 text-slate-400" /> {{ $k['ruangan'] }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-between text-xs mb-1.5">
                                    <span class="font-semibold text-slate-800">{{ $k['terisi'] }} / {{ $k['kapasitas'] }}</span>
                                    <span class="text-slate-500">{{ $pct }}%</span>
                                </div>
                                <div class="h-1.5 rounded-full bg-slate-100 overflow-hidden"><div class="h-full rounded-full {{ $bar }}" style="width: {{ $pct }}%"></div></div>
                            </td>
                            <td class="px-4 py-4 text-center">
                                @if ($k['mine'])
                                    <span class="text-xs font-semibold px-2.5 py-1 rounded-2xl bg-emerald-50 text-emerald-700 border border-emerald-200">Diambil</span>
                                @elseif ($penuh)
                                    <span class="text-xs font-semibold px-2.5 py-1 rounded-2xl bg-danger/10 text-danger border border-danger/30">Penuh</span>
                                @else
                                    <span class="text-xs font-semibold px-2.5 py-1 rounded-2xl bg-slate-100 text-slate-600 border border-slate-200">Tersedia</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <tr id="empty-row" class="hidden">
                        <td colspan="6" class="px-5 py-12 text-center">
                            <p class="text-sm font-semibold text-slate-800">Tidak ada kelas yang cocok</p>
                            <p class="text-xs text-slate-500 mt-1">Coba ubah kata kunci, filter, atau pilih "Semua Kelas".</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100 flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center gap-3">
                <p id="info" class="text-xs text-slate-600 bg-primary/5 border border-primary/20 rounded-xl px-3 py-2"></p>
                <select id="f-per" class="px-2 py-1.5 text-xs rounded-xl border border-slate-200 bg-surface outline-transparent focus:border-primary">
                    <option value="5">5 baris</option>
                    <option value="10" selected>10 baris</option>
                    <option value="25">25 baris</option>
                </select>
            </div>
            <div id="pager" class="flex items-center gap-1.5"></div>
        </div>
    </div>
</div>

<div id="modal" class="hidden fixed inset-0 z-50 items-center justify-center bg-slate-900/50 backdrop-blur-xs p-4">
    <div class="w-full max-w-lg rounded-2xl bg-surface shadow-xl border border-slate-200 overflow-hidden">
        <div class="flex items-start justify-between gap-4 p-5 border-b border-slate-100">
            <div class="min-w-0">
                <h3 id="m-nama" class="text-base font-bold text-slate-900 truncate"></h3>
                <p id="m-sub" class="text-xs text-slate-500 font-mono"></p>
            </div>
            <button type="button" id="m-close" class="w-8 h-8 shrink-0 flex items-center justify-center rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500 cursor-pointer"><x-lucide-x class="size-4" /></button>
        </div>
        <div class="p-5 grid grid-cols-2 gap-4">
            @foreach ($detail as $d)
                <div class="{{ $d[2] ? 'col-span-2' : '' }}">
                    <p class="text-xs text-slate-500">{{ $d[1] }}</p>
                    <p id="{{ $d[0] }}" class="text-sm font-semibold text-slate-900"></p>
                </div>
            @endforeach
            <div class="col-span-2">
                <div class="flex items-center justify-between text-xs mb-1.5">
                    <span class="text-slate-500">Keterisian kelas</span>
                    <span id="m-kap" class="font-semibold text-slate-900"></span>
                </div>
                <div class="h-2 rounded-full bg-slate-100 overflow-hidden"><div id="m-bar" class="h-full rounded-full"></div></div>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        const data = @json($kelas);
        const byId = {};
        data.forEach((k) => { byId[k.id] = k; });

        const $ = (id) => document.getElementById(id);
        const rows = Array.from(document.querySelectorAll('[data-row]'));
        const tabs = Array.from(document.querySelectorAll('[data-tab]'));
        const scopes = Array.from(document.querySelectorAll('[data-scope]'));
        const tabOn = ['bg-primary', 'text-white', 'border-primary'];
        const tabOff = ['bg-surface', 'text-slate-600', 'border-slate-200', 'hover:bg-background'];
        const scopeOn = ['bg-primary', 'text-white', 'shadow-sm'];
        const scopeOff = ['text-slate-600', 'hover:text-slate-900'];

        const state = { scope: 'mine', q: '', ta: $('f-ta').value, prodi: '', jenis: '', hari: 'semua', perPage: 10, page: 1 };

        const matches = (r, withHari) => {
            const d = r.dataset;
            if (state.scope === 'mine' && d.mine !== '1') return false;
            if (d.ta !== state.ta) return false;
            if (state.prodi && d.prodi !== state.prodi) return false;
            if (state.jenis && d.jenis !== state.jenis) return false;
            if (state.q && !d.search.includes(state.q)) return false;
            if (withHari && state.hari !== 'semua' && d.hari !== state.hari) return false;
            return true;
        };

        const pagerButton = (box, label, page, opts) => {
            const b = document.createElement('button');
            b.type = 'button';
            b.textContent = label;
            b.disabled = !!opts.disabled;
            b.className = 'min-w-8 h-8 px-2 text-xs rounded-lg border transition '
                + (opts.active ? 'bg-primary border-primary text-white font-semibold' : 'bg-surface border-slate-200 text-slate-600 hover:bg-background')
                + (opts.disabled ? ' opacity-40 cursor-not-allowed' : ' cursor-pointer');
            b.addEventListener('click', () => { state.page = page; render(); });
            box.append(b);
        };

        const renderPager = (pages) => {
            const box = $('pager');
            box.replaceChildren();
            const first = state.page === 1;
            const last = state.page === pages;
            pagerButton(box, '«', 1, { disabled: first });
            pagerButton(box, '‹', state.page - 1, { disabled: first });
            const from = Math.max(1, Math.min(state.page - 2, pages - 4));
            const to = Math.min(pages, from + 4);
            for (let p = from; p <= to; p++) pagerButton(box, String(p), p, { active: p === state.page });
            pagerButton(box, '›', state.page + 1, { disabled: last });
            pagerButton(box, '»', pages, { disabled: last });
        };

        const render = () => {
            const base = rows.filter((r) => matches(r, false));

            scopes.forEach((b) => {
                const active = b.dataset.scope === state.scope;
                scopeOn.forEach((c) => b.classList.toggle(c, active));
                scopeOff.forEach((c) => b.classList.toggle(c, !active));
            });

            tabs.forEach((b) => {
                const h = b.dataset.tab;
                const active = h === state.hari;
                const count = h === 'semua' ? base.length : base.filter((r) => r.dataset.hari === h).length;
                const badge = b.querySelector('[data-count]');
                badge.textContent = count;
                tabOn.forEach((c) => b.classList.toggle(c, active));
                tabOff.forEach((c) => b.classList.toggle(c, !active));
                badge.classList.toggle('bg-white/20', active);
                badge.classList.toggle('bg-slate-100', !active);
            });

            const list = rows.filter((r) => matches(r, true));
            const pages = Math.max(1, Math.ceil(list.length / state.perPage));
            if (state.page > pages) state.page = pages;
            const start = (state.page - 1) * state.perPage;
            const visible = new Set(list.slice(start, start + state.perPage));

            rows.forEach((r) => r.classList.toggle('hidden', !visible.has(r)));
            $('empty-row').classList.toggle('hidden', list.length > 0);
            $('info').textContent = list.length
                ? 'Menampilkan ' + (start + 1) + '-' + Math.min(start + state.perPage, list.length) + ' dari ' + list.length + ' kelas'
                : 'Tidak ada data';
            renderPager(pages);
        };

        scopes.forEach((b) => b.addEventListener('click', () => { state.scope = b.dataset.scope; state.page = 1; render(); }));
        tabs.forEach((b) => b.addEventListener('click', () => { state.hari = b.dataset.tab; state.page = 1; render(); }));
        $('f-q').addEventListener('input', (e) => { state.q = e.target.value.trim().toLowerCase(); state.page = 1; render(); });
        $('f-ta').addEventListener('change', (e) => { state.ta = e.target.value; state.page = 1; render(); });
        $('f-prodi').addEventListener('change', (e) => { state.prodi = e.target.value; state.page = 1; render(); });
        $('f-jenis').addEventListener('change', (e) => { state.jenis = e.target.value; state.page = 1; render(); });
        $('f-per').addEventListener('change', (e) => { state.perPage = Number(e.target.value); state.page = 1; render(); });

        $('btn-reset').addEventListener('click', () => {
            $('f-q').value = '';
            $('f-ta').selectedIndex = 0;
            $('f-prodi').value = '';
            $('f-jenis').value = '';
            Object.assign(state, { q: '', ta: $('f-ta').value, prodi: '', jenis: '', hari: 'semua', page: 1 });
            render();
        });

        const modal = $('modal');
        const cap = (s) => s.charAt(0).toUpperCase() + s.slice(1);

        const openDetail = (k) => {
            const pct = k.kapasitas ? Math.round(k.terisi / k.kapasitas * 100) : 0;
            const penuh = k.terisi >= k.kapasitas;
            const set = (id, v) => { $(id).textContent = v; };
            set('m-nama', k.nama);
            set('m-sub', k.kode + ' · Kelas ' + k.kelas);
            set('m-prodi', k.prodi);
            set('m-meta', cap(k.jenis) + ' · ' + k.sks + ' SKS · Smt ' + k.semester);
            set('m-hari', cap(k.hari));
            set('m-jam', k.mulai + ' - ' + k.selesai);
            set('m-ruang', k.ruangan);
            set('m-kelas', k.kelas);
            set('m-koor', k.koor);
            set('m-pend', k.pendamping || '-');
            set('m-kap', k.terisi + ' / ' + k.kapasitas + ' (' + pct + '%)' + (penuh ? ' · Penuh' : ''));
            const bar = $('m-bar');
            bar.style.width = pct + '%';
            bar.className = 'h-full rounded-full ' + (penuh ? 'bg-danger' : (pct >= 80 ? 'bg-warning' : 'bg-success'));
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        };

        const closeDetail = () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        };

        $('tbody').addEventListener('click', (e) => {
            const btn = e.target.closest('[data-detail]');
            if (btn) openDetail(byId[btn.closest('tr').dataset.id]);
        });
        $('m-close').addEventListener('click', closeDetail);
        modal.addEventListener('click', (e) => { if (e.target === modal) closeDetail(); });
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeDetail(); });

        render();
    })();
</script>
@endsection