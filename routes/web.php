<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lapor-banjir', [ReportController::class, 'create'])->name('lapor.create');
Route::post('/lapor-banjir', [ReportController::class, 'store'])->name('lapor.store');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ReportController::class, 'index'])->name('dashboard');
    Route::get('/laporan', [ReportController::class, 'index'])->name('laporan.index');
    Route::patch('/laporan/{report}/status', [ReportController::class, 'updateStatus'])->name('laporan.status');
    Route::get('/profil-petugas', [ReportController::class, 'officerProfile'])->name('petugas.profile');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
