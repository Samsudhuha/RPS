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
                </div>
                <form action="/rps/silabus/{{$silabus['id']}}" method="post">
                    {{ csrf_field() }}
                    <div class=" card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tatap Muka Ke - </label>
                                    <select name="tatap_muka[]" class="form-control-lg select2" style="width: 100%;" multiple="multiple" data-placeholder="Pilih Tatap Muka" value="{{ old('tatap_muka') }}" required>
                                        @if(in_array(1,$silabus['tatap_muka']))
                                        <option value="1" selected>1</option>
                                        @else
                                        <option value="1">1</option>
                                        @endif
                                        @if(in_array(2,$silabus['tatap_muka']))
                                        <option value="2" selected>2</option>
                                        @else
                                        <option value="2">2</option>
                                        @endif
                                        @if(in_array(3,$silabus['tatap_muka']))
                                        <option value="3" selected>3</option>
                                        @else
                                        <option value="3">3</option>
                                        @endif
                                        @if(in_array(4,$silabus['tatap_muka']))
                                        <option value="4" selected>4</option>
                                        @else
                                        <option value="4">4</option>
                                        @endif
                                        @if(in_array(5,$silabus['tatap_muka']))
                                        <option value="5" selected>5</option>
                                        @else
                                        <option value="5">5</option>
                                        @endif
                                        @if(in_array(6,$silabus['tatap_muka']))
                                        <option value="6" selected>6</option>
                                        @else
                                        <option value="6">6</option>
                                        @endif
                                        @if(in_array(7,$silabus['tatap_muka']))
                                        <option value="7" selected>7</option>
                                        @else
                                        <option value="7">7</option>
                                        @endif
                                        @if(in_array(8,$silabus['tatap_muka']))
                                        <option value="8" selected>8</option>
                                        @else
                                        <option value="8">8</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kemampuan Akhir Sub CP MK</label>
                                    <textarea type="text" name="kemampuan_akhir" rows="5" class="form-control" placeholder="" required>{{ $silabus['kemampuan_akhir'] }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keluasan (Materi Pembelajaran)</label>
                                    <textarea type="text" name="keluasan" rows="5" class="form-control" placeholder="" required>{{ $silabus['keluasan'] }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Metode Pembelajaran</label>
                                    <textarea type="text" name="metode_pembelajaran" rows="5" class="form-control" placeholder="" required>{{ $silabus['metode_pembelajaran'] }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Estimasi Waktu</label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tatap Muka</label>
                                                <input type="text" name="tm" class="form-control" placeholder="150" value="{{ $silabus['estimasi_waktu']->tm }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Penugasan Terstruktur</label>
                                                <input type="text" name="pt" class="form-control" placeholder="120" value="{{ $silabus['estimasi_waktu']->pt }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Belajar Mandiri</label>
                                                <input type="text" name="bm" class="form-control" placeholder="360" value="{{ $silabus['estimasi_waktu']->bm }}" />
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
                                    <textarea type="text" name="kriteria_penilaian" rows="5" class="form-control" placeholder="" required>{{ $silabus['kriteria_penilaian'] }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Pengamalan Belajar Mahasiswa</label>
                                <div id="form-bahan-kajian-list">
                                    <div class="form-group">
                                        <textarea type="text" name="pengamalan" rows="5" class="form-control" placeholder="" required>{{ $silabus['pengamalan'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Bobot</label>
                                <div id="form-daftar-pustaka-utama-list">
                                    <div class="form-group">
                                        <input type="text" name="bobot" class="form-control" value="{{ $silabus['bobot'] }}" placeholder="4%" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <a class="btn btn-primary" href="/rps/{{$silabus['mata_kuliah_id']}}"> Kembali</a>
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