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
//     public function viewComplaints($masyarakatId)
// {
//     $complaints = Pengaduan::where('masyarakat_id', $masyarakatId)->get();
//     return response()->json($complaints);
// }


public function SelectByNik($nik)
    {
        // Ambil semua data pengaduan berdasarkan NIK dari database
        $pengaduanCollection = Pengaduan::where('masyarakat_id', $nik)->get();
    
        // Check if there is data
        if (!$pengaduanCollection->isEmpty()) {
            $response = [];
    
            foreach ($pengaduanCollection as $pengaduan) {
                $pngdn[] = [
                    'id' => mb_convert_encoding($pengaduan->id, 'UTF-8'),
                    'tgl_pengaduan' => mb_convert_encoding($pengaduan->tgl_pengaduan, 'UTF-8'),
                    // 'nik'           => mb_convert_encoding($pengaduan->nik, 'UTF-8'),
                    'isi_laporan'   => mb_convert_encoding($pengaduan->isi_laporan, 'UTF-8'),
                    // 'foto'          => mb_convert_encoding($pengaduan->foto, 'UTF-8'),
                    'kategori'      => mb_convert_encoding($pengaduan->kategori, 'UTF-8'),
                    'status'        => mb_convert_encoding($pengaduan->status, 'UTF-8'),
                ];
                $response = [
                    'status' => 200,
                    'pengaduan' => $pngdn,
                    'message' => 'Pengaduan berhasil di temukan'
                ];

            }
    
            return response()->json($response, 200);
        } else {
            // Jika data pengaduan tidak ditemukan, berikan respons atau tampilan yang sesuai
            return response()->json(['message' => 'Data pengaduan tidak ditemukan'], 404);
        }
}


// public function filterPengaduan(Request $request)
// {
//     // Ambil start_date dan end_date dari permintaan GET
//     $start_date = $request->query('start_date');
//     $end_date = $request->query('end_date');

//     // Lakukan filter pada data pengaduan menggunakan rentang tanggal
//     $filteredPengaduans = Pengaduan::whereBetween('tgl_pengaduan', [$start_date, $end_date])->get();

//     // ... Lanjutkan dengan pengiriman data pengaduan yang sudah difilter ke tampilan

//     return view('filterPengaduan', ['pengaduans' => $filteredPengaduans]);
// }
public function index()
{
    $pengaduans = Pengaduan::orderBy('tgl_pengaduan', 'DESC')->get(); // Mengambil pengaduan terbaru

    return view('dashboard', compact('pengaduans'));
}

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'isi_laporan' => 'required|string',
            'kategori' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $pengaduan = Pengaduan::create([
            'masyarakat_id' => $request->masyarakat_id,
            'isi_laporan' => $request->isi_laporan,
            'foto' => $request->foto,
            'tgl_pengaduan' => now(),
            'kategori' => $request->kategori,
        ]);

        if ($pengaduan) {
            return response()->json(['message' => 'Pengaduan berhasil dibuat', 'order' => $pengaduan], 201);
        } else {
            return response()->json(['error' => 'Terjadi kesalahan saat membuat pengaduan.'], 500);
        }
    }


//     public function create(Request $request)
// {
//     $validator = Validator::make($request->all(), [
//         'isi_laporan' => 'required|string',
//         'kategori' => 'required|string',
//         'foto' => 'required|image' // Pastikan foto valid
//     ]);

//     if ($validator->fails()) {
//         return response()->json(['error' => $validator->errors()], 422);
//     }

//     // Mendapatkan file foto dari request
//     $image = $request->file('foto');
    
//     // Membuat instance dari kelas SplFileInfo untuk mendapatkan konten file
//     $file = new \SplFileInfo($image);
//     $content = file_get_contents($file->getRealPath());

//     $pengaduan = Pengaduan::create([
//         'masyarakat_id' => $request->masyarakat_id,
//         'isi_laporan' => $request->isi_laporan,
//         'foto' => $content, // Menyimpan konten file ke dalam kolom foto sebagai MEDIUMBLOB
//         'tgl_pengaduan' => now(),
//         'kategori' => $request->kategori,
//     ]);

//     if ($pengaduan) {
//         return response()->json(['message' => 'Pengaduan berhasil dibuat', 'order' => $pengaduan], 201);
//     } else {
//         return response()->json(['error' => 'Terjadi kesalahan saat membuat pengaduan.'], 500);
//     }
// }

    
    

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
