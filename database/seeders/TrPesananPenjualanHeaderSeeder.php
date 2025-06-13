<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TrPesananPenjualanHeaderSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            $cabang = DB::table('ms_cabang')->inRandomOrder()->first();
            $pelanggan = DB::table('ms_pelanggan')->inRandomOrder()->first();

            if ($cabang && $pelanggan) {
                DB::table('tr_pemesanan_penjualan_header')->insert([
                    'id' => Str::uuid(),
                    'ms_cabang_id' => $cabang->id,
                    'ms_pelanggan_id' => $pelanggan->id,
                    'nama' => 'Pesanan Penjualan ' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                    'nomor' => $i + 1,
                    'memo' => 'Pesanan ke-' . ($i + 1) . ' untuk pelanggan ' . $pelanggan->nama,
                    'dibuat_oleh' => 'admin',
                    'diupdate_oleh' => 'admin',
                    'tgl_dibuat' => Carbon::now(),
                    'tgl_diupdate' => Carbon::now(),
                    'status' => 'aktif',
                ]);
            }
        }
    }
}
