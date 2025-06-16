<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class MsPegawaiAkunSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $allMsPegawais = \App\Models\MsPegawai::all();

        foreach ($allMsPegawais as $msPegawai) {
            DB::table('ms_pegawai_akun')->insert([
                [
                    'id' => Str::uuid(),
                    'ms_pegawai_id' => $msPegawai->id,
                    'username' => Str::slug($msPegawai->nama),
                    'email' => $msPegawai->email,
                    'password' => Hash::make('password'),
                    'nomor' => 1,
                    'dibuat_oleh' => 'admin',
                    'diupdate_oleh' => 'admin',
                    'tgl_dibuat' => $now,
                    'tgl_diupdate' => $now,
                    'status' => 'aktif',
                ],
            ]);
        }
    }
}
