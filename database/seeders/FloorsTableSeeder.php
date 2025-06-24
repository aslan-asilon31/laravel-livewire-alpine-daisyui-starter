<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FloorsTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('floors')->insert([
                'id' => Str::uuid(),
                'floor_number' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
