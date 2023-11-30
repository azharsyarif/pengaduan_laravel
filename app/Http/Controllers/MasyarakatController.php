<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MasyarakatController extends Controller
{

    public function index()
    {
        $masyarakat = Masyarakat::all(); 
        return response()->json(['masyarakat' => $masyarakat], 200);
    }   
    
    public function getByNik($nik)
    {
        // Cari masyarakat berdasarkan nik
        $masyarakat = Masyarakat::where('nik', $nik)->first();
    
        if ($masyarakat) {
            return response()->json(['masyarakat' => $masyarakat], 200);
        } else {
            return response()->json(['error' => 'Masyarakat tidak ditemukan'], 404);
        }
    }
    
    public function getUserProfile($id)
    {
        $user = Masyarakat::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json([
            'id' => $user->id,
            'nik' => $user->nik,
            'nama' => $user->nama,
            'username' => $user->username,
            'telp' => $user->telp,
            // Tambahkan atribut lain yang diperlukan
        ]);
    }
    public function register(Request $req)
    {
        // Validate
        $rules = [
            'nik' => 'required|integer|unique:masyarakats',
            'nama' => 'required|string',
            'username' => 'required|string|unique:masyarakats',
            'password' => 'required|string|min:6',
            'telp' => 'required|string'
        ];
    
        $validator = Validator::make($req->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        // Create new user in 'masyarakats' table
        $user = Masyarakat::create([
            'nik' => $req->nik,
            'nama' => $req->nama,
            'username' => $req->username,
            'password' => Hash::make($req->password),
            'telp' => $req->telp
        ]);
    
        $token = $user->createToken('personal Access Token')->plainTextToken;// Assuming you've implemented the token generation as mentioned earlier
    
        $response = ['user' => $user, 'token' => $token, 'message' => 'Register Berhasil'];
    
        return response()->json($response, 200);
    }
    
    public function login(Request $request)
{
    $user = Masyarakat::where('username', $request->username)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        $token = $user->createToken('personal-access-token')->plainTextToken;

        // Tambahkan kode untuk menyimpan nilai 'nik' ke entitas Masyarakat
        // Gunakan nilai 'nik' dari pengguna saat ini
        $masyarakat = Masyarakat::find($user->id);
        $masyarakat->nik = $user->nik;
        $masyarakat->save();

        $response = [
            'status' => 200,
            'token' => $token,
            'user' => $user,
            'userId' => $user->id, // Menambahkan 'userId' ke dalam respons
            'message' => 'Login berhasil'
        ];
        return response()->json($response, 200);
    } else if (!$user) {
        $response = ['status' => 404, 'message' => 'Akun tidak ditemukan dengan username ini'];
        return response()->json($response, 404);
    } else {
        $response = ['status' => 401, 'message' => 'Username atau password Anda salah! Silahkan coba lagi'];
        return response()->json($response, 401);
    }
}

    
    public function logout()
    {
        $user = Auth::user();

        if ($user) {
            $user->currentAccessToken()->delete(); // Menghapus token akses yang sedang digunakan oleh pengguna
            return response()->json(['message' => 'Logout berhasil'], 200);
        } else {
            return response()->json(['error' => 'Pengguna tidak terotentikasi.'], 401);
        }
    }

    public function update(Request $request, $id)
    {
    // Validasi data dari formulir
    $request->validate([
        'nik' => 'integer|unique:masyarakats,nik,' . $id,
        'nama' => 'string',
        'username' => 'string|unique:masyarakats,username,' . $id,
        'password' => 'string|min:6',
        'telp' => 'string'
    ]);

    $masyarakat = Masyarakat::find($id);

    if (!$masyarakat) {
        return response()->json(['error' => 'Data tidak ditemukan.'], 404);
    }

    $masyarakat->update($request->all());

    return response()->json(['success' => 'Data berhasil diperbarui.'], 200);
    }



}