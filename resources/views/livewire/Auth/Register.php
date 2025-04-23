<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\Pengguna; // Model pengguna
use Illuminate\Support\Facades\Hash; // Untuk hashing password
use Illuminate\Validation\ValidationException; // Untuk pengecualian validasi
use App\Models\Asesmen;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\JsonResponse; // Untuk tipe respons JSON
use Illuminate\Http\Request; // Untuk Request
use Illuminate\Support\Facades\Auth; // Untuk Auth
use App\Livewire\Auth\Forms\LoginForm;

class Register extends Component
{
    public $title = "Halaman Pendaftaran";
    public $surel;
    public $sandi;
    public $konfirmasiSandi;

    protected function rules()
    {
        return [
            'surel' => 'required|email|unique:penggunas,surel',
            'sandi' => 'required|string|min:8|confirmed',
        ];
    }

    public function register()
    {
        $this->validate();
    
        // Log data yang akan disimpan
        \Log::info('Registering user:', [
            'surel' => $this->surel,
            'sandi' => $this->sandi,
        ]);
    
        // Buat pengguna baru
        Pengguna::create([
            'surel' => $this->surel,
            'sandi' => Hash::make($this->sandi), // Hash password
        ]);
    
        // Redirect atau memberikan pesan sukses
        session()->flash('message', 'Registrasi berhasil! Silakan login.');
        return redirect()->to('/login'); // Ganti dengan rute login Anda
    }
    

    public function render()
    {
        return view('livewire.auth.register')
        ->layout('components.layouts.app_auth');
    }
}
