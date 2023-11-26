<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    public function showTanggapanForm($pengaduan_id)
{
    $pengaduan = Pengaduan::find($pengaduan_id);
    return view('tanggapan', ['pengaduan' => $pengaduan]);
}
    
public function AddTanggapan(Request $request){
    $data = $request->all();
    $date = date('y-m-d');
    $id = $data['pengaduan_id'];

    // Add Tanggapan
    tanggapan::create([
        'pengaduan_id' => $data['pengaduan_id'],
        'tgl_tanggapan' => $date,
        'tanggapan' => $data['tanggapan'],
        'id' => $data['id'],
        // 'role' => $data['role']
    ]);

    // Update Status
    $update_status = pengaduan::find($id);
    if ($update_status) {
        $update_status->status  = 'selesai';
        $update_status->save();
        return redirect('/dashboard')->with('alert', 'Data Berhasil Di Tanggapi dan Status Pengaduan Diperbarui');
    } else {
        return redirect('/dashboard')->with('alert', 'Pengaduan tidak ditemukan!');
    }
}

}