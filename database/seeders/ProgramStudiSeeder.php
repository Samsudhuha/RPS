<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramStudi;

class ProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $program_studis = [
            [
                'name' => 'D1',
            ],
            [
                'name' => 'D2',
            ],
            [
                'name' => 'D3',
            ],
            [
                'name' => 'D4',
            ],
            [
                'name' => 'S1',
            ],
            [
                'name' => 'S2',
            ],
            [
                'name' => 'S3',
            ],
        ];

        for ($i = 0; $i < count($program_studis); $i++) {
            ProgramStudi::create($program_studis[$i]);
        }
    }
}
