<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function formLogin()
    {
        return view('layouts.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required']
            ]
        );

        //attemp = percobaan login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'Email atau password salah!'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Melakukan logout user

        $request->session()->invalidate(); // Menginvalidasi session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/'); // Redirect ke halaman home setelah logout
    }
}
