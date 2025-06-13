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
});
