<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BedTypesTableSeeder extends Seeder
{
    public function run()
    {
        $bedTypes = [
            ['name' => 'Single Bed'],
            ['name' => 'Double Bed'],
            ['name' => 'Queen Size Bed'],
            ['name' => 'King Size Bed'],
            ['name' => 'Bunk Bed'],
        ];

        foreach ($bedTypes as $bedType) {
            DB::table('bed_types')->insert([
                'id' => Str::uuid(),
                'name' => $bedType['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
