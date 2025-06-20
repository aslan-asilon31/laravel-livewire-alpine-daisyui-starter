<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TrPesananPenjualanDetailSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            $header = DB::table('tr_pemesanan_penjualan_header')->inRandomOrder()->first();
            $barang = DB::table('ms_barang')->inRandomOrder()->first();

            if ($header && $barang) {
                DB::table('tr_pemesanan_penjualan_detail')->insert([
                    'id' => Str::uuid(),
                    'tr_pemesanan_penjualan_header_id' => $header->id,  // ID header pesanan
                    'ms_barang_id' => $barang->id,
                    'catatan' => 'Detail pesanan untuk barang ' . $barang->nama,
                    'qty' => rand(1, 10),
                    'dibuat_oleh' => 'admin',
                    'diupdate_oleh' => 'admin',
                    'tgl_dibuat' => Carbon::now(),
                    'tgl_diupdate' => Carbon::now(),
                ]);
            }
        }
    }
}
