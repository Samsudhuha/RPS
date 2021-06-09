<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<style>
    html {
        margin-top: 50px;
    }

    th,
    td {
        font-size: 9pt;
    }

    .page-break {
        page-break-after: always;
    }
</style>

<body>
    <table width="100%" class="table table-bordered">
        <tr class="font-weight-bold text-center" style="background-color: #deeaf6;">
            <td><img src="{{ public_path($perguruan_tinggi->logo) }}" alt="logo" height=100 width=100></td>
            <td colspan="6">
                {{ $perguruan_tinggi->name }}
                <br>
                {{ $fakultas["name"] }}
                <br>
                Departemen {{ $mata_kuliah["jurusan"]["name"] }}
            </td>
            <td>Kode Surat</td>
        </tr>
        <tr>
            <td colspan="8" class="text-center" style="background-color: #deeaf6;">
                <p class="font-weight-bold">Rencana Pembelajaran Semester</p>
            </td>
        </tr>
        <tr class="font-weight-bold bg-light">
            <td colspan="2">Mata Kuliah (MK)</td>
            <td>KODE</td>
            <td>Rumpun MK</td>
            <td colspan="2">BOBOT (sks)</td>
            <td>SEMESTER</td>
            <td>Tanggal Penyusunan</td>
        </tr>
        <tr>
            <td colspan="2" class="font-weight-bold" width="25%">{{ $mata_kuliah["name"] }}</td>
            <td width="12.5%">{{ $mata_kuliah["kode"] }}</td>
            <td width="12.5%">{{ $mata_kuliah["rmk"]["name"] }}</td>
            <td width="12.5%">{{ $mata_kuliah["bobot"] }}</td>
            <td width="12.5%"></td>
            <td width="12.5%">{{ $mata_kuliah["semester"] }}</td>
            <td width="12.5%">{{ $mata_kuliah["waktu"] }}</td>
        </tr>
        <tr class="font-weight-bold">
            <td colspan="2" rowspan="2">OTORISASI atau PENGESAHAN</td>
            <td colspan="2" class="bg-light">Dosen Pengembang RPS</td>
            <td colspan="2" class="bg-light">Koordinator RMK</td>
            <td colspan="2" class="bg-light">Ka PRODI</td>
        </tr>
        <tr>
            <td colspan="2">
                <br>
                <br>
                <br>
                {{ $mata_kuliah["dosen"][0] }}
            </td>
            <td colspan="2">
                <br>
                <br>
                <br>
                {{ $mata_kuliah["kalabs"] }}
            </td>
            <td colspan="2">
                <br>
                <br>
                <br>
                {{ $mata_kuliah["kaprodi"] }}
            </td>
        </tr>
        <tr class="font-weight-bold">
            <td rowspan="{{ $mata_kuliah['count_cpl_cpmk'] }}">Capaian Pembelajaran</td>
            <td colspan="7" class="bg-light">CPL-Prodi yang dibebankan pada MK</td>
        </tr>
        @foreach($cpls_array as $cpl)
        @if(in_array($cpl['id'], $mata_kuliah["cpl_matakuliahs"]))
        <tr>
            <td colspan="2">CPL {{ $cpl['no'] }}</td>
            <td colspan="5">{{ $cpl['name'] }}</td>
        </tr>
        @endif
        @endforeach
        <tr>
            <td colspan="7" class="font-weight-bold bg-light">Capaian Pembelajaran Mata Kuliah (CPMK)</td>
        </tr>
        @foreach($mata_kuliah["cpmks"] as $cpmk)
        <tr>
            <td colspan="2">CPMK {{ $cpmk['no'] }}</td>
            <td colspan="5">{{ $cpmk['name'] }}</td>
        </tr>
        @endforeach
        <tr>
            <td class="font-weight-bold">Peta CPL - CP MK</td>
            <td colspan="7">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            @foreach($cpls_array as $cpl)
                            @if(in_array($cpl['id'], $mata_kuliah["cpl_matakuliahs"]))
                            <th>
                                <center>
                                    CPL {{$cpl['no']}}
                                </center>
                            </th>
                            @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mata_kuliah["cpmks"] as $cpmk)
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td>CPMK {{ $cpmk["no"] }} : {{ $cpmk["name"] }}</td>
                            @foreach($cpls_array as $cpl)
                            <?php $i = 0 ?>
                            @if(in_array($cpl['id'], $mata_kuliah["cpl_matakuliahs"]))
                            @foreach($cpl_cpmks as $cpl_cpmk)
                            @if($cpl_cpmk['cpl_id'] == $cpl['id'] && $cpl_cpmk['cpmk_id'] == $cpmk['id'])
                            <td>
                                <center>
                                    <input type="checkbox" checked disabled>
                                </center>
                            </td>
                            <?php $i = 1 ?>
                            @break
                            @endif
                            @endforeach
                            @if($i == 0)
                            <td>
                                <center>
                                    <input type="checkbox" disabled>
                                </center>
                            </td>
                            @endif
                            @endif
                            @endforeach
                            <?php $i = 0 ?>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td class="font-weight-bold">Deskripsi Singkat MK</td>
            <td colspan="7"> {{ $mata_kuliah["deskripsi"] }}</td>
        </tr>
        <tr>
            <td>
                <span class="font-weight-bold">Bahan Kajian: </span>Materi Pembelajaran
            </td>
            <td colspan="7">
                @foreach($mata_kuliah["bahan_kajian"] as $key => $bahan_kajian)
                {{ $key + 1 }}. {{ $bahan_kajian}} <br>
                @endforeach
            </td>
        </tr>
        <tr>
            <td rowspan="2" class="font-weight-bold">Pustaka</td>
            <td class="font-weight-bold bg-light" colspan="2">Utama: </td>
            <td colspan="5">
                @foreach($mata_kuliah["pustaka_utama"] as $key => $pustaka_utama)
                {{ $key + 1 }}. {{ $pustaka_utama }} <br>
                @endforeach
            </td>
        </tr>
        <tr>
            <td class="font-weight-bold bg-light" colspan="2">Pendukung: </td>
            <td colspan="5">
                @foreach($mata_kuliah["pustaka_pendukung"] as $key => $pustaka_pendukung)
                {{ $key + 1 }}. {{ $pustaka_pendukung }} <br>
                @endforeach
            </td>
        </tr>
        <tr>
            <td class="font-weight-bold">Dosen Pengampu</td>
            <td colspan="7">
                @foreach($mata_kuliah["dosen"] as $key => $dosen)
                {{ $key + 1 }}. {{ $dosen }} <br>
                @endforeach
            </td>
        </tr>
        <tr>
            <td class="font-weight-bold">Matakuliah syarat</td>
            <td colspan="7">
                @if(count($mata_kuliah['mata_kuliah_syarat']) != 0)
                    @foreach($mata_kuliah["mata_kuliah_syarat"] as $key => $mk_syarat)
                        @if($key == (count($mata_kuliah['mata_kuliah_syarat']) - 1))
                            {{ $mk_syarat }}
                        @else
                            {{ $mk_syarat }}, 
                        @endif
                    @endforeach
                @else
                    -
                @endif
            </td>
        </tr>
    </table>
    <div class="page-break"></div>
    <h2>Silabus</h2>
    <table width="100%" class="table table-bordered ">
        <thead class="text-center" style="background-color: #deeaf6; ">
            <tr>
                <th>Tatap muka ke-</th>
                <th>Kemampuan Akhir Sub CP MK</th>
                <th>Keluasan (Materi Pembelajaran)</th>
                <th>Metode Pembelajaran</th>
                <th>Estimasi Waktu</th>
                <th>Kriteria dan Indikator Penilaian</th>
                <th>Pengalaman Belajar Mahasiswa</th>
                <th>Bobot</th>
            </tr>
        </thead>
        <tbody>
            @foreach($silabuses as $silabus)
            <tr>
                <td class="font-weight-bold">{{ $silabus->tatap_muka }}</td>
                <td>{{ $silabus->kemampuan_akhir }}</td>
                <td>{{ $silabus->keluasan }}</td>
                <td>{{ $silabus->metode_pembelajaran }}</td>
                <td>
                    @if($silabus->estimasi_waktu->tm != null)
                    TM : {{$silabus->estimasi_waktu->tm}} &deg; <br>
                    @endif
                    @if($silabus->estimasi_waktu->pt != null)
                    PT : {{$silabus->estimasi_waktu->pt}} &deg; <br>
                    @endif
                    @if($silabus->estimasi_waktu->bm != null)
                    BM: {{$silabus->estimasi_waktu->bm}} &deg; <br>
                    @endif
                </td>
                <td>{{$silabus->kriteria_penilaian}}</td>
                <td>{{$silabus->pengamalan}}</td>
                @if($silabus->bobot != null)
                <td>{{$silabus->bobot}} %</td>
                @else
                <td></td>
            @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js " integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj " crossorigin="anonymous "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js " integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns " crossorigin="anonymous "></script>
</body>

</html>