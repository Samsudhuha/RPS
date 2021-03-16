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
                    <h3 class="card-title"> Pengisian RPS</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mata Kuliah</label>
                                <select class="form-control-lg select2" data-placeholder="Pilih RMK" style="width: 100%; height: 37px;">
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label for="kode_matakuliah">Rumpun Mata Kuliah</label>
                                <input type="text" class="form-control" value="Grafika, Interaksi, dan Games" disabled>
                             </div>
                            <div class="form-group">
                                <label for="kode_matakuliah">Semester</label>
                                <input type="text" class="form-control" value="3" disabled>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode_matakuliah">Kode Mata Kuliah</label>
                                <input type="text" class="form-control" value="IF185932" disabled>
                             </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label for="kode_matakuliah">Bobot (SKS)</label>
                                <input type="text" class="form-control" value="3" disabled>
                            </div>
                            <div class="form-group">
                        <label>Deskripsi Singkat MK</label>
                        <textarea class="form-control" rows="3" placeholder="Deskripsi Mata Kuliah ..."></textarea>
                      </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-12 col-sm-6">
                        <div class="form-group">
                        <label>Bahan Kajian</label>
                        <textarea class="form-control" rows="3" placeholder="Bahan Kajian ..."></textarea>
                      </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6">
                        <div class="form-group">
                        <label>Daftar Pustaka</label>
                        <textarea class="form-control" rows="3" placeholder="Daftar Pustaka ..."></textarea>
                      </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <div class="float-right">
                    <a class="btn btn-success" href="/rps/home"> Simpan</a>
                </div>
                </div>
            </div>
        </div>
        <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"> CPL / CPMK</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-12 col-sm-6">
                        <div class="form-group">
                        <label>Bahan Kajian</label>
                        <textarea class="form-control" rows="3" placeholder="Bahan Kajian ..."></textarea>
                      </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6">
                        <div class="form-group">
                        <label>Daftar Pustaka</label>
                        <textarea class="form-control" rows="3" placeholder="Daftar Pustaka ..."></textarea>
                      </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <div class="float-right">
                    <a class="btn btn-success" href="/rps/home"> Simpan</a>
                </div>
                </div>
            </div>

    </section>

    @endsection

    @section('custom-js')

    <script type="text/javascript">
        $("#sidebar-rps-create").addClass("active");
    </script>


    @endsection