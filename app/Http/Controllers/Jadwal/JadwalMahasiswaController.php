<?php

namespace App\Http\Controllers\Jadwal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JadwalMahasiswaController extends Controller
{
    public function index() {
        return view('jadwal.mahasiswa.jadwal');
    }
}
