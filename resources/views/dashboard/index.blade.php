@extends('layouts.home')

@section('title','Dashboard')

@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('custom-css')
<link href="{{url('bower_components/adminbsb-materialdesign/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
<link href="{{url('bower_components/adminbsb-materialdesign/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
<!-- Sweetalert Css -->
<link href="{{url('bower_components/adminbsb-materialdesign/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />
@endsection

@section('content')

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <p>DATA</p>
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-basic-example" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Samsu</td>
                                <td><a href="" class="btn btn-primary">Lihat</a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Ryu</td>
                                <td><a href="" class="btn btn-primary">Lihat</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-js')

<script src="{{asset('bower_components/adminbsb-materialdesign/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('bower_components/adminbsb-materialdesign/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<!-- SweetAlert Plugin Js -->
<script src="{{url('bower_components/adminbsb-materialdesign/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable({
            "autoWidth": true,
            "ordering": true,
        });
    });
    $("#sidebar-home").addClass("active");
</script>
@endsection