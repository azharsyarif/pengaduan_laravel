<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

// API
    public function index()
    {
        $petugas = User::all(); 
        return response()->json(['petugas' => $petugas], 201);
    } 

    // public function create(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string',
    //         'email' => 'required|string',
    //         'password' => 'required|string',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 422);
    //     }
    
    //     $pengaduan = User::create([
    //         'name' => $request->name, 
    //         'name' => $request->email, 
    //         'password' => Hash::make($request->password),
    //         'no_telp' => $request->email,
    //         'no_telp' => $request->email,
            
    //         // Menggunakan helper function now() untuk waktu saat ini
    //     ]);
    
    //     if ($pengaduan) {
    //         return response()->json(['message' => 'Pengaduan berhasil dibuat', 'order' => $pengaduan], 201);
    //     } else {
    //         return response()->json(['error' => 'Terjadi kesalahan saat membuat pengaduan.'], 500);
    //     }
    // }



    public function create(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'email' => 'required|string|max:255',
        'password' => 'required|min:6',
        // Tambahkan validasi lain jika diperlukan
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    try {
        $petugas = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_telp' => $request->no_telp,
            'role' => $request->role,
            // Isi kolom lain jika diperlukan
        ]);

        return response()->json(['success' => 'Account created successfully!', 'data' => $petugas], 201);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to create account.'], 500);
    }
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
