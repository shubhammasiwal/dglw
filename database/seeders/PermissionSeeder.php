<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $permissions = [
            'user create', 'user edit', 'user delete', 'user view',
            'role create', 'role edit', 'role delete', 'role view',
            'worker create', 'worker edit', 'worker delete', 'worker view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $portalAdmin = Role::where('name', 'portal_admin')->first();
        $admin = Role::where('name', 'admin')->first();
        $welfareCommissioner = Role::where('name', 'welfare_commissioner')->first();
        $dataOperator = Role::where('name', 'data_operator')->first();

        // Example: All permissions to portal_admin
        $portalAdmin->syncPermissions($permissions);

        // Assign subset to other roles as needed
        $admin->syncPermissions($permissions);
        $welfareCommissioner->syncPermissions(['worker create', 'worker edit', 'worker delete', 'worker view']);
        $dataOperator->syncPermissions(['worker view']);
    }
}
