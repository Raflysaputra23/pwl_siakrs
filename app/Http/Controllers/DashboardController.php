<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('dashboard.admin.dashboard');
        } else if ($user->role === 'dosen') {
            return view('dashboard.dosen.dashboard');
        } else if ($user->role === 'mahasiswa') {
            return view('dashboard.mahasiswa.dashboard');
        }
    }
}
