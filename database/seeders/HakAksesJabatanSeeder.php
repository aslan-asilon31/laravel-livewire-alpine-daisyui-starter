<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HakAksesJabatanSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $allMsJabatanIds = \App\Models\MsJabatan::all()->pluck('id')->toArray();
        $allHakAksesIds = \App\Models\HakAkses::all()->pluck('id')->toArray();

        $getRandomMsJabatanId = function () use ($allMsJabatanIds) {
            return $allMsJabatanIds[array_rand($allMsJabatanIds)];
        };

        $getRandomHakAksesId = function () use ($allHakAksesIds) {
            return $allHakAksesIds[array_rand($allHakAksesIds)];
        };


        DB::table('hak_akses_jabatan')->insert([
            [
                'id' => Str::uuid(),
                'ms_jabatan_id' => $getRandomMsJabatanId(),
                'hak_akses_id' => $getRandomHakAksesId(),
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
            ],
            [
                'id' => Str::uuid(),
                'ms_jabatan_id' => $getRandomMsJabatanId(),
                'hak_akses_id' => $getRandomHakAksesId(),
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
            ],
            [
                'id' => Str::uuid(),
                'ms_jabatan_id' => $getRandomMsJabatanId(),
                'hak_akses_id' => $getRandomHakAksesId(),
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
            ],
            [
                'id' => Str::uuid(),
                'ms_jabatan_id' => $getRandomMsJabatanId(),
                'hak_akses_id' => $getRandomHakAksesId(),
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
            ],
            [
                'id' => Str::uuid(),
                'ms_jabatan_id' => $getRandomMsJabatanId(),
                'hak_akses_id' => $getRandomHakAksesId(),
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
            ],
        ]);
    }
}
