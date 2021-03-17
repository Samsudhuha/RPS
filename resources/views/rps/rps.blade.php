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
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">RPS - </li>
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
            <div class="card card-default" style="width: 20%;">
                <div class="card-header">
                    <center>
                        <a class="btn btn-primary" href="/home"> Kembali </a>
                        <a class="btn btn-success" href="/rps/cetakRPS"> Cetak PDF</a>
                    </center>
                </div>
            </div>
        </div>
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Data Mata Kuliah</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <form action="/rps/create/matakuliah" method="post">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Program Studi</label>
                                <select name="program_studi" class="form-control-lg select2" style="width: 100%;" value="">
                                    @foreach($program_studis as $program_studi)
                                    <option value="{{ $program_studi->id }}" @if( $program_studi->id == $mata_kuliah["program_studi_id"] )
                                        selected
                                        @endif
                                        >{{ $program_studi->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 jurusan">
                            <div class="form-group">
                                <label>Jurusan</label>
                                <select name="jurusan" class="form-control-lg select2" style="width: 100%;">
                                    @foreach($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}" @if( $jurusan->id == $mata_kuliah["jurusan_id"] )
                                        selected
                                        @endif
                                        >{{ $jurusan->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 rmk">
                            <div class="form-group">
                                <label>RMK</label>
                                <select name="rmk" class="form-control-lg select2" style="width: 100%;">
                                    @foreach($rmks as $rmk)
                                    <option value="{{ $rmk->id }}" @if( $rmk->id == $mata_kuliah["rmk_id"] )
                                        selected
                                        @endif
                                        >{{ $rmk->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mata-kuliah">
                            <div class="form-group">
                                <label>Mata Kuliah</label>
                                <select name="mata_kuliah" class="form-control-lg select2" style="width: 100%;">
                                    @foreach($mata_kuliahs as $matakuliah)
                                    <option value="{{ $matakuliah->id }}" @if( $jurusan->id == $mata_kuliah["id"] )
                                        selected
                                        @endif
                                        >{{ $matakuliah->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 dosen">
                            <div class="form-group">
                                <label>Dosen Pengampu</label>
                                <select name="dosen[]" class="form-control-lg select2" multiple="multiple" data-placeholder="Pilih Dosen Pengampu" style="width: 100%;">
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
                                <textarea type="text" name="deskripsi" rows="5" class="form-control" placeholder=" e.g. Exam 1, Mid Term"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Bahan Kajian</label>
                            <div id="form-bahan-kajian-list">
                                <div class="form-group">
                                    <input type="text" name="bahan_kajian[]" class="form-control" placeholder="e.g. Exam 1, Mid Term" />
                                </div>
                            </div>
                            <button class="btn btn-primary js-add--bahan-kajian-row">Tambah Bahan kajian</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Daftar Pustaka Utama</label>
                            <div id="form-daftar-pustaka-utama-list">
                                <div class="form-group">
                                    <input type="text" name="daftar_pustaka_utama[]" class="form-control" placeholder="e.g. Exam 1, Mid Term" />
                                </div>
                            </div>
                            <button class="btn btn-primary js-add--daftar-pustaka-utama-row">Tambah Daftar Pustaka Utama</button>
                        </div>
                        <div class="col-md-6">
                            <label>Daftar Pustaka Pendukung</label>
                            <div id="form-daftar-pustaka-pendukung-list">
                                <div class="form-group">
                                    <input type="text" name="daftar_pustaka_pendukung[]" class="form-control" placeholder="e.g. Exam 1, Mid Term" />
                                </div>
                            </div>
                            <button class="btn btn-primary js-add--daftar-pustaka-pendukung-row">Tambah Daftar Pustaka Pendukung</button>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <button class="btn btn-success" type="submit"> Simpan</button>
                    </div>
                </div>
            </form>
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

<!-- Page specific script -->
<script>
    $(document).ready(function() {
        $('#tableRps').DataTable({
            "autoWidth": true,
            "ordering": true,
        });
    });
</script>

@endsection