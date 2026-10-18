<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate(
            [
                'username' => 'required|min:2',
                'password' => 'required|min:4',
            ],
            [
                'username.required' => 'Username wajib diisi',
                'username.min' => 'Username minimal 2 karakter',
                'password.required' => 'Password wajib diisi',
                'password.min' => 'Password minimal 4 karakter',
            ]
        );

        if (
            Auth::attempt([
                'username' => $credentials['username'],
                'password' => $credentials['password'],
            ], $request->boolean('remember'))
        ) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }
}
