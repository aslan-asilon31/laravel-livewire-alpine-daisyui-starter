<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingRoomsTableSeeder extends Seeder
{
    public function run()
    {
        $bookingIds = DB::table('bookings')->pluck('id')->all();
        $paymentStatusIds = DB::table('payment_statuses')->pluck('id')->all();

        if (empty($bookingIds) || empty($paymentStatusIds)) {
            $this->command->warn('Seeder dihentikan: tidak ada data di tabel bookings atau payment_statuses.');
            return;
        }

        for ($i = 1; $i <= 10; $i++) {
            DB::table('booking_rooms')->insert([
                'id' => Str::uuid(),
                'booking_id' => $bookingIds[array_rand($bookingIds)],
                'payment_status_id' => $paymentStatusIds[array_rand($paymentStatusIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
