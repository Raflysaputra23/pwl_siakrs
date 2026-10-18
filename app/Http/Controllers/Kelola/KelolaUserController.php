<?php

namespace App\Http\Controllers\Kelola;

use App\Http\Controllers\Controller;
use App\Models\DataMahasiswaModel;
use App\Models\DosenModel;
use App\Models\MahasiswaModel;
use App\Models\ProgramStudiModel;
use App\Models\TahunAkademikModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaUserController extends Controller
{
    public function index()
    {
        $users = User::with([
            'mahasiswa.programStudi',
            'mahasiswa.dosenPa',
            'dosen'
        ])->orderBy('created_at', 'desc')->get();

        $programStudiList = ProgramStudiModel::orderBy('nama_prodi', 'asc')->get();
        $dosenList = DosenModel::orderBy('nama_lengkap', 'asc')->get();

        $data = [
            'users' => $users,
            'programStudiList' => $programStudiList,
            'dosenList' => $dosenList,
            'totalUser' => User::count(),
            'totalMahasiswa' => MahasiswaModel::count(),
            'totalDosen' => DosenModel::count(),
            'totalMahasiswaAktif' => MahasiswaModel::where('status', 'aktif')->count(),
        ];

        return view('kelola.user.user', $data);
    }

    public function store(Request $request)
    {
        $role = $request->input('role', 'mahasiswa');

        // Validasi Kredensial Akun User
        $credentials = $request->validate(
            [
                'username' => 'required|min:3|unique:users,username',
                'password' => 'required|min:6',
                'role' => 'required|in:admin,dosen,mahasiswa'
            ],
            [
                'username.required' => 'Username wajib diisi',
                'username.min' => 'Username minimal 3 karakter',
                'username.unique' => 'Username sudah terdaftar',
                'password.required' => 'Password wajib diisi',
                'password.min' => 'Password minimal 6 karakter',
                'role.required' => 'Role wajib diisi',
                'role.in' => 'Role tidak valid'
            ]
        );

        DB::transaction(function () use ($credentials, $request, $role) {
            $user = User::create([
                'username' => $credentials['username'],
                'password' => $credentials['password'],
                'role' => $credentials['role'],
            ]);

            if ($role === 'mahasiswa') {
                $nim = $request->input('npm') ?? $request->input('nim');
                $prodiId = $request->input('id_program_studi') ?? $request->input('prodi');
                $statusMhs = $request->input('status_mhs') ?? $request->input('status') ?? 'aktif';

                $mhsData = $request->validate(
                    [
                        'npm' => 'required|unique:mahasiswa,nim',
                        'nama_lengkap' => 'required|string|max:200',
                        'id_program_studi' => 'required',
                        'angkatan' => 'required',
                        'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                    ],
                    [
                        'npm.required' => 'NPM/NIM wajib diisi',
                        'npm.unique' => 'NPM/NIM sudah terdaftar di sistem',
                        'nama_lengkap.required' => 'Nama Lengkap wajib diisi',
                        'id_program_studi.required' => 'Program Studi wajib dipilih',
                        'angkatan.required' => 'Tahun angkatan wajib diisi',
                        'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
                    ]
                );

                MahasiswaModel::createMahasiswa([
                    'nim' => $nim,
                    'id_user' => $user->id,
                    'id_program_studi' => $prodiId,
                    'dosen_pa_nip' => $request->input('dosen_pa_nip') ?: null,
                    'nama_lengkap' => $mhsData['nama_lengkap'],
                    'tgl_lahir' => $request->input('tgl_lahir') ?: null,
                    'tempat_lahir' => $request->input('tempat_lahir') ?: null,
                    'jenis_kelamin' => $mhsData['jenis_kelamin'],
                    'email' => $request->input('email_mhs') ?: null,
                    'no_telp' => $request->input('no_telp_mhs') ?: null,
                    'alamat' => $request->input('alamat_mhs') ?: null,
                    'angkatan' => $mhsData['angkatan'],
                    'status' => $statusMhs,
                ]);

                $tahunAkademikAktif = TahunAkademikModel::getAktif();
                if (!$tahunAkademikAktif) {
                    $tahunAkademikAktif = TahunAkademikModel::orderBy('created_at', 'desc')->first();
                }

                if ($tahunAkademikAktif) {
                    DataMahasiswaModel::create([
                        'nim' => $nim,
                        'id_tahun_akademik' => $tahunAkademikAktif->id,
                        'semester' => 1,
                        'ipk' => 0.00,
                        'total_sks' => 0,
                    ]);
                }
            } else if ($role === 'dosen') {
                $dsnData = $request->validate(
                    [
                        'nip' => 'required|unique:dosen,nip',
                        'nama_dosen' => 'required|string|max:200',
                    ],
                    [
                        'nip.required' => 'NIP wajib diisi',
                        'nip.unique' => 'NIP sudah terdaftar di sistem',
                        'nama_dosen.required' => 'Nama Dosen wajib diisi',
                    ]
                );

                DosenModel::createDosen([
                    'nip' => $dsnData['nip'],
                    'id_user' => $user->id,
                    'nama_lengkap' => $dsnData['nama_dosen'],
                    'gelar_depan' => $request->input('gelar_depan') ?: '',
                    'gelar_belakang' => $request->input('gelar_belakang') ?: '',
                    'email' => $request->input('email_dosen') ?: null,
                    'no_telp' => $request->input('no_telp_dosen') ?: null,
                    'alamat' => $request->input('alamat_dosen') ?: null,
                ]);
            }
        });

        return redirect()->back()->with('success', 'Pengguna baru berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|min:3|unique:users,username,' . $user->id,
            'password' => 'nullable|min:6',
        ], [
            'username.required' => 'Username wajib diisi',
            'username.min' => 'Username minimal 3 karakter',
            'username.unique' => 'Username sudah digunakan oleh akun lain',
            'password.min' => 'Password baru minimal 6 karakter',
        ]);

        DB::transaction(function () use ($request, $user) {
            $userUpdateData = ['username' => $request->username];
            if ($request->filled('password')) {
                $userUpdateData['password'] = $request->password;
            }
            $user->update($userUpdateData);

            if ($user->role === 'mahasiswa') {
                $mahasiswa = MahasiswaModel::where('id_user', $user->id)->first();
                if ($mahasiswa) {
                    $request->validate([
                        'nama_lengkap' => 'required|string|max:200',
                        'id_program_studi' => 'required',
                        'angkatan' => 'required',
                        'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                    ], [
                        'nama_lengkap.required' => 'Nama lengkap mahasiswa wajib diisi',
                        'id_program_studi.required' => 'Program studi wajib dipilih',
                        'angkatan.required' => 'Tahun angkatan wajib diisi',
                        'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
                    ]);

                    $mahasiswa->update([
                        'nama_lengkap' => $request->nama_lengkap,
                        'id_program_studi' => $request->id_program_studi,
                        'dosen_pa_nip' => $request->filled('dosen_pa_nip') ? trim($request->dosen_pa_nip) : null,
                        'angkatan' => $request->angkatan,
                        'status' => $request->input('status_mhs') ?? $request->input('status') ?? $mahasiswa->status ?? 'aktif',
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'email' => $request->input('email_mhs') ?? $request->input('email') ?: null,
                        'no_telp' => $request->input('no_telp_mhs') ?? $request->input('no_telp') ?: null,
                        'alamat' => $request->input('alamat_mhs') ?? $request->input('alamat') ?: null,
                        'tempat_lahir' => $request->tempat_lahir ?: null,
                        'tgl_lahir' => $request->tgl_lahir ?: null,
                    ]);
                }
            } elseif ($user->role === 'dosen') {
                $dosen = DosenModel::where('id_user', $user->id)->first();
                if ($dosen) {
                    $request->validate([
                        'nama_dosen' => 'required|string|max:200',
                    ], [
                        'nama_dosen.required' => 'Nama dosen wajib diisi',
                    ]);

                    $dosen->update([
                        'nama_lengkap' => $request->nama_dosen,
                        'gelar_depan' => $request->gelar_depan ?: '',
                        'gelar_belakang' => $request->gelar_belakang ?: '',
                        'email' => $request->input('email_dosen') ?? $request->input('email') ?: null,
                        'no_telp' => $request->input('no_telp_dosen') ?? $request->input('no_telp') ?: null,
                        'alamat' => $request->input('alamat_dosen') ?? $request->input('alamat') ?: null,
                    ]);
                }
            }
        });

        return redirect()->back()->with('success', 'Data pengguna berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        DB::transaction(function () use ($id) {
            $user = User::findOrFail($id);

            if ($user->role === 'mahasiswa') {
                $mhs = MahasiswaModel::where('id_user', $user->id)->first();
                if ($mhs) {
                    DataMahasiswaModel::where('nim', $mhs->nim)->delete();
                    $mhs->delete();
                }
            } else if ($user->role === 'dosen') {
                $dosen = DosenModel::where('id_user', $user->id)->first();
                if ($dosen) {
                    MahasiswaModel::where('dosen_pa_nip', $dosen->nip)->update(['dosen_pa_nip' => null]);
                    $dosen->delete();
                }
            }

            $user->delete();
        });

        return redirect()->back()->with('success', 'Pengguna berhasil dihapus');
    }
}
