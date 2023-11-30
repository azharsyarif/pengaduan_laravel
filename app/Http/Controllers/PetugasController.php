<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function show()
{
    $petugas = auth()->user(); // Pastikan Anda mengambil petugas yang sedang login

    return view('auth.profile', ['petugas' => $petugas]);
}


        public function showPetugasScreen()
    {
        $petugas = auth()->user(); // Pastikan Anda mengambil petugas yang sedang login

        return view('petugas');
    }


    public function showLoginForm()
    {
    return view('auth.login');
    }
        public function showHome()
    {
        $pengaduans = Pengaduan::all();
        return view('welcome', compact('pengaduans'));
    }

    public function showRegisterForm()
    {
    return view('auth.register');
    }
    public function showTanggapanScreen()
    {
    return view('tanggapanTable');
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
        $email = $request->email;
        $password = $request->password;
    
        $data = Petugas::where('username', $email)->first();
        if ($data) {
            if (Hash::check($password, $data->password)) {
                // Menggunakan session untuk menandai bahwa pengguna telah login
                session(['name' => $data->name]);
                session(['login' => TRUE]);
                return redirect()->route('home');
            } else {
                return redirect('login')->with('alert', 'Password atau Email, Salah !');
            }
        } else {
            return redirect('login')->with('alert', 'Password atau Email, Salah!');
        }
    }



    
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['showLoginForm', 'login', 'showRegisterForm', 'register']);
    // }

    
    public function logout(Request $request)
{
    // Hapus informasi user dari session saat logout
    $request->session()->forget('name');
    $request->session()->forget('login');
    return redirect('/login')->with('success', 'Anda telah berhasil logout.');
}

    
}
