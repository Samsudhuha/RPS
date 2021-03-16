<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rmk;
use App\Models\Jurusan;

class RmkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurusan_informatika =  Jurusan::where('name', 'Informatika')->first();
        $rmks = [
            [
                'name' => 'Rekayasa Perangkat Lunak',
                'jurusan_id' => $jurusan_informatika->id
            ],
            [
                'name' => 'Komputasi Berbasis Jaringan',
                'jurusan_id' => $jurusan_informatika->id
            ],
            [
                'name' => 'Komputasi Cerdas Visi',
                'jurusan_id' => $jurusan_informatika->id
            ],
            [
                'name' => 'Arsitektur dan Jaringan Komputer',
                'jurusan_id' => $jurusan_informatika->id
            ],
            [
                'name' => 'Grafika, Interaksi dan Game',
                'jurusan_id' => $jurusan_informatika->id
            ],
            [
                'name' => 'Algoritma Pemrograman',
                'jurusan_id' => $jurusan_informatika->id
            ],
            [
                'name' => 'Manajemen Cerdas Informasi',
                'jurusan_id' => $jurusan_informatika->id
            ],
            [
                'name' => 'Pemodelan dan Komputasi Terapan',
                'jurusan_id' => $jurusan_informatika->id
            ],
        ];
        for ($i = 0; $i < count($rmks); $i++) {
            Rmk::create($rmks[$i]);
        }
    }
}
