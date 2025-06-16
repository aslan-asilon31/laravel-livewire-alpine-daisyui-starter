<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HakAksesPegawaiCabangSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $allMsPegawaiIds = \App\Models\MsPegawai::all()->pluck('id')->toArray();
        $allMsCabangIds = \App\Models\MsCabang::all()->pluck('id')->toArray();

        $getRandomMsPegawaiId = function () use ($allMsPegawaiIds) {
            return $allMsPegawaiIds[array_rand($allMsPegawaiIds)];
        };

        $getRandomMsCabangId = function () use ($allMsCabangIds) {
            return $allMsCabangIds[array_rand($allMsCabangIds)];
        };

        DB::table('hak_akses_pegawai_cabang')->insert([
            [
                'id' => Str::uuid(),
                'ms_pegawai_id' => $getRandomMsPegawaiId(),
                'ms_cabang_id' => $getRandomMsCabangId(),
                'nomor' => 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'ms_pegawai_id' => $getRandomMsPegawaiId(),
                'ms_cabang_id' => $getRandomMsCabangId(),
                'nomor' => 2,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'ms_pegawai_id' => $getRandomMsPegawaiId(),
                'ms_cabang_id' => $getRandomMsCabangId(),
                'nomor' => 3,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'ms_pegawai_id' => $getRandomMsPegawaiId(),
                'ms_cabang_id' => $getRandomMsCabangId(),
                'nomor' => 4,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'ms_pegawai_id' => $getRandomMsPegawaiId(),
                'ms_cabang_id' => $getRandomMsCabangId(),
                'nomor' => 5,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],
            [
                'id' => Str::uuid(),
                'ms_pegawai_id' => $getRandomMsPegawaiId(),
                'ms_cabang_id' => $getRandomMsCabangId(),
                'nomor' => 6,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => $now,
                'tgl_diupdate' => $now,
                'status' => 'aktif',
            ],

        ]);
    }
}
