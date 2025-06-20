<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HakAksesJabatanStatusSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $allMsStatusIds = \App\Models\MsStatus::all()->pluck('id')->toArray();
        $allHakAksesJabatanIds = \App\Models\HakAksesJabatan::all()->pluck('id')->toArray();

        $getRandomMsStatusId = function () use ($allMsStatusIds) {
            return $allMsStatusIds[array_rand($allMsStatusIds)];
        };

        $getRandomHakAksesJabatanId = function () use ($allHakAksesJabatanIds) {
            return $allHakAksesJabatanIds[array_rand($allHakAksesJabatanIds)];
        };

        DB::table('hak_akses_jabatan_status')->insert([
            [
                'id' => Str::uuid(),
                'ms_status_id' => $getRandomMsStatusId(),
                'hak_akses_jabatan_id' => $getRandomHakAksesJabatanId(),
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
            ],
            [
                'id' => Str::uuid(),
                'ms_status_id' => $getRandomMsStatusId(),
                'hak_akses_jabatan_id' => $getRandomHakAksesJabatanId(),
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
            ],
            [
                'id' => Str::uuid(),
                'ms_status_id' => $getRandomMsStatusId(),
                'hak_akses_jabatan_id' => $getRandomHakAksesJabatanId(),
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
            ],
            [
                'id' => Str::uuid(),
                'ms_status_id' => $getRandomMsStatusId(),
                'hak_akses_jabatan_id' => $getRandomHakAksesJabatanId(),
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
            ],
            [
                'id' => Str::uuid(),
                'ms_status_id' => $getRandomMsStatusId(),
                'hak_akses_jabatan_id' => $getRandomHakAksesJabatanId(),
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
            ],
        ]);
    }
}
