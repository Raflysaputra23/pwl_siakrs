@extends('layouts.app')

@section('content')
@php
    $role = request('role', 'mahasiswa');

    $d = [
        'mahasiswa' => [
            'nama' => 'Nadia Putri Maharani, S.Kom.', 'role' => 'Mahasiswa', 'idLabel' => 'NIM', 'id' => '2215061018', 'unit' => 'Teknik Informatika',
            'statTitle' => 'Ringkasan Akademik',
            'stats' => [['IPK Kumulatif', '3.86', 'Cumlaude Track'], ['Total SKS Lulus', '112 / 144', 'Semester 9']],
            'fields' => [
                ['Nama Lengkap', 'user', 'Nadia Putri Maharani, S.Kom.'],
                ['Username SIAKAD', 'at-sign', 'nadia.putri'],
                ['NIM', 'id-card', '2215061018'],
                ['Program Studi', 'graduation-cap', 'Teknik Informatika'],
                ['Email', 'mail', 'nadia.putri@example.ac.id'],
                ['No. Telepon', 'phone', '0812-3456-7890'],
                ['Tempat, Tanggal Lahir', 'calendar-days', 'Bandar Lampung, 12 Mei 2003'],
                ['Angkatan', 'calendar', '2022'],
                ['Alamat', 'map-pin', 'Jl. Soemantri Brojonegoro No. 1, Gedong Meneng, Bandar Lampung'],
            ],
        ],
        'dosen' => [
            'nama' => 'Dr. Hendra Kurniawan, M.T.', 'role' => 'Dosen', 'idLabel' => 'NIP', 'id' => '198001012005011001', 'unit' => 'Teknik Informatika',
            'statTitle' => 'Ringkasan Mengajar',
            'stats' => [['Mahasiswa Bimbingan', '24', 'Sebagai Dosen PA'], ['KRS Menunggu', '5', 'Perlu persetujuan'], ['Kelas Diampu', '4', 'Ganjil 2026/2027'], ['Total SKS Ajar', '10', 'Semester ini']],
            'fields' => [
                ['Nama Lengkap', 'user', 'Hendra Kurniawan'],
                ['Username SIAKAD', 'at-sign', 'hendra.k'],
                ['NIP', 'id-card', '198001012005011001'],
                ['Unit / Jurusan', 'building-2', 'Teknik Informatika'],
                ['Gelar Depan', 'award', 'Dr.'],
                ['Gelar Belakang', 'award', 'M.T.'],
                ['Email', 'mail', 'hendra.k@example.ac.id'],
                ['No. Telepon', 'phone', '0811-2233-4455'],
                ['Alamat', 'map-pin', 'Jl. Soemantri Brojonegoro No. 1, Gedong Meneng, Bandar Lampung'],
            ],
        ],
        'admin' => [
            'nama' => 'Administrator SIAKAD', 'role' => 'Admin', 'idLabel' => 'ID', 'id' => 'ADM-001', 'unit' => 'Bagian Akademik',
            'statTitle' => 'Ringkasan Sistem',
            'stats' => [['Total Mahasiswa', '1.240', 'Status aktif'], ['Total Dosen', '58', 'Terdaftar'], ['Mata Kuliah', '86', 'Semua prodi'], ['Program Studi', '6', '2 fakultas']],
            'fields' => [
                ['Nama Lengkap', 'user', 'Administrator SIAKAD'],
                ['Username', 'at-sign', 'admin'],
                ['Unit', 'building-2', 'Bagian Akademik'],
                ['Email', 'mail', 'admin@example.ac.id'],
                ['No. Telepon', 'phone', '0721-123456'],
            ],
        ],
    ][$role];

    $inputCls = 'px-3 py-2 ps-10 text-sm font-medium rounded-xl border border-slate-200 bg-background w-full outline-transparent focus:outline-primary/10 focus:border-primary focus:outline-4 transition';
@endphp

<div>
    <div class="rounded-2xl bg-gradient-to-r from-primary to-secondary shadow-sm border border-primary/30 p-6 mb-5">
        <div class="flex flex-wrap items-center gap-6">
            <div class="w-28 h-28 shrink-0">
                <div id="avatar-fallback" class="w-28 h-28 rounded-2xl border-4 border-white/80 bg-white/20 text-white shadow flex items-center justify-center text-3xl font-bold">{{ strtoupper(substr($d['nama'], 0, 1)) }}</div>
                <img id="avatar-preview" src="" alt="Foto profil" class="hidden w-28 h-28 rounded-2xl border-4 border-white/80 bg-background object-cover shadow">
            </div>
            <div class="flex-1 min-w-60 space-y-3">
                <h2 id="hero-name" class="text-2xl font-bold text-white">{{ $d['nama'] }}</h2>
                <div class="flex items-center flex-wrap gap-x-4 gap-y-2 text-xs text-white">
                    <span class="bg-white/20 border border-white/40 font-semibold px-2.5 py-1 rounded-2xl">{{ $d['role'] }}</span>
                    <span class="inline-flex items-center gap-1.5"><x-lucide-id-card class="size-4" /> {{ $d['idLabel'] }}: {{ $d['id'] }}</span>
                    <span class="inline-flex items-center gap-1.5"><x-lucide-graduation-cap class="size-4" /> {{ $d['unit'] }}</span>
                </div>
            </div>
            <div class="flex items-center flex-wrap gap-3">
                <input type="file" id="avatar-input" accept="image/*" class="hidden">
                <button type="button" id="btn-avatar" class="flex items-center gap-2 rounded-2xl bg-white/15 border border-white/50 text-white px-3.5 py-2 cursor-pointer hover:bg-white/25 transition">
                    <x-lucide-camera class="size-4" /><span id="btn-avatar-label" class="text-sm">Tambah Foto Profil</span>
                </button>
                <button type="button" id="btn-photo-del" class="hidden items-center gap-2 rounded-2xl bg-danger/20 border border-white/50 text-white px-3.5 py-2 cursor-pointer hover:bg-danger/40 transition">
                    <x-lucide-trash-2 class="size-4" /><span class="text-sm">Hapus Foto Profil</span>
                </button>
                @if ($role === 'mahasiswa')
                    <button type="button" class="flex items-center gap-2 rounded-2xl bg-white hover:bg-background transition text-primary font-semibold px-3.5 py-2 cursor-pointer">
                        <x-lucide-printer class="size-4" /><span class="text-sm">Cetak Kartu KRS</span>
                    </button>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-[340px_1fr] gap-5">
        <div class="space-y-5">
            <div class="rounded-2xl bg-surface shadow-sm border border-slate-200 p-5 space-y-4">
                <h3 class="text-xs font-semibold uppercase text-slate-600">{{ $d['statTitle'] }}</h3>
                <div class="grid grid-cols-2 gap-3">
                    @foreach ($d['stats'] as $i => $s)
                        <div class="bg-background border border-slate-200 rounded-2xl p-3 space-y-1">
                            <p class="text-xs text-slate-500">{{ $s[0] }}</p>
                            <p class="text-xl font-bold {{ $i === 0 ? 'text-primary' : '' }}">{{ $s[1] }}</p>
                            <p class="text-xs text-slate-500">{{ $s[2] }}</p>
                        </div>
                    @endforeach
                </div>

                @if ($role === 'mahasiswa')
                    <div class="space-y-1.5">
                        <div class="flex justify-between text-xs text-slate-600"><span>Progres studi</span><span class="font-semibold">78%</span></div>
                        <div class="h-2 rounded-full bg-background border border-slate-200 overflow-hidden">
                            <div class="h-full bg-primary rounded-full" style="width: 78%"></div>
                        </div>
                    </div>
                @endif
            </div>

            @if ($role === 'mahasiswa')
                <div class="rounded-2xl bg-surface shadow-sm border border-slate-200 p-5 space-y-4">
                    <h3 class="text-xs font-semibold uppercase text-slate-600">Dosen Pembimbing Akademik</h3>
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl shadow bg-primary/10 text-primary flex items-center justify-center"><x-lucide-user class="size-5" /></div>
                        <div class="min-w-0">
                            <h4 class="text-sm font-semibold truncate">Dr. Hendra Kurniawan, M.T.</h4>
                            <p class="text-xs text-slate-500">NIP 198001012005011001</p>
                        </div>
                    </div>
                </div>
            @elseif ($role === 'dosen')
                <div class="rounded-2xl bg-surface shadow-sm border border-slate-200 p-5 space-y-3">
                    <h3 class="text-xs font-semibold uppercase text-slate-600">Kelas Semester Ini</h3>
                    @foreach ([
                        ['Pemrograman Web Lanjut - A', 'Senin, 08:00 - 10:30', 'MIPA T'],
                        ['Basis Data - B', 'Rabu, 10:00 - 12:30', 'MIPA T'],
                        ['Rekayasa Perangkat Lunak - C', 'Kamis, 13:00 - 15:30', 'GIK'],
                    ] as $k)
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 shrink-0 rounded-xl shadow bg-primary/10 text-primary flex items-center justify-center"><x-lucide-book-open class="size-5" /></div>
                            <div class="min-w-0">
                                <h4 class="text-sm font-semibold truncate">{{ $k[0] }}</h4>
                                <p class="text-xs text-slate-500">{{ $k[1] }} &middot; {{ $k[2] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="rounded-2xl bg-surface shadow-sm border border-slate-200 p-5 space-y-3">
                    <h3 class="text-xs font-semibold uppercase text-slate-600">Hak Akses</h3>
                    @foreach (['Kelola user', 'Kelola mata kuliah & kelas', 'Atur tahun akademik aktif', 'Pantau persetujuan KRS'] as $a)
                        <p class="flex items-center gap-2.5 text-sm"><x-lucide-shield-check class="size-4 text-primary shrink-0" /> {{ $a }}</p>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="rounded-2xl bg-surface shadow-sm border border-slate-200 p-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl shadow bg-primary/10 text-primary flex items-center justify-center"><x-lucide-contact class="size-5" /></div>
                <h3 class="text-base font-semibold">Informasi Data Diri</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @foreach ($d['fields'] as $f)
                    <div class="space-y-1.5 {{ $f[0] === 'Alamat' ? 'md:col-span-2' : '' }}">
                        <label class="text-xs font-semibold uppercase text-slate-600">{{ $f[0] }}</label>
                        <div class="relative">
                            <x-dynamic-component :component="'lucide-' . $f[1]" class="size-4 text-slate-500 absolute left-3 top-1/2 -translate-y-1/2" />
                            <input type="text" value="{{ $f[2] }}" readonly data-editable data-key="{{ \Illuminate\Support\Str::slug($f[0]) }}" class="{{ $inputCls }}" />
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex items-center justify-end gap-3 mt-6 pt-5 border-t border-slate-200">
                <button type="button" id="btn-edit" class="flex items-center gap-2 rounded-2xl bg-primary hover:bg-primary-hover transition text-white px-3.5 py-2 cursor-pointer">
                    <x-lucide-pencil class="size-4" /><span class="text-sm">Edit Profil</span>
                </button>
                <div id="edit-actions" class="hidden items-center gap-3">
                    <button type="button" id="btn-cancel" class="flex items-center gap-2 rounded-2xl bg-background border border-slate-300 px-3.5 py-2 cursor-pointer hover:border-danger hover:text-danger transition">
                        <x-lucide-x class="size-4" /><span class="text-sm">Batal</span>
                    </button>
                    <button type="button" id="btn-save" class="flex items-center gap-2 rounded-2xl bg-primary hover:bg-primary-hover transition text-white px-3.5 py-2 cursor-pointer">
                        <x-lucide-check class="size-4" /><span class="text-sm">Simpan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="toast" class="hidden fixed bottom-6 right-6 z-50 max-w-sm rounded-2xl bg-surface shadow border border-slate-200 px-4 py-3 text-sm"></div>

<script>
    (function () {
        const role = '{{ $role }}';
        const fields = document.querySelectorAll('[data-editable]');
        const heroName = document.getElementById('hero-name');
        const avatarFallback = document.getElementById('avatar-fallback');
        const avatarPreview = document.getElementById('avatar-preview');
        const avatarInput = document.getElementById('avatar-input');
        const btnAvatar = document.getElementById('btn-avatar');
        const btnAvatarLabel = document.getElementById('btn-avatar-label');
        const btnPhotoDel = document.getElementById('btn-photo-del');
        const btnEdit = document.getElementById('btn-edit');
        const editActions = document.getElementById('edit-actions');
        const toast = document.getElementById('toast');
        const DATA_KEY = 'profil-' + role;
        const PHOTO_KEY = 'foto-profil-' + role;
        const original = [];
        let toastTimer = null;

        const showToast = (msg, isError) => {
            toast.textContent = msg;
            toast.classList.remove('hidden', 'text-danger');
            if (isError) toast.classList.add('text-danger');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(() => toast.classList.add('hidden'), 2500);
        };

        const readJson = (key) => {
            try { return JSON.parse(localStorage.getItem(key)); } catch (e) { return null; }
        };

        const write = (key, value) => {
            try { localStorage.setItem(key, value); return true; } catch (e) { return false; }
        };

        const val = (key) => {
            const el = document.querySelector('[data-key="' + key + '"]');
            return el ? el.value.trim() : '';
        };

        const refreshHero = () => {
            let nama = val('nama-lengkap');
            if (!nama) return;
            if (role === 'dosen') {
                nama = [val('gelar-depan'), nama].filter(Boolean).join(' ');
                if (val('gelar-belakang')) nama += ', ' + val('gelar-belakang');
            }
            heroName.textContent = nama;
            avatarFallback.textContent = nama.charAt(0).toUpperCase();
        };

        const setEditing = (on) => {
            fields.forEach((el) => {
                el.readOnly = !on;
                el.classList.toggle('bg-background', !on);
                el.classList.toggle('bg-white', on);
                el.classList.toggle('border-primary/50', on);
            });
            btnEdit.classList.toggle('hidden', on);
            editActions.classList.toggle('hidden', !on);
            editActions.classList.toggle('flex', on);
        };

        const showPhoto = (src) => {
            const has = !!src;
            if (has) avatarPreview.src = src;
            avatarPreview.classList.toggle('hidden', !has);
            avatarFallback.classList.toggle('hidden', has);
            btnPhotoDel.classList.toggle('hidden', !has);
            btnPhotoDel.classList.toggle('flex', has);
            btnAvatarLabel.textContent = has ? 'Ganti Foto Profil' : 'Tambah Foto Profil';
        };

        const savedData = readJson(DATA_KEY);
        if (savedData) {
            fields.forEach((el) => {
                if (savedData[el.dataset.key] !== undefined) el.value = savedData[el.dataset.key];
            });
            refreshHero();
        }

        showPhoto(localStorage.getItem(PHOTO_KEY));

        btnEdit.addEventListener('click', () => {
            fields.forEach((el, i) => { original[i] = el.value; });
            setEditing(true);
            fields[0].focus({ preventScroll: true });
        });

        document.getElementById('btn-cancel').addEventListener('click', () => {
            fields.forEach((el, i) => { el.value = original[i]; });
            setEditing(false);
        });

        document.getElementById('btn-save').addEventListener('click', () => {
            if (val('nama-lengkap') === '') {
                showToast('Nama lengkap tidak boleh kosong.', true);
                document.querySelector('[data-key="nama-lengkap"]').focus({ preventScroll: true });
                return;
            }
            const data = {};
            fields.forEach((el) => { data[el.dataset.key] = el.value; });
            if (!write(DATA_KEY, JSON.stringify(data))) {
                showToast('Gagal menyimpan, penyimpanan browser penuh.', true);
                return;
            }
            refreshHero();
            setEditing(false);
            showToast('Perubahan profil disimpan.');
        });

        btnAvatar.addEventListener('click', () => avatarInput.click());

        avatarInput.addEventListener('change', () => {
            const file = avatarInput.files[0];
            avatarInput.value = '';
            if (!file) return;
            if (!file.type.startsWith('image/')) { showToast('File harus berupa gambar.', true); return; }
            if (file.size > 5 * 1024 * 1024) { showToast('Ukuran gambar maksimal 5 MB.', true); return; }
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = new Image();
                img.onload = () => {
                    const ratio = Math.min(1, 400 / Math.max(img.width, img.height));
                    const canvas = document.createElement('canvas');
                    canvas.width = Math.round(img.width * ratio);
                    canvas.height = Math.round(img.height * ratio);
                    canvas.getContext('2d').drawImage(img, 0, 0, canvas.width, canvas.height);
                    const data = canvas.toDataURL('image/jpeg', 0.85);
                    if (!write(PHOTO_KEY, data)) {
                        showToast('Gagal menyimpan foto, penyimpanan browser penuh.', true);
                        return;
                    }
                    showPhoto(data);
                    showToast('Foto profil disimpan.');
                };
                img.onerror = () => showToast('File bukan gambar yang valid.', true);
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });

        btnPhotoDel.addEventListener('click', () => {
            if (!confirm('Hapus foto profil?')) return;
            try { localStorage.removeItem(PHOTO_KEY); } catch (e) {}
            showPhoto(null);
            showToast('Foto profil dihapus.');
        });
    })();
</script>
@endsection