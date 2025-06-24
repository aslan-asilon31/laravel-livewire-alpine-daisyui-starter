<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingAddonsTableSeeder extends Seeder
{
    public function run()
    {
        $bookingIds = DB::table('bookings')->pluck('id')->all();
        $addonIds = DB::table('addons')->pluck('id')->all();

        if (empty($bookingIds) || empty($addonIds)) {
            $this->command->warn('Seeder dihentikan: Data bookings atau addons tidak tersedia.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            DB::table('booking_addons')->insert([
                'id' => Str::uuid(),
                'booking_id' => $bookingIds[array_rand($bookingIds)],
                'addon_id' => $addonIds[array_rand($addonIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
