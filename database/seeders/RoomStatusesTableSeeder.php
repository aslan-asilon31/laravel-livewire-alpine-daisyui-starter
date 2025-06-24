<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoomStatusesTableSeeder extends Seeder
{
    public function run()
    {
        $floorIds = DB::table('floors')->pluck('id')->all();
        $roomClassIds = DB::table('room_classes')->pluck('id')->all();

        if (empty($floorIds) || empty($roomClassIds)) {
            $this->command->warn('Seeder dihentikan: floors atau room_classes belum ada data.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            DB::table('room_statuses')->insert([
                'id' => Str::uuid(),
                'floor_id' => $floorIds[array_rand($floorIds)],
                'room_class_id' => $roomClassIds[array_rand($roomClassIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
