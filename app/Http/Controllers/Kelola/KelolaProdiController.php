<?php

namespace App\Http\Controllers\Kelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelolaProdiController extends Controller
{
    public function index() {
        return view('kelola.prodi.prodi');
    }
}
