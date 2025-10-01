<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class AuthController extends Controller
{
    // A. MENAMPILKAN FORM LOGIN
    public function showLoginForm()
    {
        // PENTING: Pastikan file ada di resources/views/auth/login.blade.php
        return view('auth.login'); 
    }

    // B. PROSES LOGIN
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Redirect ke halaman home setelah login sukses
            return redirect()->intended(route('home')); 
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah.',
        ])->onlyInput('email');
    }

    // C. MENAMPILKAN FORM REGISTER
    public function showRegistrationForm()
    {
        // PENTING: Pastikan file ada di resources/views/auth/register.blade.php
        return view('auth.register');
    }

    // D. PROSES REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user); 

        return redirect(route('home'));
    }

    // E. LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}