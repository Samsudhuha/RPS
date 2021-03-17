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
                    <li class="breadcrumb-item active">RPS - {{ $mata_kuliah["name"] }}</li>
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
            <form action="/rps/edit/matakuliah/{{$mata_kuliah['id']}}" method="post">
                {{ csrf_field() }}
                <div class=" card-body">
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
                                <textarea type="text" name="deskripsi" rows="5" class="form-control">{{ $mata_kuliah['deskripsi'] }}</textarea>
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <label>Bahan Kajian</label>
                            <div id="form-bahan-kajian-list">
                                <div class="form-group">
                                    @foreach($mata_kuliah["bahan_kajian"] as $bahan_kajian)
                                    <input type="text" name="bahan_kajian[]" class="form-control" value="{{$bahan_kajian}}" style="margin-bottom: 5px;" />
                                    @endforeach
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
                                    @foreach($mata_kuliah["pustaka_utama"] as $pustaka_utama)
                                    <input type="text" name="daftar_pustaka_utama[]" class="form-control" value="{{$pustaka_utama}}" style="margin-bottom: 5px;" />
                                    @endforeach
                                </div>
                            </div>
                            <button class="btn btn-primary js-add--daftar-pustaka-utama-row">Tambah Daftar Pustaka Utama</button>
                        </div>
                        <div class="col-md-6">
                            <label>Daftar Pustaka Pendukung</label>
                            <div id="form-daftar-pustaka-pendukung-list">
                                <div class="form-group">
                                    @foreach($mata_kuliah["pustaka_pendukung"] as $pustaka_pendukung)
                                    <input type="text" name="daftar_pustaka_pendukung[]" class="form-control" value="{{$pustaka_pendukung}}" style="margin-bottom: 5px;" />
                                    @endforeach
                                </div>
                            </div>
                            <button class="btn btn-primary js-add--daftar-pustaka-pendukung-row">Tambah Daftar Pustaka Pendukung</button>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <a class="btn btn-warning edit"> Edit</a>
                        <a class="btn btn-warning batal"> Batal</a>
                        <button class="btn btn-success simpan" type="submit"> Simpan</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- CPL -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Data Capaian Pembelajaran {{ $mata_kuliah["name"] }}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <form action="/rps/edit/cplcpmk/{{$mata_kuliah['id']}}" method="post">
                {{ csrf_field() }}
                <div class=" card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Capaian Pembelajaran Lulusan</label>
                                <div class="form-group">
                                    <div class="form-check">
                                        <div class="static-cpl">
                                            @if(count($cpl_matakuliahs_id)!=0)
                                            @foreach($cpls as $cpl)
                                            @if(in_array($cpl['id'], $cpl_matakuliahs_id))
                                            <div style="margin-bottom: 10px;text-align:justify">
                                                <input class="form-check-input" type="checkbox" value="{{$cpl['id']}}" checked name="cpl[]">
                                                <label class="form-check-label">{{$cpl['name']}}</label>
                                            </div>
                                            @endif
                                            @endforeach
                                            @else
                                            @foreach($cpls as $cpl)
                                            <div style="margin-bottom: 10px;text-align:justify">
                                                <input class="form-check-input" type="checkbox" value="{{$cpl['id']}}" name="cpl[]">
                                                <label class="form-check-label">{{$cpl['name']}}</label>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                        <div class="edit-cpl">
                                            @foreach($cpls as $cpl)
                                            @if(in_array($cpl['id'], $cpl_matakuliahs_id))
                                            <div style="margin-bottom: 10px;text-align:justify">
                                                <input class="form-check-input" type="checkbox" value="{{$cpl['id']}}" checked name="cpl[]">
                                                <label class="form-check-label">{{$cpl['name']}}</label>
                                            </div>
                                            @else
                                            <div style="margin-bottom: 10px;text-align:justify">
                                                <input class="form-check-input" type="checkbox" value="{{$cpl['id']}}" name="cpl[]">
                                                <label class="form-check-label">{{$cpl['name']}}</label>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Capaian Pembelajaran Mata Kuliah</label>
                            @if(count($cpmks)!=0)
                            @foreach($cpmks as $cpmk)
                            <div id="form-cpmk-list">
                                <div class="form-group">
                                    <input type="text" name="cpmk[]" class="form-control" value="{{$cpmk['name']}}" style="margin-bottom: 5px;" />
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div id="form-cpmk-list">
                                <div class="form-group">
                                    <input type="text" name="cpmk[]" class="form-control" style="margin-bottom: 5px;" />
                                </div>
                            </div>
                            @endif
                            @if(count($cpmks)==0)
                            <button class="btn btn-primary">Tambah CPMK</button>
                            @endif
                            <button class="btn btn-primary js-add--cpmk-row">Tambah CPMK</button>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            @if(count($cpl_matakuliahs_id)!=0)
                            <a class="btn btn-warning edit-cpl-cpmk">Edit</a>
                            <a class="btn btn-warning batal-cpl-cpmk">Batal</a>
                            @else
                            <button class="btn btn-success" type="submit">Simpan</button>
                            @endif
                            <button class="btn btn-success simpan-cpl-cpmk" type="submit">Simpan</button>
                        </div>
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

<script type="text/javascript">
    $(document).ready(function() {
        $(".js-add--bahan-kajian-row").hide();
        $(".js-add--daftar-pustaka-utama-row").hide();
        $(".js-add--daftar-pustaka-pendukung-row").hide();
        $(".js-add--cpmk-row").hide();
        $(".simpan").hide();
        $(".batal").hide();
        $(".simpan-cpl-cpmk").hide();
        $(".batal-cpl-cpmk").hide();
        $(".edit-cpl").hide();
    });
    $(document).on('click', '.edit', function(e) {
        $(".edit").hide();
        $(".batal").show();
        $(".simpan").show();
        $(".js-add--bahan-kajian-row").show();
        $(".js-add--daftar-pustaka-utama-row").show();
        $(".js-add--daftar-pustaka-pendukung-row").show();
    });
    $(document).on('click', '.edit-cpl-cpmk', function(e) {
        $(".static-cpl").hide();
        $(".edit-cpl").show();
        $(".edit-cpl-cpmk").hide();
        $(".batal-cpl-cpmk").show();
        $(".simpan-cpl-cpmk").show();
        $(".js-add--cpmk-row").show();
    });
    $(document).on('click', '.batal', function(e) {
        $(".edit").show();
        $(".batal").hide();
        $(".simpan").hide();
        $(".js-add--bahan-kajian-row").hide();
        $(".js-add--daftar-pustaka-utama-row").hide();
        $(".js-add--daftar-pustaka-pendukung-row").hide();
    });

    $(document).on('click', '.batal-cpl-cpmk', function(e) {
        $(".edit-cpl-cpmk").show();
        $(".batal-cpl-cpmk").hide();
        $(".simpan-cpl-cpmk").hide();
        $(".js-add--cpmk-row").hide();
        $(".static-cpl").show();
        $(".edit-cpl").hide();
    });

    // Jurusan
    jQuery(document).ready(function() {
        jQuery('select[name="program_studi"]').on('change', function() {
            $(".jurusan").hide();
            $(".rmk").hide();
            $(".mata-kuliah").hide();
            $(".dosen").hide();
            var programStudiID = jQuery(this).val();
            if (programStudiID) {
                jQuery.ajax({
                    url: '/rps/dropdownlist/getjurusan/' + programStudiID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $(".jurusan").show();
                        jQuery('select[name="jurusan"]').empty();
                        $('select[name="jurusan"]').append('<option disabled selected>Pilih Jurusan</option>');
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
            $(".dosen").hide();
            var jurusanID = jQuery(this).val();
            if (jurusanID) {
                jQuery.ajax({
                    url: '/rps/dropdownlist/getrmk/' + jurusanID,
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
            $(".dosen").hide();
            var rmkID = jQuery(this).val();
            if (rmkID) {
                jQuery.ajax({
                    url: '/rps/dropdownlist/getmatakuliah/' + rmkID,
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
                    url: '/rps/dropdownlist/getdosen/' + jurusanID,
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
            clone.append($('<button>').addClass('btn btn-danger js-remove--bahan-kajian-row').html('Remove'));
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
            clone.append($('<button>').addClass('btn btn-danger js-remove--daftar-pustaka-utama-row').html('Remove'));
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
            clone.append($('<button>').addClass('btn btn-danger js-remove--daftar-pustaka-pendukung-row').html('Remove'));
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

    // CPMK
    (function() {
        //add rows when add button is clicked
        $(document).on('click', '.js-add--cpmk-row', function(e) {
            var clone, examsList;
            e.preventDefault();
            examsList = $('#form-cpmk-list');
            clone = examsList.children('.form-group:first').clone(true);
            clone.append($('<button>').addClass('btn btn-danger js-remove--cpmk-row').html('Remove'));
            //reset values in cloned inputs and
            //add enumerated ID's to input fields
            clone.find('input').val('').attr('id', function() {
                return $(this).attr('id') + '_' + (examsList.children('.form-group').length + 1);
            });
            return examsList.append(clone);
        });

        //remove rows when remove button is clicked
        $(document).on('click', '.js-remove--cpmk-row', function(e) {
            e.preventDefault();
            return $(this).parent().remove();
        });

    }).call(this);
</script>
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