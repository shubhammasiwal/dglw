<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => config('constants.ROLES.PORTAL_ADMIN')]);
        Role::create(['name' => config('constants.ROLES.ADMIN')]);
        Role::create(['name' => config('constants.ROLES.WELFARE_COMMISSIONER')]);
        Role::create(['name' => config('constants.ROLES.DATA_OPERATOR')]);
    }
}
