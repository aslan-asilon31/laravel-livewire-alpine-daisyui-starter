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
      BedTypesTableSeeder::class,
      FeaturesTableSeeder::class,
      RoomsTableSeeder::class,
      RoomClassesTableSeeder::class,
      RoomClassBedFeaturesTableSeeder::class,
      FloorsTableSeeder::class,
      RoomClassBedTypesTableSeeder::class,
      PaymentStatusesTableSeeder::class,
      RolesTableSeeder::class,
      PermissionsTableSeeder::class,
      RoleHasPermissionSeeder::class,
      ModelHasRolesSeeder::class,
      RoomStatusesTableSeeder::class,
      BookingsTableSeeder::class,
      AddonsTableSeeder::class,
      BookingAddonsTableSeeder::class,
      BookingRoomsTableSeeder::class,
      RoomsTableSeeder::class,

    ]);
  }
}
