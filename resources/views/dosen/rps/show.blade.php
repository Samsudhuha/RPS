@extends('layouts.home')

@section('title','Dashboard')

@section('navbar')
@include('layouts.navbar')
@endsection

@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('custom-css')

@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!-- /.card -->
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
                    <li class="breadcrumb-item active">RPS - {{ $mata_kuliah["name"] }}</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if (count($errors))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ session('success') }}</li>
                </ul>
            </div>
            @endif
        </div>

        <!-- Data Mata Kuliah -->
        <div class="card card-default collapsed-card">
            <div class="card-header">
                <h3 class="card-title">Data Mata Kuliah</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="/rps/matakuliah/edit/{{$mata_kuliah['id']}}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Program Studi</label>
                                <input type="text" name="program_studi" class="form-control" value="{{ $program_studi->name }}" style="margin-bottom: 5px;" disabled />
                            </div>
                        </div>
                        <div class="col-md-6 fakultas">
                            <div class="form-group">
                                <label>Fakultas</label>
                                <input type="text" name="fakultas" class="form-control" value="{{ $fakultas->name }}" style="margin-bottom: 5px;" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 jurusan">
                            <div class="form-group">
                                <label>Departemen</label>
                                <input type="text" name="program_studi" class="form-control" value="{{ $jurusan->name }}" style="margin-bottom: 5px;" disabled />
                            </div>
                        </div>
                        <div class="col-md-6 rmk">
                            <div class="form-group">
                                <label>RMK</label>
                                <input type="text" name="program_studi" class="form-control" value="{{ $rmk->name }}" style="margin-bottom: 5px;" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mata-kuliah">
                            <div class="form-group">
                                <label>Mata Kuliah</label>
                                <input type="text" name="program_studi" class="form-control" value="{{ $mata_kuliah['name'] }}" style="margin-bottom: 5px;" disabled />
                            </div>
                        </div>
                        <div class="col-md-6 mata-kuliah-syarat">
                            <div class="form-group">
                                <label>Mata Kuliah Syarat</label>
                                <select name="mata_kuliah_syarat[]" class="form-control-lg select2 data-mata-kuliah" multiple="multiple" data-placeholder="Pilih Mata Kuliah Syarat" style="width: 100%;" disabled>
                                    @foreach($mata_kuliah_syarat_all as $mk)
                                    @if(in_array($mk["id"], $mata_kuliah_syarat))
                                    <option value="{{ $mk['id'] }}" selected>{{ $mk['name'] }}</option>
                                    @else
                                    <option value="{{ $mk['id'] }}">{{ $mk['name'] }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 dosen">
                            <div class="form-group">
                                <label>Dosen Pengampu</label>
                                <select name="dosen[]" class="form-control-lg select2 data-mata-kuliah" multiple="multiple" data-placeholder="Pilih Dosen Pengampu" style="width: 100%;" disabled>
                                    @foreach($all_dosens as $dosen)
                                    @if(in_array($dosen["id"], $dosen_matakuliahs))
                                    <option value="{{ $dosen['id'] }}" selected>{{ $dosen['name'] }}</option>
                                    @else
                                    <option value="{{ $dosen['id'] }}">{{ $dosen['name'] }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea type="text" name="deskripsi" rows="5" class="form-control data-mata-kuliah" disabled>{{ $mata_kuliah['deskripsi'] }}</textarea>
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <label>Bahan Kajian</label>
                            <div class="form-group">
                                <div class="form-check">
                                    @foreach($mata_kuliah["bahan_kajian"] as $bahan_kajian)
                                    <div class="static-bahan-kajian">
                                        <div class="form-group">
                                            <input type="text" class="form-control data-mata-kuliah" value="{{$bahan_kajian}}" style="margin-bottom: 5px;" disabled />
                                        </div>
                                    </div>
                                    <div class="dinamic-bahan-kajian">
                                        <div id="form-bahan-kajian-list">
                                            <div class="form-group">
                                                <input type="text" name="bahan_kajian[]" class="form-control data-mata-kuliah" value="{{$bahan_kajian}}" style="margin-bottom: 5px;" disabled />
                                                <button class="btn btn-danger js-remove--bahan-kajian-row">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <button class="btn btn-primary js-add--bahan-kajian-row">Tambah Bahan kajian</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Daftar Pustaka Utama</label>
                            <div class="form-group">
                                <div class="form-check">
                                    @foreach($mata_kuliah["pustaka_utama"] as $pustaka_utama)
                                    <div class="static-pustaka-utama">
                                        <div class="form-group">
                                            <input type="text" class="form-control data-mata-kuliah" value="{{$pustaka_utama}}" style="margin-bottom: 5px;" disabled />
                                        </div>
                                    </div>
                                    <div class="dinamic-pustaka-utama">
                                        <div id="form-daftar-pustaka-utama-list">
                                            <div class="form-group">
                                                <input type="text" name="daftar_pustaka_utama[]" class="form-control data-mata-kuliah" value="{{$pustaka_utama}}" style="margin-bottom: 5px;" disabled />
                                                <button class="btn btn-danger js-remove--daftar-pustaka-utama-row">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <button class="btn btn-primary js-add--daftar-pustaka-utama-row">Tambah Daftar Pustaka Utama</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Daftar Pustaka Pendukung <small class="bg-warning text-white p-1"><b> Tulis '-' jika tidak ada daftar pustaka pendukung</b> </small></label>
                            <div class="form-group">
                                <div class="form-check">
                                    @foreach($mata_kuliah["pustaka_pendukung"] as $pustaka_pendukung)
                                    <div class="static-pustaka-pendukung">
                                        <div class="form-group">
                                            <input type="text" class="form-control data-mata-kuliah" value="{{$pustaka_pendukung}}" style="margin-bottom: 5px;" disabled />
                                        </div>
                                    </div>
                                    <div class="dinamic-pustaka-pendukung">
                                        <div id="form-daftar-pustaka-pendukung-list">
                                            <div class="form-group">
                                                <input type="text" name="daftar_pustaka_pendukung[]" class="form-control data-mata-kuliah" value="{{$pustaka_pendukung}}" style="margin-bottom: 5px;" disabled />
                                                <button class="btn btn-danger js-remove--daftar-pustaka-pendukung-row">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <button class="btn btn-primary js-add--daftar-pustaka-pendukung-row">Tambah Daftar Pustaka Pendukung</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <a class="btn btn-warning edit"> Edit</a>
                            <a class="btn btn-warning batal"> Batal</a>
                            <button class="btn btn-success simpan" type="submit">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- CPL -->
        <div class="card card-default collapsed-card">
            <div class="card-header">
                <h3 class="card-title">Data Capaian Pembelajaran {{ $mata_kuliah["name"] }}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="/rps/cplcpmk/{{$mata_kuliah['id']}}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Capaian Pembelajaran Lulusan</label>
                                <div class="form-group">
                                    <div class="form-check">
                                        <div class="static-cpl">
                                            @if(count($cpl_matakuliahs_id)!=0)
                                            @foreach($cpls as $cpl)
                                            @if(in_array($cpl['id'], $cpl_matakuliahs_id))
                                            <div style="margin-bottom: 10px;text-align:justify">
                                                <input class="form-check-input" type="checkbox" value="{{$cpl['id']}}" checked name="cpl[]" disabled>
                                                <label class="form-check-label">CPL {{$cpl['no']}} : {{$cpl['name']}}</label>
                                            </div>
                                            @endif
                                            @endforeach
                                            @else
                                            @foreach($cpls as $cpl)
                                            <div style="margin-bottom: 10px;text-align:justify">
                                                <input class="form-check-input" type="checkbox" value="{{$cpl['id']}}" name="cpl[]">
                                                <label class="form-check-label">CPL {{$cpl['no']}} : {{$cpl['name']}}</label>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                        <div class="edit-cpl">
                                            @foreach($cpls as $cpl)
                                            @if(in_array($cpl['id'], $cpl_matakuliahs_id))
                                            <div style="margin-bottom: 10px;text-align:justify">
                                                <input class="form-check-input" type="checkbox" value="{{$cpl['id']}}" checked name="cpl[]">
                                                <label class="form-check-label">{{$cpl['name']}}</label>
                                            </div>
                                            @else
                                            <div style="margin-bottom: 10px;text-align:justify">
                                                <input class="form-check-input" type="checkbox" value="{{$cpl['id']}}" name="cpl[]">
                                                <label class="form-check-label">{{$cpl['name']}}</label>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Capaian Pembelajaran Mata Kuliah</label>
                                <button type="button" class="btn btn-warning mt-1 float-right" data-toggle="modal" data-target="#modal-default">Data Taksonomi</button>
                                <!-- Modal -->
                                <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Data Taksonomi Bloom</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <h4 class="form-control-label">Remember</h4>
                                                    <div class="row">
                                                        @foreach($remembers as $key => $r)
                                                            <div class="col-md-4">
                                                                <ul>
                                                                    <li>
                                                                        {{$r->name}}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <br>
                                                    <h4 class="form-control-label">Understand</h4>
                                                    <div class="row">
                                                        @foreach($understands as $key => $u)
                                                            <div class="col-md-4">
                                                                <ul>
                                                                    <li>
                                                                        {{$u->name}}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <br>
                                                    <h4 class="form-control-label">Apply </h4>
                                                    <div class="row">
                                                        @foreach($applys as $key => $a)
                                                            <div class="col-md-4">
                                                                <ul>
                                                                    <li>
                                                                        {{$a->name}}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <br>
                                                    <h4 class="form-control-label">Analyze</h4>
                                                    <div class="row">
                                                        @foreach($analyzes as $key => $an)
                                                            <div class="col-md-4">
                                                                <ul>
                                                                    <li>
                                                                        {{$an->name}}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <br>
                                                    <h4 class="form-control-label">Evaluate</h4>
                                                    <div class="row">
                                                        @foreach($evaluates as $key => $e)
                                                            <div class="col-md-4">
                                                                <ul>
                                                                    <li>
                                                                        {{$e->name}}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <br>
                                                    <h4 class="form-control-label">Create</h4>
                                                    <div class="row">
                                                        @foreach($creates as $key => $c)
                                                            <div class="col-md-4">
                                                                <ul>
                                                                    <li>
                                                                        {{$c->name}}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <br>
                                    <div class="form-check">
                                        @if(count($cpmks)!=0)
                                        @php $i = 1 @endphp
                                        @foreach($cpmks as $cpmk)
                                        <div class="cpmk-static">
                                            <div class="form-group">
                                                <input type="text" class="form-control data-cpmk" value="{{$cpmk['name']}}" name="cpmk{{$i}}" style="margin-bottom: 5px;" disabled />
                                            </div>
                                        </div>
                                        @php $i += 1 @endphp
                                        @endforeach
                                        @else
                                        <div id="form-cpmk-list">
                                            <div class="form-group">
                                                <input type="text" name="cpmk1" class="form-control" style="margin-bottom: 5px;" required/>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="cpmk2" class="form-control" style="margin-bottom: 5px;" required />
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="cpmk3" class="form-control" style="margin-bottom: 5px;" required/>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="cpmk4" class="form-control" style="margin-bottom: 5px;" required/>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            @if(count($cpl_matakuliahs_id)!=0)
                            <a class="btn btn-warning edit-cpl-cpmk">Edit</a>
                            <a class="btn btn-warning batal-cpl-cpmk">Batal</a>
                            @else
                            <button class="btn btn-success" type="submit">Simpan</button>
                            @endif
                            <button class="btn btn-success simpan-cpl-cpmk" type="submit">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Peta CPL CPMK -->
        <div class="card card-default collapsed-card">
            <div class="card-header">
                <h3 class="card-title">Peta CPL - CP MK</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="/rps/cplcpmk/peta/{{$mata_kuliah['id']}}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-12">
                            @if(count($cpl_matakuliahs_id)!=0)
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        @foreach($cpls as $cpl)
                                        @if(in_array($cpl['id'], $cpl_matakuliahs_id))
                                        <th>CPL {{$cpl['no']}}</th>
                                        @endif
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cpmks as $cpmk)
                                    <tr data-widget="expandable-table" aria-expanded="false">
                                        <td>CPMK {{ $cpmk["no"] }} : {{ $cpmk["name"] }}</td>
                                        @foreach($cpls as $cpl)
                                        <?php $i = 0 ?>
                                        @if(in_array($cpl['id'], $cpl_matakuliahs_id))
                                        @if(count($cpl_cpmks)!=0)
                                        @foreach($cpl_cpmks as $cpl_cpmk)
                                        @if($cpl_cpmk['cpl_id'] == $cpl['id'] && $cpl_cpmk['cpmk_id'] == $cpmk['id'])
                                        <td>
                                            <input type="checkbox" id="checkboxPrimary1" value="{{$cpmk['no']}}|{{$cpl['no']}}" name="peta[]" class="peta-cpl-cpmk" checked disabled>
                                            <label for="checkboxPrimary1"></label>
                                        </td>
                                        <?php $i = 1 ?>
                                        @break
                                        @endif
                                        @endforeach
                                        @if($i == 0)
                                        <td>
                                            <input type="checkbox" id="checkboxPrimary1" value="{{$cpmk['no']}}|{{$cpl['no']}}" name="peta[]" class="peta-cpl-cpmk" disabled>
                                            <label for="checkboxPrimary1"></label>
                                        </td>
                                        @endif
                                        @else
                                        <td>
                                            <input type="checkbox" id="checkboxPrimary1" value="{{$cpmk['no']}}|{{$cpl['no']}}" name="peta[]" class="peta-cpl-cpmk">
                                            <label for="checkboxPrimary1"></label>
                                        </td>
                                        @endif
                                        @endif
                                        @endforeach
                                        <?php $i = 0 ?>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="col-md-12">
                                <div class="card bg-danger">
                                    <center>
                                        <div class="card-body">
                                            Isi Data CPL - CP MK Terlebih Dahulu
                                        </div>
                                    </center>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            @if(count($cpl_cpmks)!=0)
                            <a class="btn btn-warning edit-peta-cpl-cpmk">Edit</a>
                            <a class="btn btn-warning batal-peta-cpl-cpmk">Batal</a>
                            @else
                            <button class="btn btn-success" type="submit">Simpan</button>
                            @endif
                            <button class="btn btn-success simpan-peta-cpl-cpmk" type="submit">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Silabus -->
        <div class="card card-default collapsed-card">
            <div class="card-header">
                <h3 class="card-title">Silabus</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="card-header">
                    <a class="btn btn-success float-right" href="/rps/silabus/create/{{$mata_kuliah['id']}}">Tambah Silabus</a>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if(count($silabuses)!=0)
                        <br>
                        @if($flag_role == 0)
                            <h4 class="form-control-label">Data Taksonomi | <div class="badge bg-danger">Belum terpenuhi</div> </h4>
                        @else
                            <h4 class="form-control-label">Data Taksonomi | <div class="badge bg-success">Sudah terpenuhi</div> </h4>
                        @endif
                        @if($flag_role_error == 1)
                            <h4 class="form-control-label">Data Taksonomi | <div class="badge bg-danger">Tidak urut</div> </h4>
                            <ul>
                                @foreach($flag_role_error_description as $key => $value)
                                    <li>
                                        <small class="bg-warning text-white p-1">Pada tatap muka {{$value['tatap_muka']}} seharusya diisi dengan Taksonomi Bloom sub - {{$value['role']}}</small>
                                    </li>
                                @endforeach
                            </ul>
                            <br>
                        @else
                            <h4 class="form-control-label">Data Taksonomi | <div class="badge bg-success">Sudah urut</div> </h4>
                        @endif
                        @if($flag_bobot != 100)
                            <h4 class="form-control-label">Bobot | <div class="badge bg-danger">Tidak sama dengan 100</div> </h4>
                        @else
                            <h4 class="form-control-label">Bobot | <div class="badge bg-success">Sama dengan 100</div> </h4>
                        @endif
                        <br>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Tatap Muka Ke-</th>
                                    <th>Kemampuan Akhir Sub CP MK</th>
                                    <th>Keluasan (Materi Pembelajaran)</th>
                                    <th>Metode Pembelajaran</th>
                                    <th>Estimasi Waktu</th>
                                    <th>Kriteria dan Indikator Penilaian</th>
                                    <th>Pengalaman Belajar Mahasiswa</th>
                                    <th>Bobot</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($silabuses as $silabus)
                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <td>{{$silabus->tatap_muka}}</td>
                                    <td>{{$silabus->kemampuan_akhir}}</td>
                                    <td>{{$silabus->keluasan}}</td>
                                    <td>{{$silabus->metode_pembelajaran}}</td>
                                    <td>
                                        @if($silabus->estimasi_waktu->tm != null)
                                        TM : {{$silabus->estimasi_waktu->tm}} &deg;
                                        <br>
                                        @endif
                                        @if($silabus->estimasi_waktu->pt != null)
                                        PT : {{$silabus->estimasi_waktu->pt}} &deg;
                                        <br>
                                        @endif
                                        @if($silabus->estimasi_waktu->bm != null)
                                        BM: {{$silabus->estimasi_waktu->bm}} &deg;
                                        <br>
                                        @endif
                                    </td>
                                    <td>{{$silabus->kriteria_penilaian}}</td>
                                    <td>{{$silabus->pengamalan}}</td>
                                    @if($silabus->bobot != null)
                                        <td>{{$silabus->bobot}} %</td>
                                        @else
                                        <td></td>
                                    @endif
                                    <td>
                                        <a class="btn btn-warning" href="/rps/silabus/{{$silabus->id}}">Edit</a>
                                        <button type="button" class="btn btn-danger mt-1" data-toggle="modal" data-target="#modal-default{{$silabus->id}}">Hapus</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-default{{$silabus->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <center>
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Menghapus Data Mata Kuliah</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin untuk menghapus data silabus pada tatap muka
                                                            <pre>{{ $silabus->tatap_muka }}?</pre>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <form action="/rps/silabus/delete/{{$silabus->id}}" method="post">
                                                                {{ csrf_field() }}
                                                                <input type="text" name="mata_kuliah_id" value="{{$mata_kuliah['id']}}" hidden>
                                                                <button class=" btn btn-danger" type="submit">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="col-md-12">
                            <div class="card bg-danger">
                                <center>
                                    <div class="card-body">
                                        Tidak Ada Data Silabus
                                    </div>
                                </center>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </section>
</div>

@endsection

@section('custom-js')

<!-- DataTables  & Plugins -->
<script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{url('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{url('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // Data Mata Kuliah
        $(".simpan").hide();
        $(".batal").hide();
        $(".dinamic-pustaka-pendukung").hide();
        $(".dinamic-pustaka-utama").hide();
        $(".dinamic-bahan-kajian").hide();
        $(".js-add--bahan-kajian-row").hide();
        $(".js-add--daftar-pustaka-utama-row").hide();
        $(".js-add--daftar-pustaka-pendukung-row").hide();
        $(".js-remove--daftar-pustaka-pendukung-row").hide();
        $(".js-remove--daftar-pustaka-utama-row").hide();
        $(".js-remove--bahan-kajian-row").hide();

        // Cpl Cpmk
        $(".simpan-cpl-cpmk").hide();
        $(".batal-cpl-cpmk").hide();
        $(".edit-cpl").hide();
        $(".cpmk-dinamic").hide();
        $(".js-add--cpmk-row").hide();
        $(".js-remove--cpmk-row").hide();

        // Peta Cpl Cpmk
        $(".simpan-peta-cpl-cpmk").hide();
        $(".batal-peta-cpl-cpmk").hide();

        // Silabus
        $(".batal-silabus").hide();
    });

    $(document).on('click', '.edit', function(e) {
        $('.data-mata-kuliah').prop("disabled", false);
        $(".edit").hide();
        $(".batal").show();
        $(".simpan").show();
        $(".static-pustaka-pendukung").hide();
        $(".static-pustaka-utama").hide();
        $(".static-bahan-kajian").hide();
        $(".dinamic-pustaka-pendukung").show();
        $(".dinamic-pustaka-utama").show();
        $(".dinamic-bahan-kajian").show();
        $(".js-add--bahan-kajian-row").show();
        $(".js-add--daftar-pustaka-utama-row").show();
        $(".js-add--daftar-pustaka-pendukung-row").show();
        $(".js-remove--daftar-pustaka-pendukung-row").show();
        $(".js-remove--daftar-pustaka-utama-row").show();
        $(".js-remove--bahan-kajian-row").show();
    });

    $(document).on('click', '.batal', function(e) {
        $('.data-mata-kuliah').prop("disabled", true);
        $(".edit").show();
        $(".batal").hide();
        $(".simpan").hide();
        $(".dinamic-pustaka-pendukung").hide();
        $(".dinamic-pustaka-utama").hide();
        $(".dinamic-bahan-kajian").hide();
        $(".static-pustaka-pendukung").show();
        $(".static-pustaka-utama").show();
        $(".static-bahan-kajian").show();
        $(".js-add--bahan-kajian-row").hide();
        $(".js-add--daftar-pustaka-utama-row").hide();
        $(".js-add--daftar-pustaka-pendukung-row").hide();
        $(".js-remove--daftar-pustaka-pendukung-row").hide();
        $(".js-remove--daftar-pustaka-utama-row").hide();
        $(".js-remove--bahan-kajian-row").hide();
    });

    $(document).on('click', '.edit-cpl-cpmk', function(e) {
        $('.data-cpmk').prop("disabled", false);
        $(".static-cpl").hide();
        $(".edit-cpl").show();
        $(".edit-cpl-cpmk").hide();
        $(".batal-cpl-cpmk").show();
        $(".simpan-cpl-cpmk").show();
        $(".js-add--cpmk-row").show();
        $(".js-remove--cpmk-row").show();
    });

    $(document).on('click', '.batal-cpl-cpmk', function(e) {
        $('.data-cpmk').prop("disabled", true);
        $(".static-cpl").show();
        $(".edit-cpl").hide();
        $(".edit-cpl-cpmk").show();
        $(".batal-cpl-cpmk").hide();
        $(".simpan-cpl-cpmk").hide();
        $(".js-add--cpmk-row").hide();
        $(".js-remove--cpmk-row").hide();
    });

    $(document).on('click', '.edit-peta-cpl-cpmk', function(e) {
        $('.peta-cpl-cpmk').prop("disabled", false);
        $(".edit-peta-cpl-cpmk").hide();
        $(".batal-peta-cpl-cpmk").show();
        $(".simpan-peta-cpl-cpmk").show();
    });

    $(document).on('click', '.batal-peta-cpl-cpmk', function(e) {
        $('.peta-cpl-cpmk').prop("disabled", true);
        $(".edit-peta-cpl-cpmk").show();
        $(".batal-peta-cpl-cpmk").hide();
        $(".simpan-peta-cpl-cpmk").hide();
    });

    // Fakultas
    jQuery(document).ready(function() {
        jQuery('select[name="program_studi"]').on('change', function() {
            $(".jurusan").hide();
            $(".rmk").hide();
            $(".mata-kuliah").hide();
            $(".dosen").hide();
            $(".mata-kuliah-syarat").hide();
            var programStudiID = jQuery(this).val();
            console.log(programStudiID);
            if (programStudiID) {
                jQuery.ajax({
                    url: '/dropdownlist/getfakultas/' + programStudiID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $(".fakultas").show();
                        jQuery('select[name="fakultas"]').empty();
                        $('select[name="fakultas"]').append('<option disabled selected>Pilih Fakultas</option>');
                        jQuery.each(data, function(key, value) {
                            $('select[name="fakultas"]').append('<option value="' + value['id'] + '">' + value['name'] + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>

<!-- Dynamic Form -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
<script type="text/javascript">
    // Bahan Kajian
    (function() {
        //add rows when add button is clicked
        $(document).on('click', '.js-add--bahan-kajian-row', function(e) {
            var clone, examsList;
            e.preventDefault();
            examsList = $('#form-bahan-kajian-list');
            clone = examsList.children('.form-group:first').clone(true);
            if (clone.length == 0) {
                // console.log(examsList);
                clone = `
                    <div class="form-group">
                        <input id="undefined_1" type="text" name="bahan_kajian[]" class="form-control data-mata-kuliah" style="margin-bottom: 5px;"/>
                        <button class="btn btn-danger js-remove--bahan-kajian-row">Remove</button>
                    </div>`
                return examsList.append(clone)
            }
            //reset values in cloned inputs and
            //add enumerated ID's to input fields
            clone.find('input').val('').attr('id', function() {
                return $(this).attr('id') + '_' + (examsList.children('.form-group').length + 1);
            });
            return examsList.append(clone);
        });

        //remove rows when remove button is clicked
        $(document).on('click', '.js-remove--bahan-kajian-row', function(e) {
            e.preventDefault();
            return $(this).parent().remove();
        });

    }).call(this);

    // Daftar Pustaka Utama
    (function() {
        //add rows when add button is clicked
        $(document).on('click', '.js-add--daftar-pustaka-utama-row', function(e) {
            var clone, examsList;
            e.preventDefault();
            examsList = $('#form-daftar-pustaka-utama-list');
            clone = examsList.children('.form-group:first').clone(true);
            // console.log(clone);
            if (clone.length == 0) {
                // console.log(examsList);
                clone = `
                    <div class="form-group">
                        <input id="undefined_1" type="text" name="daftar_pustaka_utama[]" class="form-control data-mata-kuliah" style="margin-bottom: 5px;" />
                        <button class="btn btn-danger js-remove--daftar-pustaka-utama-row">Remove</button>
                    </div>`
                return examsList.append(clone)
            }else{
                //reset values in cloned inputs and
                //add enumerated ID's to input fields
                clone.find('input').val('').attr('id', function() {
                    return $(this).attr('id') + '_' + (examsList.children('.form-group').length + 1);
                });
                return examsList.append(clone);
            }
        });

        //remove rows when remove button is clicked
        $(document).on('click', '.js-remove--daftar-pustaka-utama-row', function(e) {
            e.preventDefault();
            return $(this).parent().remove();
        });

    }).call(this);

    // Daftar Pustaka Pendukung
    (function() {
        //add rows when add button is clicked
        $(document).on('click', '.js-add--daftar-pustaka-pendukung-row', function(e) {
            var clone, examsList;
            e.preventDefault();
            examsList = $('#form-daftar-pustaka-pendukung-list');
            clone = examsList.children('.form-group:first').clone(true);
            if (clone.length == 0) {
                // console.log(examsList);
                clone = `
                    <div class="form-group">
                        <input id="undefined_1" type="text" name="daftar_pustaka_pendukung[]" class="form-control data-mata-kuliah" style="margin-bottom: 5px;" />
                        <button class="btn btn-danger js-remove--daftar-pustaka-pendukung-row">Remove</button>
                    </div>`
                return examsList.append(clone)
            }else {
            //reset values in cloned inputs and
            //add enumerated ID's to input fields
            clone.find('input').val('').attr('id', function() {
                return $(this).attr('id') + '_' + (examsList.children('.form-group').length + 1);
            });
            return examsList.append(clone);
            }
        });

        //remove rows when remove button is clicked
        $(document).on('click', '.js-remove--daftar-pustaka-pendukung-row', function(e) {
            e.preventDefault();
            return $(this).parent().remove();
        });

    }).call(this);

    // CPMK
    (function() {
        //add rows when add button is clicked
        $(document).on('click', '.js-add--cpmk-row', function(e) {
            var clone, examsList;
            e.preventDefault();
            examsList = $('#form-cpmk-list');
            clone = examsList.children('.form-group:first').clone(true);
            //reset values in cloned inputs and
            //add enumerated ID's to input fields
            clone.find('input').val('').attr('id', function() {
                return $(this).attr('id') + '_' + (examsList.children('.form-group').length + 1);
            });
            return examsList.append(clone);
        });
        //add rows when add button is clicked
        $(document).on('click', '.js-add--cpmk-simpan-row', function(e) {
            var clone, examsList;
            e.preventDefault();
            examsList = $('#form-cpmk-list');
            clone = examsList.children('.form-group:first').clone(true);
            clone.append($('<button>').addClass('btn btn-danger js-remove--cpmk-row').html('Remove'));
            //reset values in cloned inputs and
            //add enumerated ID's to input fields
            clone.find('input').val('').attr('id', function() {
                return $(this).attr('id') + '_' + (examsList.children('.form-group').length + 1);
            });
            return examsList.append(clone);
        });

        //remove rows when remove button is clicked
        $(document).on('click', '.js-remove--cpmk-row', function(e) {
            e.preventDefault();
            return $(this).parent().remove();
        });

    }).call(this);
</script>
<!-- Page specific script -->
<script>
    $(document).ready(function() {
        $('#tableRps').DataTable({
            "autoWidth": true,
            "ordering": true,
        });
    });
</script>
<script type="text/javascript">
    $("#sidebar-dosen-rps").addClass("active");
</script>
@endsection