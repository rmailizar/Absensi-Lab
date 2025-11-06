<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\KartuController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\UserController;
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
    return view('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::post('/absensi/store', [AbsensiController::class, 'store'])->name('absensi.store');
    Route::get('/absensi/export', [AbsensiController::class, 'export'])->name('absensi.export');
    // halaman rekap absensi
    Route::get('/absensi/rekap', [AbsensiController::class, 'rekap'])->name('absensi.rekap');

    Route::resource('users', UserController::class);
    Route::get('/mahasiswa/{id}/kartu', [KartuController::class, 'show'])->name('mahasiswa.kartu.show');
    Route::get('/mahasiswa/{id}/kartu/download', [KartuController::class, 'download'])->name('mahasiswa.kartu.download');

    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    
        // Tampilkan semua mahasiswa (Method: index)
        // URI: /mahasiswa
        Route::get('/', [MahasiswaController::class, 'index'])
             ->name('index');
    
        // Form tambah mahasiswa (Method: create)
        // URI: /mahasiswa/create
        Route::get('/create', [MahasiswaController::class, 'create'])
             ->name('create');
    
        // Simpan data mahasiswa baru (Method: store)
        // URI: /mahasiswa
        Route::post('/', [MahasiswaController::class, 'store'])
             ->name('store');
    
        // Form edit mahasiswa (Method: edit)
        // URI: /mahasiswa/{mahasiswa}/edit
        Route::get('/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])
             ->name('edit');
    
        // Update data mahasiswa (Method: update)
        // URI: /mahasiswa/{mahasiswa}
        // Catatan: Gunakan @method('PUT') atau @method('PATCH') di form Anda
        Route::put('/{mahasiswa}', [MahasiswaController::class, 'update'])
             ->name('update');
    
        // Hapus mahasiswa (Method: destroy)
        // URI: /mahasiswa/{mahasiswa}
        // Catatan: Gunakan @method('DELETE') di form Anda
        Route::delete('/{mahasiswa}', [MahasiswaController::class, 'destroy'])
             ->name('destroy');
    });
});

require __DIR__.'/auth.php';
