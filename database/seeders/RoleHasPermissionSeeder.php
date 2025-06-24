<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleHasPermissionSeeder extends Seeder
{
    public function run()
    {
        // Ambil id role dan permission dalam format [name => id]
        $roles = DB::table('roles')->pluck('id', 'name');
        $permissions = DB::table('permissions')->pluck('id', 'name');

        // Kosongkan dulu tabel pivot supaya gak duplikat
        DB::table('role_has_permissions')->truncate();

        $allPermissionIds = $permissions->values()->all();

        // Superadmin & developer dapat semua permission
        foreach (['superadmin', 'developer'] as $roleName) {
            foreach ($allPermissionIds as $permissionId) {
                DB::table('role_has_permissions')->insert([
                    'role_id' => $roles[$roleName],
                    'permission_id' => $permissionId,
                ]);
            }
        }

        // Admin dapat semua permission juga
        foreach ($allPermissionIds as $permissionId) {
            DB::table('role_has_permissions')->insert([
                'role_id' => $roles['admin'],
                'permission_id' => $permissionId,
            ]);
        }

        // Manager punya sebagian permission
        $managerPermissions = [
            'products-index',
            'products-create',
            'products-store',
            'products-edit',
            'products-update',
            'products-delete',
            'products-show',
            'roles-index',
            'roles-create',
            'roles-store',
            'roles-edit',
            'roles-update',
            'roles-delete',
            'roles-show',
            'permissions-index',
            'permissions-create',
            'permissions-store',
            'permissions-edit',
            'permissions-update',
            'permissions-delete',
            'permissions-show',
        ];

        foreach ($managerPermissions as $permName) {
            if (isset($permissions[$permName])) {
                DB::table('role_has_permissions')->insert([
                    'role_id' => $roles['manager'],
                    'permission_id' => $permissions[$permName],
                ]);
            }
        }

        // Supervisor hanya bisa akses penuh ke products
        $supervisorPermissions = [
            'products-index',
            'products-create',
            'products-store',
            'products-edit',
            'products-update',
            'products-delete',
            'products-show',
        ];

        foreach ($supervisorPermissions as $permName) {
            if (isset($permissions[$permName])) {
                DB::table('role_has_permissions')->insert([
                    'role_id' => $roles['supervisor'],
                    'permission_id' => $permissions[$permName],
                ]);
            }
        }

        // Head-office hanya akses index dan show semua resources
        $headOfficePermissions = [];
        foreach (['products', 'roles', 'permissions'] as $resource) {
            $headOfficePermissions[] = "{$resource}-index";
            $headOfficePermissions[] = "{$resource}-show";
        }

        foreach ($headOfficePermissions as $permName) {
            if (isset($permissions[$permName])) {
                DB::table('role_has_permissions')->insert([
                    'role_id' => $roles['head-office'],
                    'permission_id' => $permissions[$permName],
                ]);
            }
        }
    }
}
