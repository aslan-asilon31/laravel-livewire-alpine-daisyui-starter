<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HakAksesGrupSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('hak_akses_grup')->insert([
            [
                'id' => Str::uuid(),
                'nama' => 'Admin Hak Akses',
                'nomor' => 1,
                'dibuat_oleh' => 'seeder',
                'diupdate_oleh' => 'seeder',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'Supervisor Hak Akses',
                'nomor' => 2,
                'dibuat_oleh' => 'seeder',
                'diupdate_oleh' => 'seeder',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'Manager Hak Akses',
                'nomor' => 3,
                'dibuat_oleh' => 'seeder',
                'diupdate_oleh' => 'seeder',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
        ]);

        $this->command->info('✔ hak_akses_grup seeded.');
    }
}
