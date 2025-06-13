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
                'nama' => $nama,
                'email' => $email,
                'password' => Hash::make('password'),
                'nomor' => $index + 1,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ];
        }

        DB::table('ms_pegawai')->insert($pegawaiData);

        // Ambil nomor terakhir
        $lastNumber = MsPegawai::max('nomor') ?? 0;

        // Admin
        $admin = new MsPegawai();
        $admin->nama = 'Admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = Hash::make('password');
        $admin->nomor = $lastNumber + 1;
        $admin->tgl_dibuat = Carbon::now();
        $admin->tgl_diupdate = Carbon::now();
        $admin->status = 'aktif';
        $admin->save();

        // Manager
        $manager = new MsPegawai();
        $manager->nama = 'Manager';
        $manager->email = 'manager@gmail.com';
        $manager->password = Hash::make('password');
        $manager->nomor = $lastNumber + 2;
        $manager->tgl_dibuat = Carbon::now();
        $manager->tgl_diupdate = Carbon::now();
        $manager->status = 'aktif';
        $manager->save();

        // Staff
        $staff = new MsPegawai();
        $staff->nama = 'Staff';
        $staff->email = 'staff@gmail.com';
        $staff->password = Hash::make('password');
        $staff->nomor = $lastNumber + 3;
        $staff->tgl_dibuat = Carbon::now();
        $staff->tgl_diupdate = Carbon::now();
        $staff->status = 'aktif';
        $staff->save();
    }
}
