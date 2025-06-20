<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\EmployeeAccount;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
      MsCabangSeeder::class,
      MsPegawaiSeeder::class,
      MsPegawaiAkunSeeder::class,
      MsJabatanSeeder::class,
      MsBarangSeeder::class,
      MsGudangSeeder::class,
      MsPelangganSeeder::class,
      MsStatusSeeder::class,
      HakAksesGrupSeeder::class,

      HakAksesJabatanSeeder::class,
      HakAksesJabatanStatusSeeder::class,
      HakAksesPegawaiCabangSeeder::class,
      TrPesananPenjualanHeaderSeeder::class,
      TrPesananPenjualanDetailSeeder::class,

    ]);
  }
}
