<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\MsPegawai;
use Illuminate\Support\Facades\Hash;

class MsPegawaiSeeder extends Seeder
{
    public function run()
    {
        $namaKaryawan = [
            'Andi Saputra',
            'Budi Santoso',
            'Citra Dewi',
            'Dewi Lestari',
            'Eko Prasetyo',
            'Fajar Nugroho',
            'Galih Rahman',
            'Hendra Wijaya',
            'Indah Permata',
            'Joko Susilo',
            'Kirana Putri',
            'Lia Amalia',
            'Maya Sari',
            'Niko Hartono',
            'Oki Kurniawan',
            'Putri Anggraini',
            'Qori Pratama',
            'Rizki Maulana',
            'Sari Melati',
            'Teguh Wibowo',
            'Aslan Admin',
            'Aslan SPV',
            'Aslan manager',
            'Aslan head-office',
            'Aslan customer',
            'Aslan staff',
        ];

        $pegawaiData = [];



        foreach ($namaKaryawan as $index => $nama) {

            $pegawaiData[] = [
                'id' => Str::uuid(),
                'ms_jabatan_id' => null,
                'nama' => $nama,
                'no_telepon' => '084534435',
                'image_url' => '',
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
            ];
        }

        DB::table('ms_pegawai')->insert($pegawaiData);
    }
}
