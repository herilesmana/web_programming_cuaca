<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InformasiCuacaController;
use App\Http\Controllers\LaporanBanjirController;
use App\Http\Controllers\MateriEdukasiController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/informasi-cuaca', [InformasiCuacaController::class, 'index'])->middleware(['auth', 'verified'])->name('informasi-cuaca');

Route::get('/laporan-banjir', [LaporanBanjirController::class, 'index'])->middleware(['auth', 'verified'])->name('laporan-banjir');
Route::post('/aporan-banjir/store', [LaporanBanjirController::class, 'store'])->middleware(['auth', 'verified'])->name('laporan-banjir.store');
Route::post('/aporan-banjir/follow-up', [LaporanBanjirController::class, 'followUp'])->middleware(['auth', 'verified'])->name('laporan-banjir.follow-up');

Route::get('/materi-edukasi', [MateriEdukasiController::class, 'index'])->middleware(['auth', 'verified'])->name('materi-edukasi');
Route::post('/materi-edukasi/store', [MateriEdukasiController::class, 'store'])->middleware(['auth', 'verified'])->name('materi-edukasi.store');
Route::get('/materi-edukasi/show/{url}', [MateriEdukasiController::class, 'show'])->middleware(['auth', 'verified'])->name('materi-edukasi.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
