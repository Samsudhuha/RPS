<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataKuliah;
use App\Models\Rmk;
use App\Models\Jurusan;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rpl =  Rmk::where('name', 'Rekayasa Perangkat Lunak')->first();
        $kbj =  Rmk::where('name', 'Komputasi Berbasis Jaringan')->first();
        $kcv =  Rmk::where('name', 'Komputasi Cerdas Visi')->first();
        $ajk =  Rmk::where('name', 'Arsitektur dan Jaringan Komputer')->first();
        $giga =  Rmk::where('name', 'Grafika, Interaksi dan Game')->first();
        $ap =  Rmk::where('name', 'Algoritma Pemrograman')->first();
        $mci =  Rmk::where('name', 'Manajemen Cerdas Informasi')->first();
        $pkt =  Rmk::where('name', 'Pemodelan dan Komputasi Terapan')->first();
        $jurusan_tc = Jurusan::where('name', 'Informatika')->first();
        $rmks = [
            [
                'rmk_id' => $rpl->id,
                'jurusan_id' => $jurusan_tc->id,
                'kode' => 'IF184971',
                'name' => 'Arsitektur Perangkat Lunak',
                'bobot' => '3',
                'semester' => '8',
            ],
            [
                'rmk_id' => $rpl->id,
                'jurusan_id' => $jurusan_tc->id,
                'kode' => 'IF184972',
                'name' => 'Penjaminan Mutu Perangkat Lunak',
                'bobot' => '3',
                'semester' => '6',
            ],
            [
                'rmk_id' => $kbj->id,
                'jurusan_id' => $jurusan_tc->id,
                'kode' => 'IF184941',
                'name' => 'Jaringan Multimedia',
                'bobot' => '3',
                'semester' => '6',
            ],
            [
                'rmk_id' => $kbj->id,
                'jurusan_id' => $jurusan_tc->id,
                'kode' => 'IF184942',
                'name' => 'Komputasi Awan',
                'bobot' => '3',
                'semester' => '7',
            ],
            [
                'rmk_id' => $kcv->id,
                'jurusan_id' => $jurusan_tc->id,
                'kode' => 'IF184952',
                'name' => 'Pengolahan Citra Digital',
                'bobot' => '3',
                'semester' => '7',
            ],
            [
                'rmk_id' => $kcv->id,
                'jurusan_id' => $jurusan_tc->id,
                'kode' => 'IF184951',
                'name' => 'Data Mining',
                'bobot' => '3',
                'semester' => '8',
            ],
            [
                'rmk_id' => $ajk->id,
                'jurusan_id' => $jurusan_tc->id,
                'kode' => 'IF184911',
                'name' => 'Jaringan Nirkabel',
                'bobot' => '3',
                'semester' => '7',
            ],
            [
                'rmk_id' => $ajk->id,
                'jurusan_id' => $jurusan_tc->id,
                'kode' => 'IF184912',
                'name' => 'Teknologi antar Jaringan',
                'bobot' => '3',
                'semester' => '7',
            ],
            [
                'rmk_id' => $giga->id,
                'jurusan_id' => $jurusan_tc->id,
                'kode' => 'IF184933',
                'name' => 'Sistem Game',
                'bobot' => '3',
                'semester' => '6',
            ],
            [
                'rmk_id' => $giga->id,
                'jurusan_id' => $jurusan_tc->id,
                'kode' => 'IF184931',
                'name' => 'Teknik Pengembangan Game',
                'bobot' => '3',
                'semester' => '7',
            ],
            [
                'rmk_id' => $ap->id,
                'jurusan_id' => $jurusan_tc->id,
                'kode' => 'IF184901',
                'name' => 'Pemorgraman Perangkat Bergerak',
                'bobot' => '3',
                'semester' => '6',
            ],
            [
                'rmk_id' => $ap->id,
                'jurusan_id' => $jurusan_tc->id,
                'kode' => 'IF184902',
                'name' => 'Pengembangan Analisis Algoritma',
                'bobot' => '3',
                'semester' => '6',
            ],
            [
                'rmk_id' => $mci->id,
                'jurusan_id' => $jurusan_tc->id,
                'kode' => 'IF184961',
                'name' => 'Sistem Enterprise',
                'bobot' => '3',
                'semester' => '7',
            ],
            [
                'rmk_id' => $mci->id,
                'jurusan_id' => $jurusan_tc->id,
                'kode' => 'IF184965',
                'name' => 'Basis Data Terdistribusi',
                'bobot' => '3',
                'semester' => '7',
            ],
            [
                'rmk_id' => $pkt->id,
                'jurusan_id' => $jurusan_tc->id,
                'kode' => 'IF180000',
                'name' => 'Pemodelan dan Simulasi',
                'bobot' => '3',
                'semester' => '7',
            ],
            [
                'rmk_id' => $pkt->id,
                'jurusan_id' => $jurusan_tc->id,
                'kode' => 'IF180001',
                'name' => 'Terapan Komputasi',
                'bobot' => '3',
                'semester' => '7',
            ],
        ];
        for ($i = 0; $i < count($rmks); $i++) {
            MataKuliah::create($rmks[$i]);
        }
    }
}
