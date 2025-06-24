<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoomsTableSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua ID dari tabel floors dan room_classes
        $floorIds = DB::table('floors')->pluck('id')->all();
        $roomClassIds = DB::table('room_classes')->pluck('id')->all();

        if (empty($floorIds) || empty($roomClassIds)) {
            $this->command->warn('Seeder dihentikan: tidak ada data di tabel floors atau room_classes.');
            return;
        }

        // Masukkan 10 data rooms
        for ($i = 1; $i <= 10; $i++) {
            DB::table('rooms')->insert([
                'id' => Str::uuid(),
                'floor_id' => $floorIds[array_rand($floorIds)],
                'room_class_id' => $roomClassIds[array_rand($roomClassIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
