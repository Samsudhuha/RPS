<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Kalab;
use App\Models\Rmk;
use App\Models\User;
use Illuminate\Database\Seeder;


class KalabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_sr = User::where('name', 'Ir. Siti Rochimah, MT.,Ph.D.')->first();
        $rmk_rpl = Rmk::where('name', 'Rekayasa Perangkat Lunak')->first();

        $dosens = [
            [
                'dosen_id' => $user_sr->id,
                'rmk_id' => $rmk_rpl->id
            ],
        ];
        for ($i = 0; $i < count($dosens); $i++) {
            Kalab::create($dosens[$i]);
        }
    }
}
