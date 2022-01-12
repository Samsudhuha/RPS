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
                    <li class="breadcrumb-item active">Perguruan Tinggi</li>

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
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                    <h5>Nama Perguruan Tinggi</h5>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <h5>: {{ $pt->name }} </h5>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                    <h5>NPSN</h5>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <h5>: {{ $pt->username }} </h5>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                    <h5>Logo</h5>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    @if($pt->logo == null)
                                    <h5>:</h5>
                                    <form action="pt/uploadFoto" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type='file' name="file" onchange="readURL(this);" />
                                        <button class="btn btn-success" type="submit"> Simpan</button>
                                    </form>
                                    <img id="blah" src="#" alt="your image" />
                                    @else
                                    :
                                    <img src="{{ url($pt->logo) }}" alt="your image" style="height: 200px; width:200px" />
                                    @endif
                                </div>
                            </div>
                            <br>
                            @if($pt->logo != null)
                                <div class="float-right">
                                    <button class="btn btn-warning mb-2" id="editLogo">Edit Logo</button>
                                </div>
                            <div class="row" id="formEditLogo">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                    <!-- <button class="btn btn-warning" id="batalEditLogo">Batal Edit Logo</button> -->
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    : <form action="pt/uploadFoto" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type='file' name="file" onchange=" readURL(this);" />
                                            <!-- <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 mt-1 float-left"> -->
                                            <div class="float-right mb-2">
                                                <button class="btn btn-warning" id="batalEditLogo">Batal Edit Logo</button>
                                                <button class="btn btn-success" type="submit"> Simpan</button>
                                            <!-- </div> -->
                                        </form>
                                    <img id="blah" src="#" alt="your image" />
                                </div>
                            </div>
                            @endif
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Ubah Password</h3>
                {{-- <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div> --}}
            </div>
            <form action="/pt/updatePassword" method="post">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Password Lama</label>
                            <div class="form-group">
                                <input type="password" id="myInput" name="oldPassword" class="form-control" />
                                <input type="checkbox" onclick="myFunction()" class="form-check-label"> Tampilkan Password
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Password Baru</label>
                            <div class="form-group">
                                <input type="password" name="newPassword" class="form-control" />
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


@endsection

@section('custom-js')

<script src="{{url('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{url('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{url('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{url('plugins/sweetalert2/sweetalert2.min.js')}}"></script>

<script type="text/javascript">
    $("#sidebar-pt-pt").addClass("active");
</script>
<script>
    $(document).ready(function() {
        $("#blah").hide();
        $("#formEditLogo").hide();
        $("#batalEditLogo").hide();
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(200);
                $('#blah').show()
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('click', '#editLogo', function(e) {
        $("#formEditLogo").show();
        $("#batalEditLogo").show();
        $("#editLogo").hide();
    });

    function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    $(document).on('click', '#batalEditLogo', function(e) {
        $("#formEditLogo").hide();
        $("#batalEditLogo").hide();
        $("#editLogo").show();
});
</script>
@endsection