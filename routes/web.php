<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Auth\Login::class)->name('login');

Route::get('/recipe', \App\Livewire\Recipes\RecipeList::class)->name('recipe.list');
Route::get('/product', \App\Livewire\Products\ProductList::class)->name('product.list');
Route::get('/blog', \App\Livewire\Blogs\BlogList::class)->name('blog.list');

Route::get('/barang', \App\Livewire\MsBarang\MsBarangDaftar::class)->name('master-barang.daftar');
Route::get('/barang/buat', \App\Livewire\MsBarang\MsBarangPerbaharui::class)->name('master-barang.buat');
Route::get('/barang/edit/{id}', \App\Livewire\MsBarang\MsBarangPerbaharui::class)->name('master-barang.edit');

Route::get('/dashboard', \App\Livewire\Welcome::class)->name('dashboard');

Route::middleware('user')->group(function () {});

//Route Hooks - Do not delete//
Route::view('users', 'livewire.users.index');
// Route::view('users', 'livewire.users.index')->middleware('auth');
