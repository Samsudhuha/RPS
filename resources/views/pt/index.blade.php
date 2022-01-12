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
        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 text-center">
                        <a href="/pt">
                            <div class="card bg-light">
                                <div class="card-header text-muted border-bottom-0">
                                    Data Perguruan Tinggi
                                </div>
                                <div class="card-body">
                                    <i class="fas fa-university" style="font-size:100px"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 text-center">
                        <a href="/fakultas">
                            <div class="card bg-light">
                                <div class="card-header text-muted border-bottom-0">
                                    Data Fakultas
                                </div>
                                <div class="card-body">
                                    <i class="fas fa-school" style="font-size:100px"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 text-center">
                        <a href="/jurusan">
                            <div class="card bg-light">
                                <div class="card-header text-muted border-bottom-0">
                                    Data Departemen
                                </div>
                                <div class="card-body">
                                    <i class="far fa-building" style="font-size:100px"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 text-center">
                        <a href="/rmk">
                            <div class="card bg-light">
                                <div class="card-header text-muted border-bottom-0">
                                    Data Rumpun Mata Kuliah
                                </div>
                                <div class="card-body">
                                    <i class="fas fa-book" style="font-size:100px"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 text-center">
                        <a href="/matakuliah">
                            <div class="card bg-light">
                                <div class="card-header text-muted border-bottom-0">
                                    Data Mata Kuliah
                                </div>
                                <div class="card-body">
                                    <i class="fas fa-book-open" style="font-size:100px"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 text-center">
                        <a href="/dosen">
                            <div class="card bg-light">
                                <div class="card-header text-muted border-bottom-0">
                                    Data Dosen
                                </div>
                                <div class="card-body">
                                    <i class="fas fa-user" style="font-size:100px"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.container-fluid -->
</div>

@endsection

@section('custom-js')

<script src="{{url('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{url('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{url('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{url('plugins/sweetalert2/sweetalert2.min.js')}}"></script>

<script type="text/javascript">
    $("#sidebar-home").addClass("active");
</script>

@endsection