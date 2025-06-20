<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HakAksesSeeder extends Seeder
{
    public function run()
    {
        $halamanData = [

            ['nama' => 'dashboard-lihat'],

            ['nama' => 'ms_barang-daftar'],
            ['nama' => 'ms_barang-buat'],
            ['nama' => 'ms_barang-edit'],
            ['nama' => 'ms_barang-update'],
            ['nama' => 'ms_barang-simpan'],
            ['nama' => 'ms_barang-hapus'],
            ['nama' => 'ms_barang-lihat'],

            ['nama' => 'ms_cabang-daftar'],
            ['nama' => 'ms_cabang-buat'],
            ['nama' => 'ms_cabang-edit'],
            ['nama' => 'ms_cabang-update'],
            ['nama' => 'ms_cabang-simpan'],
            ['nama' => 'ms_cabang-hapus'],
            ['nama' => 'ms_cabang-lihat'],

            ['nama' => 'ms_file-daftar'],
            ['nama' => 'ms_file-buat'],
            ['nama' => 'ms_file-edit'],
            ['nama' => 'ms_file-update'],
            ['nama' => 'ms_file-simpan'],
            ['nama' => 'ms_file-hapus'],
            ['nama' => 'ms_file-lihat'],

            ['nama' => 'ms_file_jenis-daftar'],
            ['nama' => 'ms_file_jenis-buat'],
            ['nama' => 'ms_file_jenis-edit'],
            ['nama' => 'ms_file_jenis-update'],
            ['nama' => 'ms_file_jenis-simpan'],
            ['nama' => 'ms_file_jenis-hapus'],
            ['nama' => 'ms_file_jenis-lihat'],

            ['nama' => 'ms_gudang-daftar'],
            ['nama' => 'ms_gudang-buat'],
            ['nama' => 'ms_gudang-edit'],
            ['nama' => 'ms_gudang-update'],
            ['nama' => 'ms_gudang-simpan'],
            ['nama' => 'ms_gudang-hapus'],
            ['nama' => 'ms_gudang-lihat'],

            ['nama' => 'ms_hak_akses-daftar'],
            ['nama' => 'ms_hak_akses-buat'],
            ['nama' => 'ms_hak_akses-edit'],
            ['nama' => 'ms_hak_akses-update'],
            ['nama' => 'ms_hak_akses-simpan'],
            ['nama' => 'ms_hak_akses-hapus'],
            ['nama' => 'ms_hak_akses-lihat'],

            ['nama' => 'ms_jabatan-daftar'],
            ['nama' => 'ms_jabatan-buat'],
            ['nama' => 'ms_jabatan-edit'],
            ['nama' => 'ms_jabatan-update'],
            ['nama' => 'ms_jabatan-simpan'],
            ['nama' => 'ms_jabatan-hapus'],
            ['nama' => 'ms_jabatan-lihat'],

            ['nama' => 'ms_pegawai-daftar'],
            ['nama' => 'ms_pegawai-buat'],
            ['nama' => 'ms_pegawai-edit'],
            ['nama' => 'ms_pegawai-update'],
            ['nama' => 'ms_pegawai-simpan'],
            ['nama' => 'ms_pegawai-hapus'],
            ['nama' => 'ms_pegawai-lihat'],

            ['nama' => 'tr_pesanan_penjualan-daftar'],
            ['nama' => 'tr_pesanan_penjualan-buat'],
            ['nama' => 'tr_pesanan_penjualan-edit'],
            ['nama' => 'tr_pesanan_penjualan-update'],
            ['nama' => 'tr_pesanan_penjualan-simpan'],
            ['nama' => 'tr_pesanan_penjualan-hapus'],
            ['nama' => 'tr_pesanan_penjualan-lihat'],

        ];

        $hakAksesGrup = DB::table('hak_akses_grup')->pluck('id')->toArray();

        foreach ($halamanData as $data) {
            DB::table('hak_akses')->insert([
                'id' => Str::uuid(),
                'hak_akses_grup_id' => $hakAksesGrup[array_rand($hakAksesGrup)],
                'nama' => $data['nama'],
                'dibuat_oleh' => 'admin',
                'diupdate_oleh' => 'admin',
                'tgl_dibuat' => Carbon::now(),
                'tgl_diupdate' => Carbon::now(),
            ]);
        }
    }
}
