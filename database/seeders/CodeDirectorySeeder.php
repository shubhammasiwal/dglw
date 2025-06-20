<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CodeDirectory;
use App\Models\Gender;
use App\Models\WorkerType;
use App\Models\SocialCategory;
use App\Models\MaritalStatus;

class CodeDirectorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed worker_types
        $workerTypes = [
            ['code' => 'BEEDI', 'name' => 'Beedi', 'table_name' => 'worker_types'],
            ['code' => 'CINE', 'name' => 'Cine', 'table_name' => 'worker_types'],
            ['code' => 'NON_COAL_MINE', 'name' => 'Non-Coal Mine', 'table_name' => 'worker_types'],
        ];

        foreach ($workerTypes as $item) {
            $directory = CodeDirectory::create($item);
            WorkerType::create([
                'name' => $item['name'],
                'code_directory_id' => $directory->id,
            ]);
        }

        // Seed genders
        $genders = [
            ['code' => 'M', 'name' => 'Male', 'table_name' => 'genders'],
            ['code' => 'F', 'name' => 'Female', 'table_name' => 'genders'],
            ['code' => 'O', 'name' => 'Others', 'table_name' => 'genders'],
        ];

        foreach ($genders as $item) {
            $directory = CodeDirectory::create($item);
            Gender::create([
                'name' => $item['name'],
                'code_directory_id' => $directory->id,
            ]);
        }

        // Seed marital_statuses
        $maritalStatuses = [
            ['code' => '1', 'name' => 'Never Married', 'table_name' => 'marital_statuses'],
            ['code' => '2', 'name' => 'Married', 'table_name' => 'marital_statuses'],
            ['code' => '3', 'name' => 'Widowed', 'table_name' => 'marital_statuses'],
            ['code' => '4', 'name' => 'Divorced/Seperated', 'table_name' => 'marital_statuses'],
        ];

        foreach ($maritalStatuses as $item) {
            $directory = CodeDirectory::create($item);
            MaritalStatus::create([
                'name' => $item['name'],
                'code_directory_id' => $directory->id,
            ]);
        }

        // Seed social_categories
        $socialCategories = [
            ['code' => 'ST', 'name' => 'ST', 'table_name' => 'social_categories'],
            ['code' => 'SC', 'name' => 'SC', 'table_name' => 'social_categories'],
            ['code' => 'OBC', 'name' => 'OBC', 'table_name' => 'social_categories'],
            ['code' => 'General/Others', 'name' => 'General/Others', 'table_name' => 'social_categories'],
        ];

        foreach ($socialCategories as $item) {
            $directory = CodeDirectory::create($item);
            SocialCategory::create([
                'name' => $item['name'],
                'code_directory_id' => $directory->id,
            ]);
        }
    }
}
