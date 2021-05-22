@extends('layouts.home')

@section('title','Kepala Lab')

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
                    <li class="breadcrumb-item active">Buat - Kepala Lab</li>
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
                    <h3 class="card-title">Data Kepala Lab</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <form action="/kalab/store" method="post">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 rmk">
                                <div class="form-group">
                                    <label>RMK</label>
                                    <select name="rmk" class="form-control-lg select2" style="width: 100%;">
                                        <option disabled selected>Pilih Rumpun Mata Kuliah</option>
                                        @foreach($rmks as $rmk)
                                        <option value="{{ $rmk['id'] }}">{{ $rmk['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 jurusan">
                                <div class="form-group">
                                    <label>Dosen</label>
                                    <select name="dosen" class="form-control-lg select2" style="width: 100%;">
                                    </select>
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
        $(".dosen").hide();
    });

    // RMK
    jQuery(document).ready(function() {
        jQuery('select[name="rmk"]').on('change', function() {
            $(".dosen").hide();
            var rmkID = jQuery(this).val();
            console.log(rmkID);
            if (rmkID) {
                jQuery.ajax({
                    url: '/dropdownlist/getdosenrmk/' + rmkID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $(".dosen").show();
                        jQuery('select[name="dosen"]').empty();
                        $('select[name="dosen"]').append('<option disabled selected>Pilih Kepala Lab</option>');
                        jQuery.each(data, function(key, value) {
                            $('select[name="dosen"]').append('<option value="' + value['id'] + '">' + value['name'] + '</option>');
                        });
                    },
                });
            }
        });
    });
</script>

<script type="text/javascript">
    $("#sidebar-pt-dosen").addClass("active");
</script>


@endsection