<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/user/management', function () {
        return view('pages.user-management');
    })->name('user.management')->middleware('auth');

    Route::resource('anggota', AnggotaController::class);
    Route::get('/user/management', [AnggotaController::class, 'index'])->name('user.management');
    Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::get('/anggota/{anggota}/edit', [AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('/anggota/{anggota}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{anggota}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');

    Route::get('/book/management', [BukuController::class, 'index'])->name('buku.index');
    Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
    Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
    Route::get('/buku/{buku}/edit', [BukuController::class, 'edit'])->name('buku.edit');
    Route::put('/buku/{buku}', [BukuController::class, 'update'])->name('buku.update');
    Route::delete('/buku/{buku}', [BukuController::class, 'destroy'])->name('buku.destroy');

    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::get('/peminjaman/{peminjaman}/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
    Route::put('/peminjaman/{peminjaman}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
    Route::delete('/peminjaman/{peminjaman}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');

    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::get('/pengembalian/create', [PengembalianController::class, 'create'])->name('pengembalian.create');
    Route::post('/pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');
    Route::get('/pengembalian/{pengembalian}/edit', [PengembalianController::class, 'edit'])->name('pengembalian.edit');
    Route::put('/pengembalian/{pengembalian}', [PengembalianController::class, 'update'])->name('pengembalian.update');
    Route::delete('/pengembalian/{pengembalian}', [PengembalianController::class, 'destroy'])->name('pengembalian.destroy');

    Route::get('/denda', [DendaController::class, 'index'])->name('denda.index');
    Route::get('/denda/create', [DendaController::class, 'create'])->name('denda.create');
    Route::post('/denda', [DendaController::class, 'store'])->name('denda.store');
    Route::get('/denda/{denda}/edit', [DendaController::class, 'edit'])->name('denda.edit');
    Route::put('/denda/{denda}', [DendaController::class, 'update'])->name('denda.update');
    Route::delete('/denda/{denda}', [DendaController::class, 'destroy'])->name('denda.destroy');
    Route::get('/denda/export', [DendaController::class, 'export'])->name('denda.export');


    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});
