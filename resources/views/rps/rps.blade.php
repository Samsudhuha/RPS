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
                    <li class="breadcrumb-item active">RPS - Algoritma dan Struktur Data</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Rencana Pembelajaran Semester - Algoritma dan Struktur Data</h3>
                    <div class="float-right">
                        <a class="btn btn-primary" href="/home"> Kembali </a>
                        <a class="btn btn-success" href="/rps/cetakRPS"> Cetak PDF</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="kode_matakuliah">Kode / Matakuliah</label>
                        <input type="text" class="form-control" value="VI042103 : Algoritma dan Struktur Data" disabled>
                    </div>
                    <div class="form-group">
                        <label for="jam">Jam</label>
                        <input type="text" class="form-control" value="2" disabled>
                    </div>
                    <div class="form-group">
                        <label for="sks">SKS</label>
                        <input type="text" class="form-control" value="2" disabled>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Singkat MK</label>
                        <textarea cols="20" rows="10" class="form-control" value="" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Materi Pembelajaran / Pokok Bahasan</label>
                        <textarea cols="20" rows="10" class="form-control" value="" disabled></textarea>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
    </section>
    <!-- /.container-fluid -->
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