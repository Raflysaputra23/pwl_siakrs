<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataMahasiswaModel;
use App\Models\DosenModel;
use App\Models\KelasModel;
use App\Models\KrsMahasiswaModel;
use App\Models\KrsModel;
use App\Models\MahasiswaModel;
use App\Models\MatakuliahModel;
use App\Models\ProgramStudiModel;
use App\Models\TahunAkademikModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->role === 'admin') {
            return $this->dashboardAdmin();
        } else if ($user->role === 'dosen') {
            return $this->dashboardDosen($user);
        } else if ($user->role === 'mahasiswa') {
            return $this->dashboardMahasiswa($user);
        }

        abort(403, 'Role tidak ditemukan');
    }

    private function dashboardAdmin()
    {
        $tahunAkademikAktif = TahunAkademikModel::getAktif() ?? TahunAkademikModel::orderBy('created_at', 'desc')->first();

        $totalMahasiswa = MahasiswaModel::count();
        $mahasiswaAktif = MahasiswaModel::where('status', 'aktif')->count();
        $mahasiswaCuti = MahasiswaModel::where('status', 'cuti')->count();
        $mahasiswaLulus = MahasiswaModel::where('status', 'lulus')->count();

        $totalDosen = DosenModel::count();
        $dosenPaCount = MahasiswaModel::whereNotNull('dosen_pa_nip')->distinct()->count('dosen_pa_nip');
        $dosenPengampuCount = KelasModel::whereNotNull('dosen_koor')->distinct()->count('dosen_koor');

        $totalMk = MatakuliahModel::count();
        $mkWajib = MatakuliahModel::where('jenis', 'wajib')->count();
        $mkPeminatan = MatakuliahModel::where('jenis', 'peminatan')->count();
        $totalKelas = KelasModel::count();

        $krsQuery = KrsMahasiswaModel::query();
        if ($tahunAkademikAktif) {
            $krsQuery->whereHas('dataMahasiswa', function ($q) use ($tahunAkademikAktif) {
                $q->where('id_tahun_akademik', $tahunAkademikAktif->id);
            });
        }
        $totalKrsDiajukan = (clone $krsQuery)->count();
        $krsMenunggu = (clone $krsQuery)->where('status', 'menunggu')->count();
        $krsDisetujui = (clone $krsQuery)->where('status', 'disetujui')->count();
        $krsDitolak = (clone $krsQuery)->where('status', 'ditolak')->count();

        $prodiList = ProgramStudiModel::with(['fakultas', 'mataKuliah.kelas'])
            ->withCount([
                'mahasiswa as mahasiswa_aktif_count' => function ($q) {
                    $q->where('status', 'aktif');
                }
            ])
            ->get()
            ->map(function ($prodi) {
                $mataKuliah = $prodi->mataKuliah;
                $prodi->mk_count = $mataKuliah->count();
                $allKelas = $mataKuliah->flatMap->kelas;
                $prodi->kelas_count = $allKelas->count();
                $totalKapasitas = (int) $allKelas->sum('kapasitas');
                $kelasIds = $allKelas->pluck('id')->toArray();

                $totalTerisi = 0;
                if (!empty($kelasIds)) {
                    $totalTerisi = KrsModel::whereIn('id_kelas', $kelasIds)
                        ->whereHas('krsMahasiswa', function ($q) {
                            $q->whereIn('status', ['menunggu', 'disetujui']);
                        })
                        ->count();
                }

                $prodi->kapasitas = $totalKapasitas;
                $prodi->terisi = $totalTerisi;
                $prodi->persentase_okupansi = $totalKapasitas > 0 ? min(100, round(($totalTerisi / $totalKapasitas) * 100)) : 0;

                return $prodi;
            });

        $pengajuanTerkini = KrsMahasiswaModel::with([
            'dataMahasiswa.mahasiswa.programStudi',
            'dosenPa',
            'krsItems.kelas.mataKuliah',
        ])
        ->when($tahunAkademikAktif, function ($q) use ($tahunAkademikAktif) {
            $q->whereHas('dataMahasiswa', function ($sq) use ($tahunAkademikAktif) {
                $sq->where('id_tahun_akademik', $tahunAkademikAktif->id);
            });
        })
        ->latest()
        ->take(10)
        ->get();

        return view('dashboard.admin.dashboard', compact(
            'tahunAkademikAktif',
            'totalMahasiswa',
            'mahasiswaAktif',
            'mahasiswaCuti',
            'mahasiswaLulus',
            'totalDosen',
            'dosenPaCount',
            'dosenPengampuCount',
            'totalMk',
            'mkWajib',
            'mkPeminatan',
            'totalKelas',
            'totalKrsDiajukan',
            'krsMenunggu',
            'krsDisetujui',
            'krsDitolak',
            'prodiList',
            'pengajuanTerkini'
        ));
    }

    private function dashboardDosen($user)
    {
        $dosen = DosenModel::where('id_user', $user->id)->first();
        $tahunAkademikAktif = TahunAkademikModel::getAktif() ?? TahunAkademikModel::orderBy('created_at', 'desc')->first();
        $nip = $dosen ? trim($dosen->nip) : null;

        $namaLengkap = $dosen ? $dosen->nama_lengkap : ($user->nama ?? 'Dosen');
        $namaParts = array_values(array_filter(explode(' ', trim($namaLengkap))));
        $inisialDosen = strtoupper(substr($namaParts[0] ?? 'D', 0, 1) . substr($namaParts[1] ?? '', 0, 1));
        if (strlen($inisialDosen) === 1 && isset($namaParts[0][1])) {
            $inisialDosen = strtoupper(substr($namaParts[0], 0, 2));
        }

        $totalBimbingan = 0;
        $bimbinganSudahKrs = 0;
        $bimbinganBelumKrs = 0;

        if ($nip) {
            $totalBimbingan = MahasiswaModel::where('dosen_pa_nip', $nip)->count();

            if ($tahunAkademikAktif) {
                $bimbinganSudahKrs = KrsMahasiswaModel::where('dosen_pa_nip', $nip)
                    ->whereHas('dataMahasiswa', function ($q) use ($tahunAkademikAktif) {
                        $q->where('id_tahun_akademik', $tahunAkademikAktif->id);
                    })
                    ->distinct('id_data_mahasiswa')
                    ->count('id_data_mahasiswa');
            } else {
                $bimbinganSudahKrs = KrsMahasiswaModel::where('dosen_pa_nip', $nip)
                    ->distinct('id_data_mahasiswa')
                    ->count('id_data_mahasiswa');
            }
            $bimbinganBelumKrs = max(0, $totalBimbingan - $bimbinganSudahKrs);
        }

        $pengajuanBimbingan = collect();
        $krsMenungguCount = 0;
        $krsDisetujuiCount = 0;

        if ($nip) {
            $pengajuanQuery = KrsMahasiswaModel::with([
                'dataMahasiswa.mahasiswa.programStudi',
                'dataMahasiswa.tahunAkademik',
                'krsItems.kelas.mataKuliah',
                'dosenPa'
            ])
            ->where('dosen_pa_nip', $nip);

            if ($tahunAkademikAktif) {
                $pengajuanQuery->whereHas('dataMahasiswa', function ($q) use ($tahunAkademikAktif) {
                    $q->where('id_tahun_akademik', $tahunAkademikAktif->id);
                });
            }

            $pengajuanBimbingan = $pengajuanQuery->latest()->get();
            $krsMenungguCount = $pengajuanBimbingan->where('status', 'menunggu')->count();
            $krsDisetujuiCount = $pengajuanBimbingan->where('status', 'disetujui')->count();
        }

        $jadwalMengajar = collect();
        $totalKelasDiampu = 0;
        $dosenKoorCount = 0;
        $dosenPendampingCount = 0;
        $totalSksMengajar = 0;

        if ($nip) {
            $jadwalMengajar = KelasModel::with([
                'mataKuliah.programStudi',
                'dosenKoor',
                'dosenPendamping',
            ])
            ->where(function ($q) use ($nip) {
                $q->where('dosen_koor', $nip)
                  ->orWhere('dosen_pendamping', $nip);
            })
            ->get()
            ->map(function ($kelas) use ($nip, &$dosenKoorCount, &$dosenPendampingCount) {
                $isKoor = trim($kelas->dosen_koor) === $nip;
                if ($isKoor) {
                    $dosenKoorCount++;
                    $kelas->peran = 'Dosen Koordinator';
                } else {
                    $dosenPendampingCount++;
                    $kelas->peran = 'Dosen Pendamping';
                }

                $kelas->terisi = KrsModel::where('id_kelas', $kelas->id)
                    ->whereHas('krsMahasiswa', fn($q) => $q->whereIn('status', ['menunggu', 'disetujui']))
                    ->count();

                $kapasitas = (int) ($kelas->kapasitas ?? 0);
                $kelas->persentase_terisi = $kapasitas > 0 ? min(100, round(($kelas->terisi / $kapasitas) * 100)) : 0;

                return $kelas;
            })
            ->sortBy(function ($k) {
                $hariOrder = ['senin' => 1, 'selasa' => 2, 'rabu' => 3, 'kamis' => 4, 'jumat' => 5, 'sabtu' => 6, 'minggu' => 7];
                $order = $hariOrder[strtolower($k->hari)] ?? 99;
                $jam = (int) str_replace(':', '', substr($k->jam_mulai, 0, 5));
                return $order * 100000 + $jam;
            })
            ->values();

            $totalKelasDiampu = $jadwalMengajar->count();
            $totalSksMengajar = $jadwalMengajar->sum(fn($k) => $k->mataKuliah->sks ?? 0);
        }

        return view('dashboard.dosen.dashboard', compact(
            'dosen',
            'inisialDosen',
            'tahunAkademikAktif',
            'totalBimbingan',
            'bimbinganSudahKrs',
            'bimbinganBelumKrs',
            'krsMenungguCount',
            'krsDisetujuiCount',
            'totalKelasDiampu',
            'dosenKoorCount',
            'dosenPendampingCount',
            'totalSksMengajar',
            'pengajuanBimbingan',
            'jadwalMengajar'
        ));
    }

    private function dashboardMahasiswa($user)
    {
        $mahasiswa = MahasiswaModel::with(['programStudi.fakultas', 'dosenPa'])
            ->where('id_user', $user->id)
            ->first();

        $tahunAkademikAktif = TahunAkademikModel::getAktif() ?? TahunAkademikModel::orderBy('created_at', 'desc')->first();

        $namaLengkap = $mahasiswa ? $mahasiswa->nama_lengkap : ($user->nama ?? 'Mahasiswa');
        $namaParts = array_values(array_filter(explode(' ', trim($namaLengkap))));
        $inisialMhs = strtoupper(substr($namaParts[0] ?? 'M', 0, 1) . substr($namaParts[1] ?? '', 0, 1));
        if (strlen($inisialMhs) === 1 && isset($namaParts[0][1])) {
            $inisialMhs = strtoupper(substr($namaParts[0], 0, 2));
        }

        $dataMahasiswa = null;
        $krsMahasiswa = null;
        $krsItems = collect();
        $totalSksDiambil = 0;
        $totalMkDiambil = 0;
        $statusKrs = 'Belum Diajukan';
        $tanggalPersetujuan = null;

        if ($mahasiswa) {
            if ($tahunAkademikAktif) {
                $dataMahasiswa = DataMahasiswaModel::where('nim', $mahasiswa->nim)
                    ->where('id_tahun_akademik', $tahunAkademikAktif->id)
                    ->first();
            }

            if (!$dataMahasiswa) {
                $dataMahasiswa = DataMahasiswaModel::getAkademikTerbaru($mahasiswa->nim);
            }

            if ($dataMahasiswa) {
                $krsMahasiswa = KrsMahasiswaModel::where('id_data_mahasiswa', $dataMahasiswa->id)
                    ->with([
                        'krsItems.kelas.mataKuliah.programStudi',
                        'krsItems.kelas.dosenKoor',
                        'krsItems.kelas.dosenPendamping',
                    ])
                    ->latest()
                    ->first();

                if ($krsMahasiswa) {
                    $krsItems = $krsMahasiswa->krsItems;
                    $totalSksDiambil = $krsMahasiswa->total_sks;
                    $totalMkDiambil = $krsItems->count();
                    $statusKrs = $krsMahasiswa->status;
                    $tanggalPersetujuan = $krsMahasiswa->updated_at ? Carbon::parse($krsMahasiswa->updated_at)->locale('id')->isoFormat('D MMM Y') : null;
                } else {
                    $totalSksDiambil = $dataMahasiswa->total_sks ?? 0;
                }
            }
        }

        $hariMap = [
            'monday' => 'senin',
            'tuesday' => 'selasa',
            'wednesday' => 'rabu',
            'thursday' => 'kamis',
            'friday' => 'jumat',
            'saturday' => 'sabtu',
            'sunday' => 'minggu',
        ];
        $namaHariIniInggris = strtolower(date('l'));
        $hariIni = $hariMap[$namaHariIniInggris] ?? 'senin';
        $namaHariLabel = ucfirst($hariIni);

        $jadwalHariIni = $krsItems->map(fn($item) => $item->kelas)
            ->filter(fn($kelas) => $kelas && strtolower($kelas->hari) === $hariIni)
            ->sortBy(function ($k) {
                return (int) str_replace(':', '', substr($k->jam_mulai, 0, 5));
            })
            ->values();

        $sksMaks = 24;
        $sksPersen = $sksMaks > 0 ? min(100, round(($totalSksDiambil / $sksMaks) * 100, 1)) : 0;
        $sisaSks = max(0, $sksMaks - $totalSksDiambil);

        return view('dashboard.mahasiswa.dashboard', compact(
            'mahasiswa',
            'inisialMhs',
            'tahunAkademikAktif',
            'dataMahasiswa',
            'krsMahasiswa',
            'krsItems',
            'totalSksDiambil',
            'totalMkDiambil',
            'statusKrs',
            'tanggalPersetujuan',
            'hariIni',
            'namaHariLabel',
            'jadwalHariIni',
            'sksMaks',
            'sksPersen',
            'sisaSks'
        ));
    }
}
