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
            'Teguh Wibowo'
        ];

        $pegawaiData = [];



        foreach ($namaKaryawan as $index => $nama) {
            $email = Str::slug($nama) . '@example.com';

            $pegawaiData[] = [
                'id' => Str::uuid(),
                'ms_jabatan_id' => null,
                'nama' => $nama,
                'no_telepon' => '084534435',
                'email' => $email,
                'image_url' => '',
                'nomor' => $index + 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ];
        }

        DB::table('ms_pegawai')->insert($pegawaiData);
    }
}
