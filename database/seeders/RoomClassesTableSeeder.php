<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoomClassesTableSeeder extends Seeder
{
    public function run()
    {
        $roomClasses = [
            ['class_name' => 'Standard', 'base_price' => '500000'],
            ['class_name' => 'Deluxe', 'base_price' => '750000'],
            ['class_name' => 'Suite', 'base_price' => '1200000'],
            ['class_name' => 'Presidential', 'base_price' => '2500000'],
        ];

        foreach ($roomClasses as $roomClass) {
            DB::table('room_classes')->insert([
                'id' => Str::uuid(),
                'class_name' => $roomClass['class_name'],
                'base_price' => $roomClass['base_price'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
