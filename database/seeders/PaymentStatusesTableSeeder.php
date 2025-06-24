<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentStatusesTableSeeder extends Seeder
{
    public function run()
    {
        $statuses = [
            'Pending',
            'Paid',
            'Cancelled',
            'Failed',
        ];

        foreach ($statuses as $status) {
            DB::table('payment_statuses')->insert([
                'id' => Str::uuid(),
                'name' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
