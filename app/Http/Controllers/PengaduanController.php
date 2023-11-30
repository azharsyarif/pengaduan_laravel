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
        $validator = Validator::make($request->all(), [
            'isi_laporan' => 'required|string',
            'foto' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        $pengaduan = Pengaduan::create([
            'isi_laporan' => $request->isi_laporan,
            'foto' => $request->foto,
            'tgl_pengaduan' => now(), // Menggunakan helper function now() untuk waktu saat ini
        ]);
    
        if ($pengaduan) {
            return response()->json(['message' => 'Pengaduan berhasil dibuat', 'order' => $pengaduan], 201);
        } else {
            return response()->json(['error' => 'Terjadi kesalahan saat membuat pengaduan.'], 500);
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
