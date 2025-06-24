<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelHasRolesSeeder extends Seeder
{
    public function run()
    {
        $modelType = 'App\Models\User';

        $roles = DB::table('roles')->pluck('id', 'name');

        $userRoleAssignments = [
            1 => 'superadmin',
            2 => 'admin',
            3 => 'manager',
            4 => 'supervisor',
            5 => 'head-office',
        ];

        DB::table('model_has_roles')->truncate();

        foreach ($userRoleAssignments as $userId => $roleName) {
            if (isset($roles[$roleName])) {
                DB::table('model_has_roles')->insert([
                    'role_id' => $roles[$roleName],
                    'model_type' => $modelType,
                    'model_id' => $userId,
                ]);
            }
        }
    }
}
