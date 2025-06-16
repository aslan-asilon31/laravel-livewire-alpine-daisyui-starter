<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MsJabatanSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('ms_jabatan')->insert([
            [
                'id' => Str::uuid(),
                'nama' => 'developer',
                'nomor' => 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'head-office',
                'nomor' => 2,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'manager',
                'nomor' => 3,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'supervisor',
                'nomor' => 4,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'admin',
                'nomor' => 5,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'customer1',
                'nomor' => 6,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'customer2',
                'nomor' => 7,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],

        ]);
    }
}
