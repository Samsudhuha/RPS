<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'username' => '0002106801',
                'password' => Hash::make('password'),
                'name' => 'Ir. Siti Rochimah, MT.,Ph.D.',
            ],
            [
                'username' => '0023117409',
                'password' => Hash::make('password'),
                'name' => 'Daniel O. Siahaan, S.Kom. M,Sc, PD.Eng.',
            ],
            [
                'username' => '0009087602',
                'password' => Hash::make('password'),
                'name' => 'Sarwosri, S.Kom. M.T',
            ],
            [
                'username' => '0026067903',
                'password' => Hash::make('password'),
                'name' => 'Dr. Umi Laili Yuhana S.Kom., M.Sc.',
            ],
            [
                'username' => '0003018703',
                'password' => Hash::make('password'),
                'name' => 'Rizky Januar Akbar, S.Kom., M.Eng.',
            ],
            [
                'username' => '0020127508',
                'password' => Hash::make('password'),
                'name' => 'Dr. Eng. Chastine Fatichah, S.Kom., M.Kom.',
            ],
        ];
        for ($i = 0; $i < count($users); $i++) {
            User::create($users[$i]);
        }
    }
}
