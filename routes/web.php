<?php

use App\Http\Controllers\MahasiswaController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [MahasiswaController::class,'index'])->name('login');
Route::post('/login', [MahasiswaController::class,'login']);
Route::get('/logout', [MahasiswaController::class,'logout']);
Route::middleware(['auth'])->group(function () {
    Route::get('/mahasiswas', [MahasiswaController::class,'mahasiswa'] )->name('mahasiswas.mahasiswa');

});
Route::get('/mahasiswas/create', [MahasiswaController::class,'create'] )->name('mahasiswas.create');
Route::post('/mahasiswas', [MahasiswaController::class,'store'] )->name('mahasiswas.store');
Route::get('/mahasiswas/{mahasiswa}', [MahasiswaController::class,'show'] )->name('mahasiswas.show');
Route::get('/mahasiswas/{mahasiswa}/edit', [MahasiswaController::class,'edit'] )->name('mahasiswas.edit');
Route::patch('/mahasiswas/{mahasiswa}', [MahasiswaController::class,'update'] )->name('mahasiswas.update');
Route::delete('/mahasiswas/{mahasiswa}', [MahasiswaController::class,'destroy'] )->name('mahasiswas.destroy');
//upload
Route::get('/file-upload', [MahasiswaController::class,'fileUpload']);
Route::post('/file-upload', [MahasiswaController::class,'prosesFileUpload']);
//middleware
Route::get('/daftar-mahasiswa', [MahasiswaController::class,'daftarMahasiswa']);
Route::get('/tabel-mahasiswa', [MahasiswaController::class,'tabelMahasiswa']);
Route::get('/blog-mahasiswa', [MahasiswaController::class,'blogMahasiswa']);
//session
Route::get('/session', [MahasiswaController::class,'session']);
Route::get('/buat-session', [MahasiswaController::class,'buatSession']);
Route::get('/akses-session', [MahasiswaController::class,'aksesSession']);
Route::get('/hapus-session', [MahasiswaController::class,'hapusSession']);
Route::get('/flash-session', [MahasiswaController::class,'flashSession']);
