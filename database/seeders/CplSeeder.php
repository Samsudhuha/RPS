<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cpl;
use App\Models\Jurusan;

class CplSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurusan_tc = Jurusan::where('name', 'Informatika')->first();

        $data = [
            [
                'name' => 'Mampu mengembangkan aplikasi dengan menerapkan prinsip-prinsip sistem cerdas dan ilmu komputasi untuk menghasilkan aplikasi cerdas pada berbagai bidang dan disiplin keilmuan',
                'jurusan_id' => $jurusan_tc->id,
                'no' => 1
            ],
            [
                'name' => 'Mampu mengembangkan konsep arisitektur jaringan dan prinsip komputasi berbasis jaringan yang mempunyai kinerja tinggi dan aman',
                'jurusan_id' => $jurusan_tc->id,
                'no' => 2
            ],
            [
                'name' => 'Mampu memodelkan, menganalisa, dan mengembangkan perangkat lunak yang berkualitas baik secara teknis dan manajerial dengan menggunakan prinsip-prinsip proses rekayasa perangkat lunak',
                'jurusan_id' => $jurusan_tc->id,
                'no' => 3
            ],
            [
                'name' => 'Mampu memodelkan, menganalisa, dan mengembangkan aplikasi menggunakan prinsip-prinsip grafika komputer serta interaksi manusia dan komputer',
                'jurusan_id' => $jurusan_tc->id,
                'no' => 4
            ],
            [
                'name' => 'Mampu memodelkan, menganalisa dan mengembangkan penyelesaian persoalan komputasi dan pemodelan matematis melalui pendekatan eksak, numerik, dan probabilistik secara efektif dan efisien',
                'jurusan_id' => $jurusan_tc->id,
                'no' => 5
            ],
            [
                'name' => 'Mampu mengembangkan metode untuk mengelola data dan informasi dalam berbagai bentuk format',
                'jurusan_id' => $jurusan_tc->id,
                'no' => 6
            ],
            [
                'name' => 'Mampu memodelkan, menganalisa dan mengembangkan algoritma untuk menyelesaikan permasalahan komputasi secara efektif dan efisien',
                'jurusan_id' => $jurusan_tc->id,
                'no' => 7
            ],
            [
                'name' => 'Menginternalisasi nilai, norma, dan etika akademik serta menunjukkan sikap bertanggungjawab atas pekerjaan di bidang keahliannya secara mandiri',
                'jurusan_id' => $jurusan_tc->id,
                'no' => 8
            ],
            [
                'name' => 'Mampu bekerja dan berkomunikasi secara efektif baik secara individu maupun dalam kelompok',
                'jurusan_id' => $jurusan_tc->id,
                'no' => 9
            ],
            [
                'name' => 'Mampu mengembangkan pemikiran logis, kritis, sistematis, dan kreatif melalui penelitian ilmiah dalam bidang ilmu pengetahuan dan teknologi berdasarkan kaidah, tata cara, dan etika ilmiah dalam bentuk tesis serta makalah yang telah diterbitkan di seminar atau jurnal ilmiah baik level nasional maupun internasional',
                'jurusan_id' => $jurusan_tc->id,
                'no' => 10
            ],
        ];
        for ($i = 0; $i < count($data); $i++) {
            Cpl::create($data[$i]);
        }
    }
}
