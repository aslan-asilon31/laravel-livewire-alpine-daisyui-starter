<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Spatie\Permission\Traits;
use Spatie\Permission\PermissionRegistrar;

class Login extends Component
{
    public $user = [];
    public $userId;
    public $userAuth;
    public $userName;
    public $userEmail;

    public $email;
    public $password;
    public $title = "Halaman Login";


    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:5',
    ];

    public function mount()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        if (Auth::check()) {

            $this->userId = auth()->id();

            $user = User::where('id', $this->userId)->first();
            $this->user = $user ? $user->toArray() : null;

            $this->userName = $this->user['name'];
            $this->userEmail = $this->user['email'];

            session()->put('soal-sesi',[
                'user_id' => $this->userId,
                'user_name' => $this->userName,
                'user_email' => $this->userEmail,
            ]);

            if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('admin')) {
                return redirect()->to('/dasbor');
            } else {
                return redirect()->to('/dasbor-user');
            }

        }
    }



    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            // return redirect()->to('/dasbor');

            if (Auth::user()->hasRole('developer') || Auth::user()->hasRole('admin')) {
                return redirect()->to('/dasbor');
            } else {
                return redirect()->to('/dasbor-user');
            }

        } else {
            throw ValidationException::withMessages([
                'email' => ['Email or password is incorrect.'],
            ]);
        }
    }

    public function render()
    {
        return view('livewire.auth.login')
        ->layout('components.layouts.app_auth')
        ->title($this->title);
    }
}

