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
                'username' => 'Administrator',
                'password' => Hash::make('password'),
                'name' => 'ADMIN',
                'level' => 'Admin'
            ]
        ];
        for ($i = 0; $i < count($users); $i++) {
            User::create($users[$i]);
        }
    }
}
