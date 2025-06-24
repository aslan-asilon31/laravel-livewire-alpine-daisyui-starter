<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $resources = ['products', 'roles', 'permissions'];
        $actions = ['index', 'create', 'store', 'edit', 'update', 'delete', 'show'];

        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                DB::table('permissions')->updateOrInsert(
                    ['name' => "{$resource}-{$action}", 'guard_name' => 'web'],
                    ['created_at' => now(), 'updated_at' => now()]
                );
            }
        }
    }
}
