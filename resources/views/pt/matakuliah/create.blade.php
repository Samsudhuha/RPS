@extends('layouts.home')

@section('title','Mata Kuliah')

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
                    <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
                    <li class="breadcrumb-item active">Buat - Mata Kuliah</li>
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
                    <h3 class="card-title">Data Mata Kuliah</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <form action="/matakuliah/store" method="post">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Program Studi</label>
                                    <select name="program_studi" class="form-control-lg select2" style="width: 100%;" value="{{ old('program_studi') }}">
                                        <option disabled selected>Pilih Program Studi</option>
                                        @foreach($program_studis as $program_studi)
                                        <option value="{{ $program_studi->id }}">{{ $program_studi->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 fakultas">
                                <div class="form-group">
                                    <label>Fakultas</label>
                                    <select name="fakultas" class="form-control-lg select2" style="width: 100%;">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 jurusan">
                                <div class="form-group">
                                    <label>Departemen</label>
                                    <select name="jurusan" class="form-control-lg select2" style="width: 100%;">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 rmk">
                                <div class="form-group">
                                    <label>RMK</label>
                                    <select name="rmk" class="form-control-lg select2" style="width: 100%;">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 kode-mata-kuliah">
                                <div class="form-group">
                                    <label>Kode Mata Kuliah</label>
                                    <input type="text" name="kode" class="form-control" placeholder="Kode Mata Kuliah" />
                                </div>
                            </div>
                            <div class="col-md-6 mata-kuliah">
                                <div class="form-group">
                                    <label>Mata Kuliah</label>
                                    <input type="text" name="user" class="form-control" value="{{ $id }}" hidden />
                                    <input type="text" name="matakuliah" class="form-control" placeholder="Nama Mata Kuliah" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 bobot">
                                <div class="form-group">
                                    <label>Jumlah SKS</label>
                                    <input type="number" name="sks" class="form-control" placeholder="Jumlah SKS" />
                                </div>
                            </div>
                            <div class="col-md-6 semester">
                                <div class="form-group">
                                    <label>Semester</label>
                                    <input type="number" name="semester" class="form-control" placeholder="Semester" />
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
        </div>
    </section>
</div>

@endsection

@section('custom-js')
<!-- Get List Dropdown -->
<script type="text/javascript">
    $(document).ready(function() {
        $(".fakultas").hide();
        $(".jurusan").hide();
        $(".rmk").hide();
        $(".mata-kuliah").hide();
        $(".kode-mata-kuliah").hide();
        $(".bobot").hide();
        $(".semester").hide();
    });

    // Fakultas
    jQuery(document).ready(function() {
        jQuery('select[name="program_studi"]').on('change', function() {
            $(".fakultas").hide();
            $(".jurusan").hide();
            $(".rmk").hide();
            $(".mata-kuliah").hide();
            $(".kode-mata-kuliah").hide();
            $(".bobot").hide();
            $(".semester").hide();
            var programStudiID = jQuery(this).val();
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

    // Jurusan
    jQuery(document).ready(function() {
        jQuery('select[name="fakultas"]').on('change', function() {
            $(".jurusan").hide();
            $(".rmk").hide();
            $(".mata-kuliah").hide();
            $(".kode-mata-kuliah").hide();
            $(".bobot").hide();
            $(".semester").hide();
            var programStudiID = jQuery(this).val();
            if (programStudiID) {
                jQuery.ajax({
                    url: '/dropdownlist/getjurusan/' + programStudiID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $(".jurusan").show();
                        jQuery('select[name="jurusan"]').empty();
                        $('select[name="jurusan"]').append('<option disabled selected>Pilih Departemen</option>');
                        jQuery.each(data, function(key, value) {
                            $('select[name="jurusan"]').append('<option value="' + value['id'] + '">' + value['name'] + '</option>');
                        });
                    }
                });
            }
        });
    });

    // RMK
    jQuery(document).ready(function() {
        jQuery('select[name="jurusan"]').on('change', function() {
            $(".rmk").hide();
            $(".mata-kuliah").hide();
            $(".bobot").hide();
            $(".semester").hide();
            var jurusanID = jQuery(this).val();
            if (jurusanID) {
                jQuery.ajax({
                    url: '/dropdownlist/getrmk/' + jurusanID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $(".rmk").show();
                        $(".mata-kuliah").show();
                        $(".kode-mata-kuliah").show();
                        $(".bobot").show();
                        $(".semester").show();
                        jQuery('select[name="rmk"]').empty();
                        $('select[name="rmk"]').append('<option disabled selected>Pilih RMK</option>');
                        jQuery.each(data, function(key, value) {
                            $('select[name="rmk"]').append('<option value="' + value['id'] + '">' + value['name'] + '</option>');
                        });
                    },
                });
            }
        });
    });
</script>

<script type="text/javascript">
    $("#sidebar-pt-matakuliah").addClass("active");
</script>


@endsection