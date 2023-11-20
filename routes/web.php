<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetugasController;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" midleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [PetugasController::class, 'showLoginForm'])->name('login');
Route::post('/login', [PetugasController::class, 'login']);

// Route::get('/home', [PetugasController::class, 'showHome'])->name('home');
Route::get('/home', function (){
    $pengaduans = Pengaduan::all();
    return view('welcome', compact('pengaduans'));
})->name('home');


Route::get('/register', [PetugasController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [PetugasController::class, 'register']);
Route::post('/logout', [PetugasController::class, 'logout'])->name('logout');
