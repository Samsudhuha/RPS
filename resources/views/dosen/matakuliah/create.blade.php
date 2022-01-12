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
                    <li class="breadcrumb-item"><a href="/home">Beranda</a></li>
                    <li class="breadcrumb-item active">Daftar - RPS</li>
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
                <form action="/rps/matakuliah/create" method="post">
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
                            <div class="col-md-6 mata-kuliah">
                                <div class="form-group">
                                    <label>Mata Kuliah</label>
                                    <select name="mata_kuliah" class="form-control-lg select2" style="width: 100%;">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mata-kuliah-syarat">
                                <div class="form-group">
                                    <label>Mata Kuliah Syarat</label>
                                    <select name="mata_kuliah_syarat[]" class="form-control-lg select2" multiple="multiple select2" data-placeholder="Pilih Mata Kuliah Syarat" style="width: 100%;">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 dosen">
                                <div class="form-group">
                                    <label>Dosen Pengampu</label>
                                    <select name="dosen[]" class="form-control-lg select2" multiple="multiple" data-placeholder="Pilih Dosen Pengampu" style="width: 100%;">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea type="text" name="deskripsi" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Bahan Kajian</label>
                                <div id="form-bahan-kajian-list">
                                    <div class="form-group">
                                        <input type="text" name="bahan_kajian[]" class="form-control" placeholder="Isi Bahan Kajian..." />
                                    </div>
                                </div>
                                <button class="btn btn-primary js-add--bahan-kajian-row">Tambah Bahan Kajian</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Daftar Pustaka Utama</label>
                                <div id="form-daftar-pustaka-utama-list">
                                    <div class="form-group">
                                        <input type="text" name="daftar_pustaka_utama[]" class="form-control" placeholder="Isi Daftar Pustaka Utama..."/>
                                    </div>
                                </div>
                                <button class="btn btn-primary js-add--daftar-pustaka-utama-row">Tambah Daftar Pustaka Utama</button>
                            </div>
                            <div class="col-md-6">
                                <label>Daftar Pustaka Pendukung </label><br>
                                {{-- <a class=" bg-gradient-warning p-1 mt-5"><b> Tulis '-' jika tidak ada daftar pustaka pendukung</b></a> --}}

                                <div id="form-daftar-pustaka-pendukung-list">
                                    <div class="form-group">
                                        <input type="text" name="daftar_pustaka_pendukung[]" class="form-control" placeholder="Tulis '-' jika tidak ada daftar pustaka pendukung"/>
                                    </div>
                                </div>
                                <button class="btn btn-primary js-add--daftar-pustaka-pendukung-row">Tambah Daftar Pustaka Pendukung</button><br>
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
        $(".mata-kuliah-syarat").hide();
        $(".dosen").hide();
    });

    // Fakultas
    jQuery(document).ready(function() {
        jQuery('select[name="program_studi"]').on('change', function() {
            $(".fakultas").hide();
            $(".jurusan").hide();
            $(".rmk").hide();
            $(".mata-kuliah").hide();
            $(".mata-kuliah-syarat").hide();
            $(".dosen").hide();
            var programStudiID = jQuery(this).val();
            console.log(programStudiID);
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
            $(".mata-kuliah-syarat").hide();
            $(".dosen").hide();
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
            $(".mata-kuliah-syarat").hide();
            $(".dosen").hide();
            var jurusanID = jQuery(this).val();
            if (jurusanID) {
                jQuery.ajax({
                    url: '/dropdownlist/getrmk/' + jurusanID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $(".rmk").show();
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

    // Mata Kuliah
    jQuery(document).ready(function() {
        jQuery('select[name="rmk"]').on('change', function() {
            $(".mata-kuliah").hide();
            $(".mata-kuliah-syarat").hide();
            $(".dosen").hide();
            var rmkID = jQuery(this).val();
            if (rmkID) {
                jQuery.ajax({
                    url: '/dropdownlist/getmatakuliah/' + rmkID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $(".mata-kuliah").show();
                        jQuery('select[name="mata_kuliah"]').empty();
                        $('select[name="mata_kuliah"]').append('<option disabled selected>Pilih Mata Kuliah</option>');
                        jQuery.each(data, function(key, value) {
                            $('select[name="mata_kuliah"]').append('<option value="' + value['id'] + '">' + value['name'] + '</option>');
                        });
                    },
                });
            }
        });
    });

    // Dosen
    jQuery(document).ready(function() {
        jQuery('select[name="mata_kuliah"]').on('change', function() {
            $(".dosen").show();
        });
    });
    jQuery(document).ready(function() {
        jQuery('select[name="jurusan"]').on('change', function() {
            var jurusanID = jQuery(this).val();
            if (jurusanID) {
                jQuery.ajax({
                    url: '/dropdownlist/getdosen/' + jurusanID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        jQuery('select[name="dosen[]"]').empty();
                        jQuery.each(data, function(key, value) {
                            $('select[name="dosen[]"]').append('<option value="' + value['id'] + '">' + value['name'] + '</option>');
                        });
                    }
                });
            }
        });
    });

    // Mata Kuliah Syarat
    jQuery(document).ready(function() {
        jQuery('select[name="mata_kuliah"]').on('change', function() {
            $(".mata-kuliah-syarat").hide();
            var matakuliahID = jQuery(this).val();
            console.log(matakuliahID);
            if (matakuliahID) {
                jQuery.ajax({
                    url: '/dropdownlist/getmatakuliahsyarat/' + matakuliahID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $(".mata-kuliah-syarat").show();
                        jQuery('select[name="mata_kuliah_syarat[]"]').empty();
                        jQuery.each(data, function(key, value) {
                            $('select[name="mata_kuliah_syarat[]"]').append('<option value="' + value['id'] + '">' + value['name'] + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>

<!-- Dynamic Form -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
<script type="text/javascript">
    // Bahan Kajian
    (function() {
        //add rows when add button is clicked
        $(document).on('click', '.js-add--bahan-kajian-row', function(e) {
            var clone, examsList;
            e.preventDefault();
            examsList = $('#form-bahan-kajian-list');
            clone = examsList.children('.form-group:first').clone(true);
            clone.append($('<button>').addClass('btn btn-danger js-remove--bahan-kajian-row mt-1').html('Hapus'));
            //reset values in cloned inputs and
            //add enumerated ID's to input fields
            clone.find('input').val('').attr('id', function() {
                return $(this).attr('id') + '_' + (examsList.children('.form-group').length + 1);
            });
            return examsList.append(clone);
        });

        //remove rows when remove button is clicked
        $(document).on('click', '.js-remove--bahan-kajian-row', function(e) {
            e.preventDefault();
            return $(this).parent().remove();
        });

    }).call(this);

    // Daftar Pustaka Utama
    (function() {
        //add rows when add button is clicked
        $(document).on('click', '.js-add--daftar-pustaka-utama-row', function(e) {
            var clone, examsList;
            e.preventDefault();
            examsList = $('#form-daftar-pustaka-utama-list');
            clone = examsList.children('.form-group:first').clone(true);
            clone.append($('<button>').addClass('btn btn-danger js-remove--daftar-pustaka-utama-row mt-1').html('Hapus'));
            //reset values in cloned inputs and
            //add enumerated ID's to input fields
            clone.find('input').val('').attr('id', function() {
                return $(this).attr('id') + '_' + (examsList.children('.form-group').length + 1);
            });
            return examsList.append(clone);
        });

        //remove rows when remove button is clicked
        $(document).on('click', '.js-remove--daftar-pustaka-utama-row', function(e) {
            e.preventDefault();
            return $(this).parent().remove();
        });

    }).call(this);

    // Daftar Pustaka Pendukung
    (function() {
        //add rows when add button is clicked
        $(document).on('click', '.js-add--daftar-pustaka-pendukung-row', function(e) {
            var clone, examsList;
            e.preventDefault();
            examsList = $('#form-daftar-pustaka-pendukung-list');
            clone = examsList.children('.form-group:first').clone(true);
            clone.append($('<button>').addClass('btn btn-danger js-remove--daftar-pustaka-pendukung-row mt-1').html('Hapus'));
            //reset values in cloned inputs and
            //add enumerated ID's to input fields
            clone.find('input').val('').attr('id', function() {
                return $(this).attr('id') + '_' + (examsList.children('.form-group').length + 1);
            });
            return examsList.append(clone);
        });

        //remove rows when remove button is clicked
        $(document).on('click', '.js-remove--daftar-pustaka-pendukung-row', function(e) {
            e.preventDefault();
            return $(this).parent().remove();
        });

    }).call(this);
</script>
<script type="text/javascript">
    $("#sidebar-rps-create").addClass("active");
</script>


@endsection