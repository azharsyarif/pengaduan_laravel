<?php

use App\Http\Controllers\PDFController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TanggapanController;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $pengaduans = Pengaduan::all();
    return view('dashboard', compact('pengaduans'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::post('/update-konformasi/{id}', [PengaduanController::class, 'UpdateKonfirmasi'])->name('update.konfirmasi');

// Tanggapan
// Route::post('/tanggapan/create/{id_pengaduan}', [TanggapanController::class, 'create'])->name('tanggapan.create');
// Route::patch('/update-status-selesai/{id_pengaduan}', [TanggapanController::class, 'updateStatusSelesai'])->name('update.status.selesai');
Route::get('/tanggapan/{pengaduan_id}', [TanggapanController::class, 'showTanggapanForm'])->name('form.tanggapan');

Route::post('/add-tanggapan', [TanggapanController::class, 'addTanggapan'])->name('add.tanggapan');
Route::get('/profile', [PetugasController::class, 'show'])->name('profile');
Route::get('/halaman-petugas', [PetugasController::class, 'showPetugasScreen'])->name('halaman-petugas');


// Route::get('/tanggapan-halaman', [PetugasController::class, 'showTanggapanScreen'])->name('halaman-tanggapan');

Route::get('/tanggapan-halaman', function () {
    $tanggapans = Tanggapan::all();
    return view('tanggapanTable', compact('tanggapans'));
})->middleware(['auth', 'verified'])->name('halaman-tanggapan');


Route::get('/generate-laporan', function () {
    $tanggapan = Tanggapan::all();
    $pengaduan = Pengaduan::all();
    return PDFController::generatePDF($tanggapan, $pengaduan);
})->middleware(['auth', 'verified'])->name('generate.tanggapan');
    


Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');


require __DIR__.'/auth.php';
