<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FeaturesTableSeeder extends Seeder
{
    public function run()
    {
        $features = [
            ['name' => 'Wi-Fi'],
            ['name' => 'AC'],
            ['name' => 'TV Cable'],
            ['name' => 'Mini Bar'],
            ['name' => 'Balcony'],
            ['name' => 'Sea View'],
            ['name' => 'Room Service'],
        ];

        foreach ($features as $feature) {
            DB::table('features')->insert([
                'id' => Str::uuid(),
                'name' => $feature['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
