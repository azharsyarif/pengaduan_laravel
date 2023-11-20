<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function showLoginForm()
    {
    return view('auth.login');
    }
    public function showHome()
    {
    return view('welcome');
    }
    public function showRegisterForm()
    {
    return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'nama_petugas' => 'required|string|max:255',
            'username' => 'required|unique:petugas',
            'password' => 'required|min:6',
        ]);

        $petugas = Petugas::create([
            'nama_petugas' => $validatedData['nama_petugas'],
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('login')->with(['success' => 'Account created successfully!']);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('petugas')->attempt($credentials)) {
            return redirect()->route('home');
        }

        return back()->withInput()->withErrors([
            'username' => 'Login gagal. Periksa kembali username dan password Anda.',
        ]);
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
