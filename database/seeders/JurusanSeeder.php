<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramStudi;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id_s1 = ProgramStudi::where('name', 'S1')->first();
        $jurusans = [
            [
                'name' => 'Teknik Komputer',
                'program_studi_id' => $id_s1->id
            ],
            [
                'name' => 'Informatika',
                'program_studi_id' => $id_s1->id
            ],
            [
                'name' => 'Sistem Informasi',
                'program_studi_id' => $id_s1->id
            ],
            [
                'name' => 'Teknologi Informasi',
                'program_studi_id' => $id_s1->id
            ],
        ];
        for ($i = 0; $i < count($jurusans); $i++) {
            Jurusan::create($jurusans[$i]);
        }
    }
}
