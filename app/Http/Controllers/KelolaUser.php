<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelolaUser extends Controller
{
    public function index() {
        return view('kelola.user.user');
    }
}
