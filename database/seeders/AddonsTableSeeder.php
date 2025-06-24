<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AddonsTableSeeder extends Seeder
{
    public function run()
    {
        $addons = [
            'Breakfast',
            'Airport Pickup',
            'Late Checkout',
            'Extra Bed',
            'Room Decoration',
        ];

        foreach ($addons as $addon) {
            DB::table('addons')->insert([
                'id' => Str::uuid(),
                'name' => $addon,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
