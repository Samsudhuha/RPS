<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Jurusan;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_dn = User::where('name', 'Daniel O. Siahaan, S.Kom. M,Sc, PD.Eng.')->first();
        $user_sw = User::where('name', 'Sarwosri, S.Kom. M.T')->first();
        $user_rj = User::where('name', 'Rizky Januar Akbar, S.Kom., M.Eng.')->first();
        $user_sr = User::where('name', 'Ir. Siti Rochimah, MT.,Ph.D.')->first();
        $user_ul = User::where('name', 'Dr. Umi Laili Yuhana S.Kom., M.Sc.')->first();
        $user_cf = User::where('name', 'Dr. Eng. Chastine Fatichah, S.Kom., M.Kom.')->first();
        $jurusan_tc = Jurusan::where('name', 'Informatika')->first();

        $dosens = [
            [
                'id' => $user_dn->id,
                'jurusan_id' => $jurusan_tc->id
            ],
            [
                'id' => $user_sw->id,
                'jurusan_id' => $jurusan_tc->id
            ],
            [
                'id' => $user_rj->id,
                'jurusan_id' => $jurusan_tc->id
            ],
            [
                'id' => $user_sr->id,
                'jurusan_id' => $jurusan_tc->id
            ],
            [
                'id' => $user_ul->id,
                'jurusan_id' => $jurusan_tc->id
            ],
            [
                'id' => $user_cf->id,
                'jurusan_id' => $jurusan_tc->id
            ],
        ];
        for ($i = 0; $i < count($dosens); $i++) {
            Dosen::create($dosens[$i]);
        }
    }
}
