<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Auth\Login::class)->name('login');

Route::middleware('pegawai')->group(function () {
    Route::get('/dashboard', \App\Livewire\Welcome::class)->name('dashboard');

    Route::prefix('cabang')->name('master-cabang.')->group(function () {
        Route::get('/', \App\Livewire\MsCabang\MsCabangDaftar::class)->name('daftar');

        Route::get('/buat', \App\Livewire\MsCabang\MsCabangPerbaharui::class)->name('buat');

        Route::get('/ubah/{id}', \App\Livewire\MsCabang\MsCabangPerbaharui::class)->name('ubah');

        Route::get('/lihat/{id}/hanya-lihat', \App\Livewire\MsCabang\MsCabangPerbaharui::class)->name('lihat');
    });

    Route::get('/pemesanan-penjualan', \App\Livewire\PemesananPenjualan\PemesananPenjualanHeaderDaftar::class)->name('pemesanan-penjualan.list');
    Route::get('/pemesanan-penjualan/buat', \App\Livewire\PemesananPenjualan\PemesananPenjualanHeaderPerbaharui::class)->name('pemesanan-penjualan.buat');
    Route::get('/pemesanan-penjualan/ubah/{id}', \App\Livewire\PemesananPenjualan\PemesananPenjualanHeaderPerbaharui::class)->name('pemesanan-penjualan.edit');
});
