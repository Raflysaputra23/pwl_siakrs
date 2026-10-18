<?php

namespace App\Http\Controllers\Kelola;

use App\Http\Controllers\Controller;
use App\Models\DosenModel;
use App\Models\KelasModel;
use App\Models\MatakuliahModel;
use App\Models\ProgramStudiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaMatakuliahController extends Controller
{
    public function index()
    {
        $matakuliah = MatakuliahModel::getAllMatakuliah();
        $kelas = KelasModel::getAllKelas();
        $programStudiList = ProgramStudiModel::orderBy('nama_prodi', 'asc')->get();
        $dosenList = DosenModel::orderBy('nama_lengkap', 'asc')->get();

        $data = [
            'matakuliah' => $matakuliah,
            'kelas' => $kelas,
            'programStudiList' => $programStudiList,
            'dosenList' => $dosenList,
            'totalMatakuliah' => MatakuliahModel::count(),
            'totalWajib' => MatakuliahModel::where('jenis', 'wajib')->count(),
            'totalPeminatan' => MatakuliahModel::where('jenis', 'peminatan')->count(),
            'totalKelas' => KelasModel::count(),
        ];

        return view('kelola.matakuliah.matakuliah', $data);
    }

    public function store(Request $request)
    {
        $tab = $request->input('tab', 'matakuliah');

        if ($tab === 'matakuliah') {
            $data = $request->validate([
                'id_program_studi' => 'required|exists:program_studi,id',
                'kode_mk' => 'required|max:10|unique:mata_kuliah,kode_mk',
                'nama_mk' => 'required|max:100',
                'jenis' => 'required|in:wajib,peminatan',
                'semester' => 'required|integer|min:1|max:8',
                'sks' => 'required|integer|min:1|max:6',
            ], [
                'id_program_studi.required' => 'Program studi wajib dipilih',
                'id_program_studi.exists' => 'Program studi yang dipilih tidak valid',
                'kode_mk.required' => 'Kode mata kuliah wajib diisi',
                'kode_mk.unique' => 'Kode mata kuliah sudah digunakan',
                'nama_mk.required' => 'Nama mata kuliah wajib diisi',
                'jenis.required' => 'Jenis mata kuliah wajib dipilih',
                'semester.required' => 'Semester wajib dipilih',
                'sks.required' => 'Bobot SKS wajib diisi',
            ]);

            MatakuliahModel::createMatakuliah($data);

            return redirect()->route('kelola.matakuliah')->with('success', 'Mata kuliah berhasil ditambahkan');
        } else if ($tab === 'kelas') {
            $data = $request->validate([
                'id_mata_kuliah' => 'required|exists:mata_kuliah,id',
                'nama_kelas' => 'required|max:50',
                'kapasitas' => 'required|integer|min:1|max:200',
                'dosen_koor' => 'required|exists:dosen,nip',
                'dosen_pendamping' => 'nullable|exists:dosen,nip',
                'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
                'jam_mulai' => 'required',
                'jam_selesai' => 'required',
                'ruangan' => 'required|max:100',
            ], [
                'id_mata_kuliah.required' => 'Mata kuliah wajib dipilih',
                'id_mata_kuliah.exists' => 'Mata kuliah tidak valid',
                'nama_kelas.required' => 'Nama kelas wajib diisi',
                'kapasitas.required' => 'Kapasitas kelas wajib diisi',
                'dosen_koor.required' => 'Dosen koordinator wajib dipilih',
                'dosen_koor.exists' => 'Dosen koordinator tidak valid',
                'hari.required' => 'Hari perkuliahan wajib dipilih',
                'jam_mulai.required' => 'Jam mulai perkuliahan wajib diisi',
                'jam_selesai.required' => 'Jam selesai perkuliahan wajib diisi',
                'ruangan.required' => 'Ruangan perkuliahan wajib diisi',
            ]);

            if (empty($data['dosen_pendamping'])) {
                $data['dosen_pendamping'] = null;
            }

            KelasModel::createKelas($data);

            return redirect()->route('kelola.matakuliah', ['tab' => 'kelas'])->with('success', 'Kelas perkuliahan baru berhasil dibuka');
        }

        return redirect()->route('kelola.matakuliah');
    }

    public function update(Request $request, string $id)
    {
        $tab = $request->input('tab', 'matakuliah');

        if ($tab === 'matakuliah') {
            $data = $request->validate([
                'id_program_studi' => 'required|exists:program_studi,id',
                'kode_mk' => 'required|max:10|unique:mata_kuliah,kode_mk,' . $id,
                'nama_mk' => 'required|max:100',
                'jenis' => 'required|in:wajib,peminatan',
                'semester' => 'required|integer|min:1|max:8',
                'sks' => 'required|integer|min:1|max:6',
            ]);

            MatakuliahModel::updateMatakuliah($id, $data);

            return redirect()->route('kelola.matakuliah')->with('success', 'Data mata kuliah berhasil diperbarui');
        } else if ($tab === 'kelas') {
            $data = $request->validate([
                'id_mata_kuliah' => 'required|exists:mata_kuliah,id',
                'nama_kelas' => 'required|max:50',
                'kapasitas' => 'required|integer|min:1|max:200',
                'dosen_koor' => 'required|exists:dosen,nip',
                'dosen_pendamping' => 'nullable|exists:dosen,nip',
                'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
                'jam_mulai' => 'required',
                'jam_selesai' => 'required',
                'ruangan' => 'required|max:100',
            ]);

            if (empty($data['dosen_pendamping'])) {
                $data['dosen_pendamping'] = null;
            }

            KelasModel::updateKelas($id, $data);

            return redirect()->route('kelola.matakuliah', ['tab' => 'kelas'])->with('success', 'Data kelas perkuliahan berhasil diperbarui');
        }

        return redirect()->route('kelola.matakuliah');
    }

    public function destroy(Request $request, string $id)
    {
        $type = $request->input('type');

        if ($type === 'kelas' || KelasModel::where('id', $id)->exists()) {
            KelasModel::deleteKelas($id);
            return redirect()->back()->with('success', 'Kelas perkuliahan berhasil dihapus');
        }

        DB::transaction(function () use ($id) {
            KelasModel::where('id_mata_kuliah', $id)->delete();
            MatakuliahModel::deleteMatakuliah($id);
        });

        return redirect()->back()->with('success', 'Mata kuliah beserta kelas terkait berhasil dihapus');
    }
}
