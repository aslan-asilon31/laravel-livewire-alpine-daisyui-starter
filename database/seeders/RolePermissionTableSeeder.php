<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionTableSeeder extends Seeder
{
    public function run()
    {
        // Insert roles, jangan insert id manual
        $roles = [
            ['name' => 'admin', 'guard_name' => 'web'],
            ['name' => 'superadmin', 'guard_name' => 'web'],
            ['name' => 'developer', 'guard_name' => 'web'],
            ['name' => 'manager', 'guard_name' => 'web'],
            ['name' => 'supervisor', 'guard_name' => 'web'],
            ['name' => 'head-office', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['name' => $role['name']],
                ['guard_name' => $role['guard_name'], 'created_at' => now(), 'updated_at' => now()]
            );
        }

        // Insert permissions
        $resources = ['products', 'roles', 'permissions'];
        $actions = ['index', 'create', 'store', 'edit', 'update', 'delete', 'show'];

        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                $permissionName = $resource . '-' . $action;
                DB::table('permissions')->updateOrInsert(
                    ['name' => $permissionName],
                    ['guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]
                );
            }
        }

        // Ambil roles dan permissions (id integer)
        $roles = DB::table('roles')->pluck('id', 'name');
        $permissions = DB::table('permissions')->pluck('id', 'name');

        // Assign permission ke role superadmin & developer (semua permission)
        $allPermissions = $permissions->values()->all();

        foreach (['superadmin', 'developer', 'admin'] as $roleName) {
            foreach ($allPermissions as $permissionId) {
                DB::table('role_permission')->updateOrInsert([
                    'role_id' => $roles[$roleName],
                    'permission_id' => $permissionId,
                ]);
            }
        }

        // Contoh assign sebagian permission ke manager (sesuaikan daftar permission)
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
                DB::table('role_permission')->updateOrInsert([
                    'role_id' => $roles['manager'],
                    'permission_id' => $permissions[$permName],
                ]);
            }
        }

        // Supervisor hanya akses manage produk
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
                DB::table('role_permission')->updateOrInsert([
                    'role_id' => $roles['supervisor'],
                    'permission_id' => $permissions[$permName],
                ]);
            }
        }

        // Head-office hanya akses index dan show
        $headOfficePermissions = [];
        foreach (['products', 'roles', 'permissions'] as $resource) {
            $headOfficePermissions[] = "{$resource}-index";
            $headOfficePermissions[] = "{$resource}-show";
        }

        foreach ($headOfficePermissions as $permName) {
            if (isset($permissions[$permName])) {
                DB::table('role_permission')->updateOrInsert([
                    'role_id' => $roles['head-office'],
                    'permission_id' => $permissions[$permName],
                ]);
            }
        }
    }
}
