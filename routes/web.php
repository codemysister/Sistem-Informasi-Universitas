<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [JurusanController::class, 'index']);


Auth::routes();


// Route untuk jurusan
Route::resource('jurusans', JurusanController::class);
Route::get('/jurusan-dosen/{jurusan_id}', [
    JurusanController::class,
    'jurusanDosen'
])->name('jurusan-dosen');
Route::get('/jurusan-mahasiswa/{jurusan_id}', [
    JurusanController::class,
    'jurusanMahasiswa'
])->name('jurusan-mahasiswa');



// Route untuk mahasiswa
Route::resource('mahasiswas', MahasiswaController::class);
Route::get(
    '/mahasiswas/ambil-matakuliah/{mahasiswa}',
    [MahasiswaController::class, 'ambilMatakuliah']
)->name('ambil-matakuliah');
Route::post(
    '/mahasiswas/ambil-matakuliah/{mahasiswa}',
    [MahasiswaController::class, 'prosesAmbilMatakuliah']
)
    ->name('proses-ambil-matakuliah');



// Route untuk dosen
Route::resource('dosens', DosenController::class);




// Route untuk matakuliah
Route::resource('matakuliahs', MatakuliahController::class);
Route::get('/buat-matakuliah/{dosen}', [
    MatakuliahController::class,
    'buatMatakuliah'
])->name('buat-matakuliah');
Route::get(
    '/matakuliahs/daftarkan-mahasiswa/{matakuliah}',
    [MatakuliahController::class, 'daftarkanMahasiswa']
)
    ->name('daftarkan-mahasiswa');

Route::post(
    '/matakuliahs/daftarkan-mahasiswa/{matakuliah}',
    [MatakuliahController::class, 'prosesDaftarkanMahasiswa']
)
    ->name('proses-daftarkan-mahasiswa');


// Route untuk Search
Route::get('/pencarian', [PencarianController::class, 'index']);
Route::get('/pencarian/proses', [PencarianController::class, 'proses']);
