<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataMahasiswaModel;
use App\Models\DosenModel;
use App\Models\KelasModel;
use App\Models\KrsMahasiswaModel;
use App\Models\KrsModel;
use App\Models\MahasiswaModel;
use App\Models\TahunAkademikModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KrsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user && $user->role === 'mahasiswa') {
            return $this->indexMahasiswa($user);
        }

        return $this->indexDosen($user);
    }

    private function indexMahasiswa($user)
    {
        $mahasiswa = MahasiswaModel::with(['programStudi', 'dosenPa'])
            ->where('id_user', $user->id)
            ->first();

        $tahunAkademikAktif = TahunAkademikModel::getAktif() ?? TahunAkademikModel::orderBy('created_at', 'desc')->first();

        $dataMahasiswa = null;
        if ($mahasiswa && $tahunAkademikAktif) {
            $dataMahasiswa = DataMahasiswaModel::firstOrCreate(
                [
                    'nim' => $mahasiswa->nim,
                    'id_tahun_akademik' => $tahunAkademikAktif->id,
                ],
                [
                    'semester' => 1,
                    'ipk' => 0.00,
                    'total_sks' => 0,
                ]
            );
        }

        $krsMahasiswa = null;
        $krsSelectedKelasIds = [];
        if ($dataMahasiswa) {
            $krsMahasiswa = KrsMahasiswaModel::where('id_data_mahasiswa', $dataMahasiswa->id)
                ->with('krsItems.kelas.mataKuliah')
                ->latest()
                ->first();

            if ($krsMahasiswa) {
                $krsSelectedKelasIds = $krsMahasiswa->krsItems->pluck('id_kelas')->toArray();
            }
        }

        $kelasTersedia = KelasModel::with(['mataKuliah.programStudi', 'dosenKoor'])
            ->orderBy('hari', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->get()
            ->map(function ($kelas) {
                $kelas->terisi = KrsModel::where('id_kelas', $kelas->id)
                    ->whereHas('krsMahasiswa', function ($q) {
                        $q->whereIn('status', ['menunggu', 'disetujui']);
                    })->count();
                return $kelas;
            });

        $statusKrs = $krsMahasiswa ? $krsMahasiswa->status : 'Belum Diajukan';
        $semesterAktif = 'Semester ' . ($dataMahasiswa ? $dataMahasiswa->semester : '1');
        $sksMaks = 24;

        $data = [
            'mahasiswa' => $mahasiswa,
            'tahunAkademikAktif' => $tahunAkademikAktif,
            'dataMahasiswa' => $dataMahasiswa,
            'krsMahasiswa' => $krsMahasiswa,
            'krsSelectedKelasIds' => $krsSelectedKelasIds,
            'mataKuliahList' => $kelasTersedia,
            'statusKrs' => $statusKrs,
            'semesterAktif' => $semesterAktif,
            'sksMaks' => $sksMaks,
        ];

        return view('krs.mahasiswa.krs', $data);
    }

    private function indexDosen($user)
    {
        $dosen = DosenModel::where('id_user', $user->id)->first();
        $tahunAkademikAktif = TahunAkademikModel::getAktif() ?? TahunAkademikModel::orderBy('created_at', 'desc')->first();

        $query = KrsMahasiswaModel::with([
            'dataMahasiswa.mahasiswa.programStudi',
            'dataMahasiswa.tahunAkademik',
            'krsItems.kelas.mataKuliah',
            'dosenPa',
        ]);

        if ($dosen) {
            $query->where('dosen_pa_nip', trim($dosen->nip));
        } else {
            $query->whereRaw('1 = 0');
        }

        if ($tahunAkademikAktif) {
            $query->whereHas('dataMahasiswa', function ($q) use ($tahunAkademikAktif) {
                $q->where('id_tahun_akademik', $tahunAkademikAktif->id);
            });
        }

        $pengajuanList = $query->latest()->get();

        $stats = [
            'total' => $pengajuanList->count(),
            'menunggu' => $pengajuanList->where('status', 'menunggu')->count(),
            'disetujui' => $pengajuanList->where('status', 'disetujui')->count(),
            'ditolak' => $pengajuanList->where('status', 'ditolak')->count(),
        ];

        $data = [
            'dosen' => $dosen,
            'tahunAkademikAktif' => $tahunAkademikAktif,
            'pengajuanList' => $pengajuanList,
            'stats' => $stats,
        ];

        return view('krs.dosen.krs', $data);
    }

    public function ajukan(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = MahasiswaModel::where('id_user', $user->id)->first();

        if (!$mahasiswa) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Data mahasiswa tidak ditemukan'], 404);
            }
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan');
        }

        if (empty($mahasiswa->dosen_pa_nip)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda belum memiliki Dosen Pembimbing Akademik (PA). Silakan hubungi bagian akademik atau prodi untuk penetapan Dosen PA terlebih dahulu.'
                ], 422);
            }
            return redirect()->back()->with('error', 'Anda belum memiliki Dosen Pembimbing Akademik (PA).');
        }

        $kelasIds = $request->input('kelas_ids', []);
        if (empty($kelasIds)) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Pilih minimal satu mata kuliah'], 422);
            }
            return redirect()->back()->with('error', 'Pilih minimal satu mata kuliah');
        }

        $tahunAkademikAktif = TahunAkademikModel::getAktif() ?? TahunAkademikModel::orderBy('created_at', 'desc')->first();

        if (!$tahunAkademikAktif) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Tahun akademik aktif tidak ditemukan'], 404);
            }
            return redirect()->back()->with('error', 'Tahun akademik aktif tidak ditemukan');
        }

        DB::transaction(function () use ($mahasiswa, $tahunAkademikAktif, $kelasIds) {
            $dataMahasiswa = DataMahasiswaModel::firstOrCreate(
                [
                    'nim' => $mahasiswa->nim,
                    'id_tahun_akademik' => $tahunAkademikAktif->id,
                ],
                [
                    'semester' => 1,
                    'ipk' => 0.00,
                    'total_sks' => 0,
                ]
            );

            $dosenPaNip = trim($mahasiswa->dosen_pa_nip);

            $krsMahasiswa = KrsMahasiswaModel::where('id_data_mahasiswa', $dataMahasiswa->id)->first();
            if ($krsMahasiswa && $krsMahasiswa->status === 'disetujui') {
                throw new \Exception('KRS telah disetujui oleh Dosen PA dan terkunci. Tidak dapat diubah.');
            }

            $krsMahasiswa = KrsMahasiswaModel::updateOrCreate(
                [
                    'id_data_mahasiswa' => $dataMahasiswa->id,
                ],
                [
                    'dosen_pa_nip' => $dosenPaNip,
                    'status' => 'menunggu',
                ]
            );

            KrsModel::where('id_krs_mahasiswa', $krsMahasiswa->id)->delete();

            $totalSks = 0;
            foreach ($kelasIds as $kelasId) {
                $kelas = KelasModel::with('mataKuliah')->find($kelasId);
                if ($kelas) {
                    KrsModel::create([
                        'id_krs_mahasiswa' => $krsMahasiswa->id,
                        'id_kelas' => $kelas->id,
                    ]);
                    $totalSks += $kelas->mataKuliah ? $kelas->mataKuliah->sks : 0;
                }
            }

            $dataMahasiswa->update(['total_sks' => $totalSks]);
        });

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'KRS berhasil diajukan! Menunggu persetujuan Dosen PA.']);
        }

        return redirect()->back()->with('success', 'KRS berhasil diajukan! Menunggu persetujuan Dosen PA.');
    }

    public function batal(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = MahasiswaModel::where('id_user', $user->id)->first();

        if (!$mahasiswa) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Data mahasiswa tidak ditemukan'], 404);
            }
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan');
        }

        $tahunAkademikAktif = TahunAkademikModel::getAktif() ?? TahunAkademikModel::orderBy('created_at', 'desc')->first();

        if (!$tahunAkademikAktif) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Tahun akademik aktif tidak ditemukan'], 404);
            }
            return redirect()->back()->with('error', 'Tahun akademik aktif tidak ditemukan');
        }

        $dataMahasiswa = DataMahasiswaModel::where('nim', $mahasiswa->nim)
            ->where('id_tahun_akademik', $tahunAkademikAktif->id)
            ->first();

        if (!$dataMahasiswa) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Data akademik mahasiswa tidak ditemukan'], 404);
            }
            return redirect()->back()->with('error', 'Data akademik mahasiswa tidak ditemukan');
        }

        $krsMahasiswa = KrsMahasiswaModel::where('id_data_mahasiswa', $dataMahasiswa->id)->first();

        if (!$krsMahasiswa) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Belum ada pengajuan KRS untuk dibatalkan'], 404);
            }
            return redirect()->back()->with('error', 'Belum ada pengajuan KRS untuk dibatalkan');
        }

        if ($krsMahasiswa->status === 'disetujui') {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'KRS telah disetujui Dosen PA dan terkunci. Tidak dapat dibatalkan.'], 403);
            }
            return redirect()->back()->with('error', 'KRS telah disetujui Dosen PA dan terkunci. Tidak dapat dibatalkan.');
        }

        DB::transaction(function () use ($krsMahasiswa, $dataMahasiswa) {
            KrsModel::where('id_krs_mahasiswa', $krsMahasiswa->id)->delete();
            $krsMahasiswa->delete();
            $dataMahasiswa->update(['total_sks' => 0]);
        });

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Pengajuan KRS berhasil dibatalkan']);
        }

        return redirect()->back()->with('success', 'Pengajuan KRS berhasil dibatalkan');
    }

    public function setujui(Request $request, string $id)
    {
        $krs = KrsMahasiswaModel::findOrFail($id);

        $user = Auth::user();
        if ($user && $user->role === 'dosen') {
            $dosen = DosenModel::where('id_user', $user->id)->first();
            if (!$dosen || trim($krs->dosen_pa_nip) !== trim($dosen->nip)) {
                if ($request->expectsJson()) {
                    return response()->json(['success' => false, 'message' => 'Akses ditolak. Anda bukan Dosen PA dari mahasiswa ini.'], 403);
                }
                return redirect()->back()->with('error', 'Akses ditolak. Anda bukan Dosen PA dari mahasiswa ini.');
            }
        }

        $krs->update(['status' => 'disetujui']);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'KRS berhasil disetujui']);
        }

        return redirect()->back()->with('success', 'KRS berhasil disetujui');
    }

    public function tolak(Request $request, string $id)
    {
        $krs = KrsMahasiswaModel::findOrFail($id);

        $user = Auth::user();
        if ($user && $user->role === 'dosen') {
            $dosen = DosenModel::where('id_user', $user->id)->first();
            if (!$dosen || trim($krs->dosen_pa_nip) !== trim($dosen->nip)) {
                if ($request->expectsJson()) {
                    return response()->json(['success' => false, 'message' => 'Akses ditolak. Anda bukan Dosen PA dari mahasiswa ini.'], 403);
                }
                return redirect()->back()->with('error', 'Akses ditolak. Anda bukan Dosen PA dari mahasiswa ini.');
            }
        }

        $krs->update(['status' => 'ditolak']);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'KRS berhasil ditolak / diminta revisi']);
        }

        return redirect()->back()->with('success', 'KRS berhasil ditolak / diminta revisi');
    }

    public function detail(string $id)
    {
        $krs = KrsMahasiswaModel::with([
            'dataMahasiswa.mahasiswa.programStudi',
            'krsItems.kelas.mataKuliah',
            'dosenPa'
        ])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $krs,
        ]);
    }
}