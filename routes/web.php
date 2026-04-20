<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Petugas\DashboardPetugasController;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjamanController;
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\User\PeminjamanController as UserPeminjamanController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Petugas\PengembalianController;
use App\Http\Controllers\Petugas\LaporanController;
use App\Http\Controllers\Petugas\DendaController as PetugasDendaController;
use App\Http\Controllers\User\DendaController as UserDendaController;

Route::get('/', fn() => redirect()->route('login'));

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

// Admin
Route::middleware(['auth','role.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('kategoris', KategoriController::class);
    Route::resource('alats', AlatController::class);
});

// Petugas
Route::middleware(['auth','role.petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [DashboardPetugasController::class, 'index'])->name('dashboard');
    Route::get('/peminjaman', [PetugasPeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/{peminjaman}', [PetugasPeminjamanController::class, 'show'])->name('peminjaman.show');
    Route::post('/peminjaman/{peminjaman}/setujui', [PetugasPeminjamanController::class, 'setujui'])->name('peminjaman.setujui');
    Route::post('/peminjaman/{peminjaman}/tolak', [PetugasPeminjamanController::class, 'tolak'])->name('peminjaman.tolak');
    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::post('/pengembalian/{peminjaman}', [PengembalianController::class, 'proses'])->name('pengembalian.proses');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/print', [LaporanController::class, 'print'])->name('laporan.print');
    Route::get('/denda', [PetugasDendaController::class, 'index'])->name('denda.index');
    Route::get('/denda/create/{peminjaman}', [PetugasDendaController::class, 'create'])->name('denda.create');
    Route::post('/denda/store/{peminjaman}', [PetugasDendaController::class, 'store'])->name('denda.store');
    Route::post('/denda/{denda}/konfirmasi-cash', [PetugasDendaController::class, 'konfirmasiCash'])->name('denda.konfirmasi.cash');
    Route::post('/denda/{denda}/konfirmasi-qris', [PetugasDendaController::class, 'konfirmasiQris'])->name('denda.konfirmasi.qris');
});

// User
Route::middleware(['auth','role.user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('dashboard');
    Route::get('/alat', [UserPeminjamanController::class, 'daftarAlat'])->name('alat.index');
    Route::get('/peminjaman/create/{alat_id}', [UserPeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [UserPeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::get('/peminjaman/riwayat', [UserPeminjamanController::class, 'riwayat'])->name('peminjaman.riwayat');
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [UserProfileController::class, 'updatePassword'])->name('profile.password');
    Route::get('/denda', [UserDendaController::class, 'index'])->name('denda.index');
    Route::get('/denda/{denda}/bayar', [UserDendaController::class, 'bayar'])->name('denda.bayar');
    Route::post('/denda/{denda}/bayar', [UserDendaController::class, 'submitBayar'])->name('denda.submit');
});

// Route registrasi khusus user/peminjam
Route::get('/register-peminjam', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register')->middleware('guest');
Route::post('/register-peminjam', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])->middleware('guest');

require __DIR__.'/auth.php';