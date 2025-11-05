<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\KartuController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});

Route::resource('mahasiswa', MahasiswaController::class);

Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
Route::post('/absensi/store', [AbsensiController::class, 'store'])->name('absensi.store');
Route::get('/absensi/export', [AbsensiController::class, 'export'])->name('absensi.export');
// halaman rekap absensi
Route::get('/absensi/rekap', [AbsensiController::class, 'rekap'])->name('absensi.rekap');

Route::resource('users', UserController::class);

Route::get('/mahasiswa/{id}/kartu', [KartuController::class, 'show'])->name('mahasiswa.kartu.show');
Route::get('/mahasiswa/{id}/kartu/download', [KartuController::class, 'download'])->name('mahasiswa.kartu.download');