<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MsHalamanSeeder extends Seeder
{
    public function run()
    {
        $halamanData = [

            ['nama' => 'ms-barang-daftar'],
            ['nama' => 'ms-barang-buat'],
            ['nama' => 'ms-barang-ubah'],
            ['nama' => 'ms-barang-update'],
            ['nama' => 'ms-barang-simpan'],
            ['nama' => 'ms-barang-hapus'],
            ['nama' => 'ms-barang-lihat'],

            ['nama' => 'ms-cabang-daftar'],
            ['nama' => 'ms-cabang-buat'],
            ['nama' => 'ms-cabang-ubah'],
            ['nama' => 'ms-cabang-update'],
            ['nama' => 'ms-cabang-simpan'],
            ['nama' => 'ms-cabang-hapus'],
            ['nama' => 'ms-cabang-lihat'],

            ['nama' => 'ms-file-daftar'],
            ['nama' => 'ms-file-buat'],
            ['nama' => 'ms-file-ubah'],
            ['nama' => 'ms-file-update'],
            ['nama' => 'ms-file-simpan'],
            ['nama' => 'ms-file-hapus'],
            ['nama' => 'ms-file-lihat'],

            ['nama' => 'ms-file-jenis-daftar'],
            ['nama' => 'ms-file-jenis-buat'],
            ['nama' => 'ms-file-jenis-ubah'],
            ['nama' => 'ms-file-jenis-update'],
            ['nama' => 'ms-file-jenis-simpan'],
            ['nama' => 'ms-file-jenis-hapus'],
            ['nama' => 'ms-file-jenis-lihat'],

            ['nama' => 'ms-gudang-daftar'],
            ['nama' => 'ms-gudang-buat'],
            ['nama' => 'ms-gudang-ubah'],
            ['nama' => 'ms-gudang-update'],
            ['nama' => 'ms-gudang-simpan'],
            ['nama' => 'ms-gudang-hapus'],
            ['nama' => 'ms-gudang-lihat'],

            ['nama' => 'ms-halaman-daftar'],
            ['nama' => 'ms-halaman-buat'],
            ['nama' => 'ms-halaman-ubah'],
            ['nama' => 'ms-halaman-update'],
            ['nama' => 'ms-halaman-simpan'],
            ['nama' => 'ms-halaman-hapus'],
            ['nama' => 'ms-halaman-lihat'],

            ['nama' => 'ms-jabatan-daftar'],
            ['nama' => 'ms-jabatan-buat'],
            ['nama' => 'ms-jabatan-ubah'],
            ['nama' => 'ms-jabatan-update'],
            ['nama' => 'ms-jabatan-simpan'],
            ['nama' => 'ms-jabatan-hapus'],
            ['nama' => 'ms-jabatan-lihat'],

            ['nama' => 'ms-pegawai-daftar'],
            ['nama' => 'ms-pegawai-buat'],
            ['nama' => 'ms-pegawai-ubah'],
            ['nama' => 'ms-pegawai-update'],
            ['nama' => 'ms-pegawai-simpan'],
            ['nama' => 'ms-pegawai-hapus'],
            ['nama' => 'ms-pegawai-lihat'],

            ['nama' => 'ms-tr-pesanan-penjualan-daftar'],
            ['nama' => 'ms-tr-pesanan-penjualan-buat'],
            ['nama' => 'ms-tr-pesanan-penjualan-ubah'],
            ['nama' => 'ms-tr-pesanan-penjualan-update'],
            ['nama' => 'ms-tr-pesanan-penjualan-simpan'],
            ['nama' => 'ms-tr-pesanan-penjualan-hapus'],
            ['nama' => 'ms-tr-pesanan-penjualan-lihat'],

        ];

        foreach ($halamanData as $data) {
            DB::table('ms_halaman')->insert([
                'id' => Str::uuid(),
                'nama' => $data['nama'],
                'nomor' => \App\Models\MsHalaman::max('nomor') ?? 0,
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
                'status' => 'aktif',
            ]);
        }
    }
}
