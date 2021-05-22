@extends('layouts.home')

@section('title','Dashboard')

@section('navbar')
@include('layouts.navbar')
@endsection

@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('custom-css')
<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="header">
                            <div class="old">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <h5>Nama</h5>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <h5>: {{ $dosen->name }} </h5>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <h5>NIDN</h5>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <h5>: {{ $dosen->username }} </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="new">
                                <form action="/rps/dosen/updateDosen" method="post">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <h5>Nama</h5>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                            <input type="text" name="name" class="form-control" value="{{$dosen->name}}" />
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <h5>NIDN</h5>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                            <input type="text" name="nidn" class="form-control" value="{{$dosen->username}}" />
                                        </div>
                                    </div>
                                    <br>
                                    <div class="float-right">
                                        <button class="btn btn-danger" id="batalEdit" type="button">Batal</button>
                                        <button class="btn btn-success" id="simpan" type="submit">Simpan</button>
                                    </div>
                                </form>
                            </div>
                            <br>
                            <!-- <div class="card-footer"> -->
                                <div class="float-right mb-2">
                                    <button class="btn btn-warning" id="edit">Edit</button>
                                </div>
                            <!-- </div> -->
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Ubah Password</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <form action="/rps/dosen/updatePassword" method="post">
                {{ csrf_field() }}
                <div class=" card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Password Lama</label>
                            <div class="form-group">
                                <input type="text" name="oldPassword" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Password Baru</label>
                            <div class="form-group">
                                <input type="text" name="newPassword" class="form-control" />
                            </div>
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
    <!-- /.container-fluid -->
</div>

@endsection

@section('custom-js')

<script src="{{url('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{url('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{url('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{url('plugins/sweetalert2/sweetalert2.min.js')}}"></script>

<script type="text/javascript">
    $("#sidebar-dosen-dosen").addClass("active");
</script>
<script>
    $(document).ready(function() {
        $("#simpan").hide();
        $("#batalEdit").hide();
        $(".new").hide();
    });

    $(document).on('click', '#edit', function(e) {
        $("#simpan").show();
        $("#batalEdit").show();
        $(".new").show();
        $(".old").hide();
        $("#edit").hide();
    });

    $(document).on('click', '#batalEdit', function(e) {
        $("#simpan").hide();
        $("#batalEdit").hide();
        $(".new").hide();
        $(".old").show();
        $("#edit").show();
    });
</script>
@endsection