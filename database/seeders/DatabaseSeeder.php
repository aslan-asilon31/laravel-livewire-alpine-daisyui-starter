<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\EmployeeAccount;
use App\Models\Marketplace;
use App\Models\MetaProperty;
use App\Models\Product;
use App\Models\ProductCategoryFirst;
use App\Models\ProductCategorySecond;
use App\Models\ProductContent;
use App\Models\ProductContentDisplay;
use App\Models\ProductContentFeature;
use App\Models\ProductContentMarketplace;
use App\Models\ProductContentMeta;
use App\Models\ProductMeta;
use App\Models\ProductMetaGroup;
use App\Models\ProductContentQna;
use App\Models\ProductContentReview;
use App\Models\ProductContentSpecification;
use App\Models\ProductContentVideo;
use App\Models\User;

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
      PositionSeeder::class,
      PageSeeder::class,
      // ActionSeeder::class,
      PermissionSeeder::class,
      MetaPropertyGroupSeeder::class,
      MetaPropertySeeder::class,
      MarketplaceSeeder::class,
    ]);

    $employee = Employee::create([
      'position_id' => 'developer',
      'name' => 'Full Stack Developer',
      'phone' => '+6281380912181',
      'email' => 'developer@system',
      'created_by' => 'system',
      'updated_by' => 'system',
      'created_at' => now(),
      'updated_at' => now(),
      'is_activated' => true,
    ]);

    EmployeeAccount::create([
      'employee_id' => $employee->id,
      'username' => 'developer@system',
      'password' => bcrypt('123123123'),
      'created_by' => 'system',
      'updated_by' => 'system',
      'created_at' => now(),
      'updated_at' => now(),
      'is_activated' => true,
    ]);

    // Employee::factory(100)->create();
    // ProductCategorySecond::factory(50)->create();
    // Marketplace::factory(5)->create();

    // ProductCategoryFirst::factory(100)
    //   ->has(
    //     Product::factory(5)
    //       ->has(
    //         ProductContent::factory(1)
    //           ->has(ProductContentMarketplace::factory(4))
    //           ->has(ProductContentDisplay::factory(rand(4, 10)))
    //           ->has(ProductContentSpecification::factory(rand(5, 10)))
    //           ->has(ProductContentVideo::factory(rand(1, 5)))
    //           ->has(ProductContentFeature::factory(rand(4, 10)))
    //           ->has(ProductContentQna::factory(rand(5, 10)))
    //           ->has(ProductContentReview::factory(rand(5, 10)))
    //       )
    //   )
    //   ->create();

    // $this->call([
    //   ProductContentMetaSeeder::class,
    // ]);
  }
}
