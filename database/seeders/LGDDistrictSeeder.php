<?php

namespace Database\Seeders;

use App\Models\LGDDistrict;
use App\Models\LGDState;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LGDDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the table before inserting
        LGDDistrict::truncate();

        $path = storage_path('app/private/lgd_districts.xlsx');
        $rows = Excel::toArray([], $path)[0];

        // Skip header row, start from 1 if first row is header
        foreach (array_slice($rows, 1) as $row) {
            LGDDistrict::create([
                'state_code' => $row[1],
                'state_name' => $row[2],
                'district_lgd_code' => $row[3],
                'district_name_en' => $row[4],
                'district_name_local' => $row[5],
                'hierarchy' => $row[6],
                'district_short_name' => $row[7],
            ]);
        }
    }
}
