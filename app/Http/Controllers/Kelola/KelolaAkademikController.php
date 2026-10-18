<?php

namespace App\Http\Controllers\Kelola;

use App\Http\Controllers\Controller;
use App\Models\AkademikModel;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class KelolaAkademikController extends Controller
{
    public function index()
    {
        $tahunAkademik = AkademikModel::getAllTahunAkademik();
        $tahunAkademikAktif = AkademikModel::getAktif();
        $totalMahasiswa = MahasiswaModel::count();
        $totalKrs = DB::table('krs')->count();

        $data = [
            'tahunAkademik' => $tahunAkademik,
            'tahunAkademikAktif' => $tahunAkademikAktif,
            'totalMahasiswa' => $totalMahasiswa,
            'totalKrs' => $totalKrs,
        ];

        return view('kelola.akademik.akademik', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tahun' => [
                'required',
                'max:10',
                Rule::unique('tahun_akademik')->where(function ($query) use ($request) {
                    return $query->where('tahun', $request->tahun)
                        ->where('semester', $request->semester);
                }),
            ],
            'semester' => 'required|in:ganjil,genap',
            'status' => 'required|in:aktif,non-aktif',
        ], [
            'tahun.required' => 'Tahun akademik wajib diisi',
            'tahun.unique' => 'Tahun akademik dan semester ini sudah ada di dalam sistem',
            'semester.required' => 'Semester wajib dipilih',
            'status.required' => 'Status tahun akademik wajib dipilih',
        ]);

        AkademikModel::createTahunAkademik($data);

        return redirect()->route('kelola.akademik')->with('success', 'Tahun akademik baru berhasil ditambahkan');
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'tahun' => [
                'required',
                'max:10',
                Rule::unique('tahun_akademik')->ignore($id)->where(function ($query) use ($request) {
                    return $query->where('tahun', $request->tahun)
                        ->where('semester', $request->semester);
                }),
            ],
            'semester' => 'required|in:ganjil,genap',
            'status' => 'required|in:aktif,non-aktif',
        ], [
            'tahun.required' => 'Tahun akademik wajib diisi',
            'tahun.unique' => 'Tahun akademik dan semester ini sudah ada di dalam sistem',
            'semester.required' => 'Semester wajib dipilih',
            'status.required' => 'Status tahun akademik wajib dipilih',
        ]);

        AkademikModel::updateTahunAkademik($id, $data);

        return redirect()->route('kelola.akademik')->with('success', 'Data tahun akademik berhasil diperbarui');
    }

    public function setAktif(string $id)
    {
        AkademikModel::setAktif($id);

        return redirect()->route('kelola.akademik')->with('success', 'Tahun akademik aktif berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $akademik = AkademikModel::findOrFail($id);

        if ($akademik->status === 'aktif') {
            return redirect()->back()->with('error', 'Tahun akademik yang sedang aktif tidak dapat dihapus. Silakan aktifkan tahun akademik lain terlebih dahulu.');
        }

        AkademikModel::deleteTahunAkademik($id);

        return redirect()->back()->with('success', 'Tahun akademik berhasil dihapus');
    }
}
