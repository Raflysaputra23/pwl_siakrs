<?php

namespace App\Http\Controllers\Kelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelolaUserController extends Controller
{
    public function index() {
        return view('kelola.user.user');
    }
}
