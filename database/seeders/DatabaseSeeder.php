<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\CodeDirectorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /**
         * Seed initial users for the application with predefined names and emails.
         * All users are created with the password 'Admin@123', securely hashed using Laravel's Hash facade.
         * These users provide initial administrative and operational access to the application.
         */
        try {
            // Creating roles at the very beginning
            $this->call(RoleSeeder::class);
            $this->call(PermissionSeeder::class);

            User::truncate();

            $portal_admin = User::factory()->create([
                'name' => 'Portal Admin NIC',
                'email' => 'portaladminnic@dummy.com',
                'password' => Hash::make('Admin@123'),
            ]);
            $portal_admin->assignRole('portal_admin');

            $admin = User::factory()->create([
                'name' => 'Admin NIC',
                'email' => 'adminnic@dummy.com',
                'password' => Hash::make('Admin@123'),
            ]);
            $admin->assignRole('admin');

            $welfare_commissioner = User::factory()->create([
                'name' => 'Welfare Commissioner NIC',
                'email' => 'welfarecommissionernic@dummy.com',
                'password' => Hash::make('Admin@123'),
            ]);
            $welfare_commissioner->assignRole('welfare_commissioner');

            $data_operator = User::factory()->create([
                'name' => 'Data Operator NIC',
                'email' => 'dataoperatornic@dummy.com',
                'password' => Hash::make('Admin@123'),
            ]);
            $data_operator->assignRole('data_operator');

            $this->call(LGDStateSeeder::class);
            $this->call(LGDDistrictSeeder::class);
            $this->call(CodeDirectorySeeder::class);

        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            exit;
        }
    }
}
