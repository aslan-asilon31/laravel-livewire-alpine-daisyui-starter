<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Auth\Login::class)->name('login');

Route::middleware('pegawai')->group(function () {
    Route::get('/dashboard', \App\Livewire\Welcome::class)->name('dashboard');

    Route::prefix('cabang')->name('master-cabang.')->group(function () {
        Route::get('/', \App\Livewire\MsCabang\MsCabangDaftar::class)->name('daftar');

        Route::get('/buat', \App\Livewire\MsCabang\MsCabangPerbaharui::class)->name('buat');

        Route::get('/edit/{id}', \App\Livewire\MsCabang\MsCabangPerbaharui::class)->name('edit');

        Route::get('/lihat/{id}/hanya-lihat', \App\Livewire\MsCabang\MsCabangPerbaharui::class)->name('lihat');
    });

    Route::get('/pemesanan-penjualan', \App\Livewire\PemesananPenjualan\PemesananPenjualanHeaderDaftar::class)->name('pemesanan-penjualan.daftar');
    Route::get('/pemesanan-penjualan/buat', \App\Livewire\PemesananPenjualan\PemesananPenjualanHeaderPerbaharui::class)->name('pemesanan-penjualan.buat');
    Route::get('/pemesanan-penjualan/edit/{id}', \App\Livewire\PemesananPenjualan\PemesananPenjualanHeaderPerbaharui::class)->name('pemesanan-penjualan.edit');


    Route::get('/hak-akses-jabatan', \App\Livewire\HakAksesJabatan\HakAksesJabatanDaftar::class)->name('hak-akses-jabatan.daftar');
    Route::get('/hak-akses-jabatan/buat', \App\Livewire\HakAksesJabatan\HakAksesJabatanPerbaharui::class)->name('hak-akses-jabatan.buat');
    Route::get('/hak-akses-jabatan/edit/{id}', \App\Livewire\HakAksesJabatan\HakAksesJabatanPerbaharui::class)->name('hak-akses-jabatan.edit');

    Route::get('/pegawai', \App\Livewire\MsPegawai\MsPegawaiDaftar::class)->name('master-pegawai.daftar');
    Route::get('/pegawai/buat', \App\Livewire\MsPegawai\MsPegawaiPerbaharui::class)->name('master-pegawai.buat');
    Route::get('/pegawai/edit/{id}', \App\Livewire\MsPegawai\MsPegawaiPerbaharui::class)->name('master-pegawai.edit');

    Route::get('/profile', \App\Livewire\Profile\Profile::class)->name('profile');
});
