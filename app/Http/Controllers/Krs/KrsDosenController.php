<?php

namespace App\Http\Controllers\Krs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KrsDosenController extends Controller
{
    public function index() {
        return view('krs.dosen.krs');
    }
}
