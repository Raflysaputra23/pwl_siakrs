<?php

namespace App\Http\Controllers\Kelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelolaMatakuliahController extends Controller
{
    public function index() {
        return view('kelola.matakuliah.matakuliah');
    }
}
