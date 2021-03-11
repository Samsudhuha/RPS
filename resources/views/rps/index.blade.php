@extends('layouts.home')

@section('title','Dashboard')

@section('navbar')
@include('layouts.navbar')
@endsection

@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('custom-css')
<!-- DataTables -->
<link rel="stylesheet" href="{{url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
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
                    <li class="breadcrumb-item active">List - RPS</li>
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
                    <h3 class="card-title">Filter<i class="fas fa-filter"></i></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tahun Kurikulum</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">2020/2021</option>
                                    <option>2019/2020</option>
                                    <option>2018/2019</option>
                                    <option>2017/2018</option>
                                    <option>2016/2017</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Semester</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">Genap</option>
                                    <option>Ganjil</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Program</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">D4</option>
                                    <option>S1</option>
                                    <option>S2</option>
                                    <option>S3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jurusann</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">Teknik Informatika</option>
                                    <option>Sistem Informasi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Rencana Pembelajaran Semester</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tableRps" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode/Matakuliah</th>
                            <th>Kelas</th>
                            <th>Jam</th>
                            <th>SKS</th>
                            <th>Jenis MK</th>
                            <th>Dosen Pengembang RPS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>VI42103 : Algoritma dan Struktur Data</td>
                            <td>1</td>
                            <td>2</td>
                            <td>2</td>
                            <td>Matakuliah Teori - Keahlian</td>
                            <td>Tri Hadiah Muliawati</td>
                            <td>
                                <a href="/rps/1"><i class="fas fa-eye" style="font-size: 25px;"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>VI42104 : Sistem Operasi</td>
                            <td>1</td>
                            <td>2</td>
                            <td>2</td>
                            <td>Matakuliah Teori - Keahlian</td>
                            <td>Fitri Setyorini</td>
                            <td>
                                <a href="/rps/1"><i class="fas fa-eye" style="font-size: 25px;"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>VI42105 : Basis Data</td>
                            <td>1</td>
                            <td>2</td>
                            <td>2</td>
                            <td>Matakuliah Teori - Keahlian</td>
                            <td>Arif Basori</td>
                            <td>
                                <a href="/rps/1"><i class="fas fa-eye" style="font-size: 25px;"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>VI42106 : Metode Numerik</td>
                            <td>1</td>
                            <td>2</td>
                            <td>2</td>
                            <td>Matakuliah Teori - Keahlian</td>
                            <td>Ira Prasetyaningrum</td>
                            <td>
                                <a href="/rps/1"><i class="fas fa-eye" style="font-size: 25px;"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>VI42107 : Pemrograman Web</td>
                            <td>1</td>
                            <td>2</td>
                            <td>2</td>
                            <td>Matakuliah Teori - Keahlian</td>
                            <td>Isbat Uzzin Nadhlori</td>
                            <td>
                                <a href="/rps/1"><i class="fas fa-eye" style="font-size: 25px;"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
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
<script type="text/javascript">
    $("#sidebar-home").addClass("active");
</script>
@endsection