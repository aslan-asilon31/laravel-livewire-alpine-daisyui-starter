<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        $password = Hash::make('password');

        for ($i = 1; $i <= 20; $i++) {
            User::create([
                'name' => "User $i",
                'email' => "user$i@example.com",
                'password' => $password,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
