<?php

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/informasi-cuaca', [InformasiCuacaController::class, 'index'])->middleware(['auth', 'verified'])->name('informasi-cuaca');

Route::get('/laporan-banjir', [LaporanBanjirController::class, 'index'])->middleware(['auth', 'verified'])->name('laporan-banjir');

Route::get('/materi-edukasi', [MateriEdukasiController::class, 'index'])->middleware(['auth', 'verified'])->name('materi-edukasi');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
