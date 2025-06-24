<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BookingsTableSeeder extends Seeder
{
    public function run()
    {
        $roleIds = DB::table('roles')->pluck('id')->all();
        $paymentStatusIds = DB::table('payment_statuses')->pluck('id')->all();

        if (empty($roleIds) || empty($paymentStatusIds)) {
            $this->command->warn('Seeder dihentikan: roles atau payment_statuses tidak tersedia.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            $checkin = Carbon::now()->addDays(rand(1, 10));
            $checkout = (clone $checkin)->addDays(rand(1, 3));

            DB::table('bookings')->insert([
                'id' => Str::uuid(),
                'role_id' => $roleIds[array_rand($roleIds)],
                'payment_status_id' => $paymentStatusIds[array_rand($paymentStatusIds)],
                'checkin_date' => $checkin,
                'checkout_date' => $checkout,
                'num_adults' => rand(1, 4),
                'num_children' => rand(0, 3),
                'booking_amount' => rand(500000, 2000000), // Format angka rupiah
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
