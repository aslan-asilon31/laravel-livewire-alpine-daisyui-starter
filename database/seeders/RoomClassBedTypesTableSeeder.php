<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoomClassBedTypesTableSeeder extends Seeder
{
    public function run()
    {
        $roomClassIds = DB::table('room_classes')->pluck('id')->all();
        $bedTypeIds = DB::table('bed_types')->pluck('id')->all();

        if (empty($roomClassIds) || empty($bedTypeIds)) {
            $this->command->warn('Seeder dihentikan: room_classes atau bed_types belum ada data.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            DB::table('room_class_bed_types')->insert([
                'id' => Str::uuid(),
                'room_class_id' => $roomClassIds[array_rand($roomClassIds)],
                'bed_type_id' => $bedTypeIds[array_rand($bedTypeIds)],
                'num_beds' => rand(1, 3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
