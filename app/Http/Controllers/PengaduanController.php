<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Pengaduan;
use Carbon\Carbon;
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

    // Buat entitas Pengaduan dengan mengambil nik dan tgl_pengaduan saat ini
    $pengaduan = Pengaduan::create([
        'masyarakat_id' => $request->masyarakat_id,
        'isi_laporan' => $request->isi_laporan,
        'foto' => $request->foto,
        'nik' => $nik,
        'tgl_pengaduan' => Carbon::now(), // Menyimpan tanggal dan waktu saat ini
    ]);

    if ($pengaduan) {
        return response()->json(['order' => $pengaduan], 201);
    } else {
        // Jika gagal menyimpan data pesanan, kirim respons server error
        return response()->json(['error' => 'Terjadi kesalahan saat membuat pesanan.'], 500);
    }
}


public function UpdateKonfirmasi(Request $request, $id){
    $update_status = Pengaduan::find($id);
    if ($update_status) {
        $update_status->status  = 'proses';
        $update_status->save();
        return redirect('/dashboard')->with('alert', 'Pengaduan berhasil diterima dan masuk dalam daftar tunggu!');
    } else {
        return redirect('/dashboard')->with('alert', 'Pengaduan tidak ditemukan!');
    }
}
}
