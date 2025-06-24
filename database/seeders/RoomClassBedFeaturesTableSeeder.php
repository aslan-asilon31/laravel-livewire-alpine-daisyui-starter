<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoomClassBedFeaturesTableSeeder extends Seeder
{
    public function run()
    {
        $roomClassIds = DB::table('room_classes')->pluck('id')->all();
        $featureIds = DB::table('features')->pluck('id')->all();

        if (empty($roomClassIds) || empty($featureIds)) {
            $this->command->warn('Seeder dihentikan: room_classes atau features belum ada data.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            DB::table('room_class_bed_features')->insert([
                'id' => Str::uuid(),
                'room_class_id' => $roomClassIds[array_rand($roomClassIds)],
                'feature_id' => $featureIds[array_rand($featureIds)],
                'num_beds' => rand(1, 3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
