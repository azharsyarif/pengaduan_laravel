    <?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PetugasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/login', 'AuthController@login');

Route::post('/register', [MasyarakatController::class,'register'])->name('register');
Route::post('/login', [MasyarakatController::class,'login'])->name('login');

Route::post('/pengaduan/create', [PengaduanController::class,'create'])->name('create');
Route::get('/get-pengaduan/{nik}', [PengaduanController::class, 'SelectByNik']);

Route::post('masyarakat/logout', [MasyarakatController::class,'logout'])->name('logout');
Route::get('masyarakat', [MasyarakatController::class,'index'])->name('index');
Route::get('masyarakat/id/{id}', [MasyarakatController::class,'getUserProfile'])->name('show');
Route::post('masyarakat/update/{id}', [MasyarakatController::class,'update'])->name('update');
Route::get('/masyarakat/nik/{nik}', [MasyarakatController::class, 'getByNik'])->name('bynik');

// Route::get('/pengaduan/{id}', 'PengaduanController@show');


Route::get('petugas', [PetugasController::class, 'index']);
Route::post('petugas/create', [PetugasController::class, 'create']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

