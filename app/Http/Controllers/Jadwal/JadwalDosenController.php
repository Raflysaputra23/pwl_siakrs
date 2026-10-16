<?php

namespace App\Http\Controllers\Jadwal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JadwalDosenController extends Controller
{
    public function index() {
        return view('jadwal.dosen.jadwal');
    }
}
