<?php

namespace App\Http\Controllers;
use PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    // Dari Chat GPT
    // public function generatePDF(Request $request)
    // {
    //     // Assuming 'tanggapan' and 'pengaduan' are arrays passed in the request
    //     $tanggapan = $request->input('tanggapan', []); // If the data is not an array, it defaults to an empty array
    //     $pengaduan = $request->input('pengaduan', []);

    //     $data = [
    //         'title'     => 'GENERATE LAPORAN TANGGAPAN',
    //         'date'      => date('Y-m-d'),
    //         'tanggapan' => $tanggapan,
    //         'pengaduan' => $pengaduan,
    //     ];

    //     // Passing $data to the view
    //     $pdf = PDF::loadView('view-generate-laporan', $data);

    //     return $pdf->download('Generate-Laporan-Tanggapan.pdf');
    // }


    // Punya Raihan
    public static function generatePDF($tanggapan, $pengaduan)
    {
        $data = [
            'title'     => 'GENERATE LAPORAN TANGGAPAN',
            'date'      => date('Y-m-d'),
            'tanggapan' => $tanggapan,
            'pengaduan' => $pengaduan,
        ];

        $pdf = PDF::loadview('view-generate-laporan', $data);

        return $pdf->download('Generate-Laporan-Tanggapan.pdf');
    }


}
