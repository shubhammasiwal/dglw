<?php

namespace Database\Seeders;

use App\Models\LGDState;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LGDStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $path = storage_path('app/private/lgd_states.xlsx');
        $rows = Excel::toArray([], $path)[0];

        // Skip header row, start from 1 if first row is header
        foreach (array_slice($rows, 1) as $row) {
            LGDState::create([
                'l_g_d_code' => $row[1],
                'name_en' => $row[2],
                'name_local' => $row[3],
                'type' => (strtolower($row[4]) === config('constants.LGD_STATE_TYPES.STATE')) 
                    ? config('constants.LGD_STATE_TYPES.STATE')
                    : config('constants.LGD_STATE_TYPES.UNION_TERRITORY'),
            ]);
        }
    }
}
