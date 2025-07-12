<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\SubkriteriaController;

//LOGIN
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticating']);
});


// ADMIN
Route::middleware(['auth'])->group(function () {
    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index']);
    // LOGOUT
    Route::get('/logout', [AuthController::class, 'logout']);
    // Data Masyarakat
    Route::get('/masyarakat', [MasyarakatController::class, 'index'])->name('masyarakat.index');
    Route::post('/masyarakat-add', [MasyarakatController::class, 'store'])->name('masyarakat.store');
    Route::get('/masyarakat-edit/{id}', [MasyarakatController::class, 'edit']);
    Route::post('/masyarakat-edit/{id}', [MasyarakatController::class, 'update']);
    Route::get('/masyarakat-destroy/{id}', [MasyarakatController::class, 'destroy']);
    Route::get('/masyarakat-show/{id}', [MasyarakatController::class, 'show'])->name('masyarakat.show');
    Route::get('/masyarakat-cetak', [MasyarakatController::class, 'cetakmasyarakat'])->name('masyarakat.cetak');
    //Kriteria
    Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
    Route::post('/kriteria-add', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::get('/kriteria-edit/{id}', [KriteriaController::class, 'edit']);
    Route::post('/kriteria-edit/{id}', [KriteriaController::class, 'update']);
    Route::get('/kriteria-destroy/{id}', [KriteriaController::class, 'destroy']);
    Route::get('/kriteria-show/{id}', [KriteriaController::class, 'show'])->name('kriteria.show');
    //Sub
    Route::get('/kriteria/{kriteria}/sub', [SubkriteriaController::class, 'showSubPage'])->name('kriteria.sub');
    Route::post('/subkriteria-add', [SubkriteriaController::class, 'store'])->name('subkriteria.store');
    Route::get('/subkriteria-destroy/{id}', [SubkriteriaController::class, 'destroy']);
    //Penilaian
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::post('/penilaian-add', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::get('/penilaian-destroy/{fasilitas_id}', [PenilaianController::class, 'destroy']);
    //PERHITUNGAN
    Route::get('/perhitungan', [PerhitunganController::class, 'index'])->name('perhitungan.index');
    Route::get('/perhitungan-cetak', [PerhitunganController::class, 'cetakperhitungan'])->name('perhitungan.cetak');
    // USER
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user-add', [UserController::class, 'store'])->name('user.store');
    Route::get('/user-edit/{id}', [UserController::class, 'edit']);
    Route::post('/user-edit/{id}', [UserController::class, 'update']);
    Route::get('/user-destroy/{id}', [UserController::class, 'destroy']);
    Route::get('/user-show/{id}', [UserController::class, 'show'])->name('user.show');
    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan-cetak', [LaporanController::class, 'cetaklaporan'])->name('laporan.cetak');
});
