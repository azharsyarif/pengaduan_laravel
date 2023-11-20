<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
        public function index()
    {
        $pengaduans = Pengaduan::all(); // Misalkan kamu mengambil data dari model Pengaduan

        return view('welcome', compact('pengaduans'));
    }

    public function create(Request $request)
{
    // Validasi data dari permintaan
    $validator = Validator::make($request->all(), [
        'masyarakat_id' => 'required|string',
        'isi_laporan' => 'string',
        // 'tgl_pengaduan' => 'date', // Mengubah format nama atribut menjadi menggunakan underscore (_)
        'foto' => 'string',
    ]);

    if ($validator->fails()) {
        // Jika validasi gagal, kirim respons dengan pesan kesalahan
        return response()->json(['error' => $validator->errors()], 422);
    }

    // Periksa apakah masyarakat dengan ID yang diberikan ada dalam database
    $masyarakat = Masyarakat::find($request->masyarakat_id);

    if (!$masyarakat) {
        return response()->json(['error' => 'ID masyarakat tidak valid'], 422);
    }

    // Dapatkan nik dari masyarakat_id
    $nik = $masyarakat->nik;

    // Buat entitas Pengaduan hanya dengan mengambil nik
    $pengaduan = Pengaduan::create([
        'masyarakat_id' => $request->masyarakat_id,
        'isi_laporan' => $request->isi_laporan,
        'foto' => $request->foto,
        'nik' => $nik,
    ]);

    if ($pengaduan) {
        return response()->json(['order' => $pengaduan], 201);
    } else {
        // Jika gagal menyimpan data pesanan, kirim respons server error
        return response()->json(['error' => 'Terjadi kesalahan saat membuat pesanan.'], 500);
    }
}
}
