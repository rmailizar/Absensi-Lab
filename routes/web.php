<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});

Route::resource('mahasiswa', MahasiswaController::class);

Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
Route::post('/absensi/store', [AbsensiController::class, 'store'])->name('absensi.store');
Route::get('/absensi/rekap', function() {
    $data = \App\Models\Absensi::with('mahasiswa')->latest()->get();
    return view('absensi.rekap', compact('data'));
});
