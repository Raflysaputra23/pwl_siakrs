<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataMahasiswaModel;
use App\Models\DosenModel;
use App\Models\KelasModel;
use App\Models\KrsMahasiswaModel;
use App\Models\MahasiswaModel;
use App\Models\TahunAkademikModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'mahasiswa') {
            return $this->indexMahasiswa($user);
        } else if ($user->role === 'dosen') {
            return $this->indexDosen($user);
        }

        return $this->indexAdmin($user);
    }

    private function indexAdmin($user)
    {
        return view('profile.admin.profile', compact('user'));
    }

    private function indexDosen($user)
    {
        $dosen = DosenModel::where('id_user', $user->id)->first();
        $nip = $dosen ? trim($dosen->nip) : null;

        $kelasDiampu = collect();
        if ($nip) {
            $kelasDiampu = KelasModel::with(['mataKuliah.programStudi'])
                ->where(function ($q) use ($nip) {
                    $q->where('dosen_koor', $nip)
                      ->orWhere('dosen_pendamping', $nip);
                })
                ->orderBy('hari', 'asc')
                ->orderBy('jam_mulai', 'asc')
                ->get()
                ->map(function ($kls) use ($nip) {
                    $kls->peran = (trim($kls->dosen_koor) === $nip) ? 'Dosen Koordinator' : 'Dosen Pendamping';
                    return $kls;
                });
        }

        $totalKelas = $kelasDiampu->count();
        $totalSks = $kelasDiampu->sum(fn($k) => $k->mataKuliah->sks ?? 0);
        $totalBimbingan = $nip ? MahasiswaModel::where('dosen_pa_nip', $nip)->count() : 0;
        $krsMenunggu = $nip ? KrsMahasiswaModel::where('dosen_pa_nip', $nip)->where('status', 'menunggu')->count() : 0;

        $stats = [
            'kelas' => $totalKelas,
            'sks' => $totalSks,
            'bimbingan' => $totalBimbingan,
            'krs_menunggu' => $krsMenunggu,
        ];

        return view('profile.dosen.profile', compact('user', 'dosen', 'kelasDiampu', 'stats'));
    }

    private function indexMahasiswa($user)
    {
        $mahasiswa = MahasiswaModel::with(['programStudi.fakultas', 'dosenPa'])
            ->where('id_user', $user->id)
            ->first();

        $tahunAktif = TahunAkademikModel::getAktif() ?? TahunAkademikModel::orderBy('created_at', 'desc')->first();

        $dataMahasiswa = null;
        $statusKrs = 'Belum Diajukan';

        if ($mahasiswa) {
            if ($tahunAktif) {
                $dataMahasiswa = DataMahasiswaModel::where('nim', $mahasiswa->nim)
                    ->where('id_tahun_akademik', $tahunAktif->id)
                    ->first();
            }

            if (!$dataMahasiswa) {
                $dataMahasiswa = DataMahasiswaModel::where('nim', $mahasiswa->nim)
                    ->orderBy('created_at', 'desc')
                    ->first();
            }

            if ($dataMahasiswa) {
                $krs = KrsMahasiswaModel::where('id_data_mahasiswa', $dataMahasiswa->id)
                    ->latest()
                    ->first();
                if ($krs) {
                    $statusKrs = $krs->status;
                }
            }
        }

        return view('profile.mahasiswa.profile', compact('user', 'mahasiswa', 'tahunAktif', 'dataMahasiswa', 'statusKrs'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'mahasiswa') {
            $mahasiswa = MahasiswaModel::where('id_user', $user->id)->first();
            if (!$mahasiswa) {
                return response()->json(['success' => false, 'message' => 'Data mahasiswa tidak ditemukan'], 404);
            }

            if ($request->filled('jenis_kelamin')) {
                $jk = strtolower(trim($request->input('jenis_kelamin')));
                if (in_array($jk, ['l', 'laki-laki', 'laki - laki', 'pria'])) {
                    $request->merge(['jenis_kelamin' => 'laki-laki']);
                } elseif (in_array($jk, ['p', 'perempuan', 'wanita'])) {
                    $request->merge(['jenis_kelamin' => 'perempuan']);
                }
            }

            $validated = $request->validate([
                'nama_lengkap' => 'required|string|max:200',
                'email' => 'nullable|email|max:100',
                'no_telp' => 'nullable|string|max:20',
                'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
                'tempat_lahir' => 'nullable|string|max:100',
                'tgl_lahir' => 'nullable|date',
                'alamat' => 'nullable|string|max:500',
            ]);

            $mahasiswa->update($validated);

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Profil mahasiswa berhasil diperbarui!']);
            }
            return redirect()->back()->with('success', 'Profil mahasiswa berhasil diperbarui!');
        } else if ($user->role === 'dosen') {
            $dosen = DosenModel::where('id_user', $user->id)->first();
            if (!$dosen) {
                return response()->json(['success' => false, 'message' => 'Data dosen tidak ditemukan'], 404);
            }

            $validated = $request->validate([
                'nama_lengkap' => 'required|string|max:200',
                'gelar_depan' => 'nullable|string|max:50',
                'gelar_belakang' => 'nullable|string|max:50',
                'email' => 'nullable|email|max:100',
                'no_telp' => 'nullable|string|max:20',
                'alamat' => 'nullable|string|max:500',
            ]);

            $dosen->update($validated);

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Profil dosen berhasil diperbarui!']);
            }
            return redirect()->back()->with('success', 'Profil dosen berhasil diperbarui!');
        } else {
            $validated = $request->validate([
                'username' => 'nullable|string|min:3|max:50|unique:users,username,' . $user->id,
            ]);

            if (!empty($validated['username'])) {
                $user->update(['username' => $validated['username']]);
            }

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Profil administrator berhasil diperbarui!']);
            }
            return redirect()->back()->with('success', 'Profil administrator berhasil diperbarui!');
        }
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi',
            'new_password.required' => 'Kata sandi baru wajib diisi',
            'new_password.min' => 'Kata sandi baru minimal 6 karakter',
            'confirm_password.required' => 'Konfirmasi kata sandi baru wajib diisi',
            'confirm_password.same' => 'Konfirmasi kata sandi baru tidak cocok dengan kata sandi baru',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (!Hash::check($request->current_password, $user->password)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kata sandi saat ini tidak sesuai / salah',
                ], 422);
            }
            return redirect()->back()->with('error', 'Kata sandi saat ini tidak sesuai');
        }

        $user->update([
            'password' => $request->new_password,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Kata sandi akun berhasil diperbarui!'
            ]);
        }
        return redirect()->back()->with('success', 'Kata sandi akun berhasil diperbarui!');
    }
}
