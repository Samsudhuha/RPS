<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Kaprodi;
use App\Models\User;
use Illuminate\Database\Seeder;

class KaprodiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_sr = User::where('name', 'Dr. Eng. Chastine Fatichah, S.Kom., M.Kom.')->first();
        $jurusan_tc = Jurusan::where('name', 'Informatika')->first();

        $dosens = [
            [
                'dosen_id' => $user_sr->id,
                'jurusan_id' => $jurusan_tc->id
            ],
        ];
        for ($i = 0; $i < count($dosens); $i++) {
            Kaprodi::create($dosens[$i]);
        }
    }
}
