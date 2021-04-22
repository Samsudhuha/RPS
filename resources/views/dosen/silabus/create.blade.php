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
                                    <select name="tatap_muka[]" class="form-control-lg select2" style="width: 100%;" multiple="multiple" data-placeholder="Pilih Tatap Muka" value="{{ old('tatap_muka') }}" required>
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
                                    <textarea type="text" name="kemampuan_akhir" rows="5" class="form-control" placeholder="" required value="{{ old('kemampuan_akhir') }}"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keluasan (Materi Pembelajaran)</label>
                                    <textarea type="text" name="keluasan" rows="5" class="form-control" placeholder="" value="{{ old('keluasan') }}" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Metode Pembelajaran</label>
                                    <textarea type="text" name="metode_pembelajaran" rows="5" class="form-control" placeholder="" value="{{ old('metode_pembelajaran') }}" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Estimasi Waktu</label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tatap Muka</label>
                                                <input type="text" name="tm" class="form-control" placeholder="150" value="{{ old('tm') }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Penugasan Terstruktur</label>
                                                <input type="text" name="pt" class="form-control" placeholder="120" value="{{ old('pt') }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Belajar Mandiri</label>
                                                <input type="text" name="bm" class="form-control" placeholder="360" value="{{ old('bm') }}" />
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
                                    <textarea type="text" name="kriteria_penilaian" rows="5" class="form-control" placeholder="" value="{{ old('kriteria_penilaian') }}" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Pengamalan Belajar Mahasiswa</label>
                                <div id="form-bahan-kajian-list">
                                    <div class="form-group">
                                        <textarea type="text" name="pengamalan" rows="5" class="form-control" placeholder="" value="{{ old('pengamalan') }}" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Bobot</label>
                                <div id="form-daftar-pustaka-utama-list">
                                    <div class="form-group">
                                        <input type="text" name="bobot" class="form-control" value="{{ old('bobot') }}" placeholder="4%" />
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