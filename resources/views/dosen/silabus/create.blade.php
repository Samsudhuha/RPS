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

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Silabus</li>
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
            <div class="card card-default">
                <div class="card-header">
                    <center>
                        <h3 >Kata Kunci</h3>
                        <p><small class="bg-warning text-white p-1"><b>*Wajib menggunakan kata kunci yang telah disediakan pada sub "Kemampuan Akhir Sub CP MK"*</b> </small></p>
                    </center>
                </div>
                <div class="card-body">
                    @if($flag_remember == 0)
                        <h4 class="form-control-label">Remember | <div class="badge bg-danger">Belum digunakan</div> </h4>
                    @else
                        <h4 class="form-control-label">Remember | <div class="badge bg-success">Sudah digunakan</div> </h4>
                    @endif
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
                    @if($flag_understand == 0)
                        <h4 class="form-control-label">Understand | <div class="badge bg-danger">Belum digunakan</div> </h4>
                    @else
                        <h4 class="form-control-label">Understand | <div class="badge bg-success">Sudah digunakan</div> </h4>
                    @endif
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
                    @if($flag_apply == 0)
                        <h4 class="form-control-label">Apply | <div class="badge bg-danger">Belum digunakan</div> </h4>
                    @else
                        <h4 class="form-control-label">Apply | <div class="badge bg-success">Sudah digunakan</div> </h4>
                    @endif
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
                    @if($flag_analyze == 0)
                        <h4 class="form-control-label">Analyze | <div class="badge bg-danger">Belum digunakan</div> </h4>
                    @else
                        <h4 class="form-control-label">Analyze | <div class="badge bg-success">Sudah digunakan</div> </h4>
                    @endif
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
                    @if($flag_evaluate == 0)
                        <h4 class="form-control-label">Evaluate | <div class="badge bg-danger">Belum digunakan</div> </h4>
                    @else
                        <h4 class="form-control-label">Evaluate | <div class="badge bg-success">Sudah digunakan</div> </h4>
                    @endif
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
                    @if($flag_create == 0)
                        <h4 class="form-control-label">Create | <div class="badge bg-danger">Belum digunakan</div> </h4>
                    @else
                        <h4 class="form-control-label">Create | <div class="badge bg-success">Sudah digunakan</div> </h4>
                    @endif
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
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Silabus</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <form action="/rps/silabus/create/{{$id}}" method="post">
                    {{ csrf_field() }}
                    <div class=" card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tatap Muka Ke - </label>
                                    <select name="tatap_muka[]" class="form-control-lg select2" style="width: 100%;" multiple="multiple" data-placeholder="Pilih Tatap Muka" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kemampuan Akhir Sub CP MK</label>
                                    <textarea type="text" name="kemampuan_akhir" rows="5" class="form-control" required value="{{ old('kemampuan_akhir') }}"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keluasan (Materi Pembelajaran)</label>
                                    <textarea type="text" name="keluasan" rows="5" class="form-control" value="{{ old('keluasan') }}" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Metode Pembelajaran</label>
                                    <textarea type="text" name="metode_pembelajaran" rows="5" class="form-control" value="{{ old('metode_pembelajaran') }}" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Estimasi Waktu</label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tatap Muka</label>
                                                <input type="number" name="tm" class="form-control" value="{{ old('tm') }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Penugasan Terstruktur</label>
                                                <input type="number" name="pt" class="form-control" value="{{ old('pt') }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Belajar Mandiri</label>
                                                <input type="number" name="bm" class="form-control" value="{{ old('bm') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kriteria dan Indikator Penilaian</label>
                                    <textarea type="text" name="kriteria_penilaian" rows="5" class="form-control" value="{{ old('kriteria_penilaian') }}" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Pengamalan Belajar Mahasiswa</label>
                                <div id="form-bahan-kajian-list">
                                    <div class="form-group">
                                        <textarea type="text" name="pengamalan" rows="5" class="form-control" value="{{ old('pengamalan') }}" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Bobot</label>
                                <div id="form-daftar-pustaka-utama-list">
                                    <div class="form-group">
                                        <input type="number" name="bobot" class="form-control" value="{{ old('bobot') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <a class="btn btn-primary" href="/rps/{{$id}}"> Kembali</a>
                            <button class="btn btn-success" type="submit"> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection

@section('custom-js')

<script type="text/javascript">
    $("#sidebar-dosen-rps").addClass("active");
</script>

@endsection