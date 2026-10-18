<?php

namespace App\Http\Controllers\Kelola;

use App\Http\Controllers\Controller;
use App\Models\FakultasModel;
use App\Models\MahasiswaModel;
use App\Models\ProgramStudiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaProdiController extends Controller
{
    public function index()
    {
        $data = [
            'prodi' => ProgramStudiModel::getAllProgramStudi(),
            'fakultas' => FakultasModel::getAllFakultas(),
            'totalMahasiswa' => MahasiswaModel::count(),
            'totalMataKuliah' => DB::table('mata_kuliah')->count(),
        ];

        return view('kelola.prodi.prodi', $data);
    }

    public function store(Request $request)
    {
        if ($request->input('tab') === 'prodi') {
            $data = $request->validate(
                [
                    'kode_prodi' => 'required',
                    'nama_prodi' => 'required',
                    'singkatan' => 'required',
                    'id_fakultas' => 'required',
                ],
                [
                    'kode_prodi.required' => 'Kode Prodi tidak boleh kosong',
                    'nama_prodi.required' => 'Nama Prodi tidak boleh kosong',
                    'singkatan.required' => 'Singkatan tidak boleh kosong',
                    'id_fakultas.required' => 'Fakultas tidak boleh kosong',
                ]
            );

            ProgramStudiModel::createProgramStudi($data);

            return redirect()->route('kelola.prodi')->with('success', 'Data program studi berhasil disimpan');
        } else if ($request->input('tab') === 'fakultas') {
            $data = $request->validate(
                [
                    'kode_fakultas' => 'required',
                    'nama_fakultas' => 'required',
                    'singkatan' => 'required',
                ],
                [
                    'kode_fakultas.required' => 'Kode Fakultas tidak boleh kosong',
                    'nama_fakultas.required' => 'Nama Fakultas tidak boleh kosong',
                    'singkatan.required' => 'Singkatan tidak boleh kosong',
                ]
            );

            FakultasModel::createFakultas($data);

            return redirect()->route('kelola.prodi', ['tab' => 'fakultas'])->with('success', 'Data fakultas berhasil disimpan');
        }

        return redirect()->route('kelola.prodi')->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, string $id)
    {
        $tab = $request->input('tab', 'prodi');

        if ($tab === 'prodi') {
            $data = $request->validate(
                [
                    'kode_prodi' => 'required|max:10',
                    'nama_prodi' => 'required|max:100',
                    'singkatan' => 'nullable|max:50',
                    'id_fakultas' => 'required|exists:fakultas,id',
                ],
                [
                    'kode_prodi.required' => 'Kode Prodi tidak boleh kosong',
                    'nama_prodi.required' => 'Nama Prodi tidak boleh kosong',
                    'id_fakultas.required' => 'Fakultas tidak boleh kosong',
                    'id_fakultas.exists' => 'Fakultas yang dipilih tidak valid',
                ]
            );

            ProgramStudiModel::updateProgramStudi($id, $data);

            return redirect()->route('kelola.prodi')->with('success', 'Data program studi berhasil diperbarui');
        } else if ($tab === 'fakultas') {
            $data = $request->validate(
                [
                    'kode_fakultas' => 'required|max:10',
                    'nama_fakultas' => 'required|max:100',
                    'singkatan' => 'required|max:50',
                ],
                [
                    'kode_fakultas.required' => 'Kode Fakultas tidak boleh kosong',
                    'nama_fakultas.required' => 'Nama Fakultas tidak boleh kosong',
                    'singkatan.required' => 'Singkatan tidak boleh kosong',
                ]
            );

            FakultasModel::updateFakultas($id, $data);

            return redirect()->route('kelola.prodi', ['tab' => 'fakultas'])->with('success', 'Data fakultas berhasil diperbarui');
        }

        return redirect()->route('kelola.prodi');
    }

    public function destroy(Request $request, string $id)
    {
        $tab = $request->input('tab');

        if ($tab === 'fakultas' || FakultasModel::where('id', $id)->exists()) {
            $fakultas = FakultasModel::findOrFail($id);
            if ($fakultas->programStudi()->count() > 0) {
                return redirect()->route('kelola.prodi', ['tab' => 'fakultas'])->with('error', 'Fakultas tidak dapat dihapus karena masih menaungi Program Studi.');
            }
            FakultasModel::deleteFakultas($id);
            return redirect()->route('kelola.prodi', ['tab' => 'fakultas'])->with('success', 'Data fakultas berhasil dihapus');
        }

        $prodi = ProgramStudiModel::findOrFail($id);
        if ($prodi->mahasiswa()->count() > 0) {
            return redirect()->route('kelola.prodi')->with('error', 'Program Studi tidak dapat dihapus karena masih memiliki data mahasiswa terdaftar.');
        }
        ProgramStudiModel::deleteProgramStudi($id);

        return redirect()->route('kelola.prodi')->with('success', 'Data program studi berhasil dihapus');
    }
}
