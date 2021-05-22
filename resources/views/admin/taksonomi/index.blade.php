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
<link rel="stylesheet" href="{{url('plugins/sweetalert2/sweetalert2.min.css')}}">
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
                    <li class="breadcrumb-item active">Daftar - Taksonomi Bloom</li>
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

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Taksonomi Bloom</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Remember</h3>
                        <div class="float-right">
                            <a class="btn btn-success" href="/admin/taksonomi-bloom/create/remember">Tambah Data Taksonomi Bloom - Remember</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tableRemember" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Kata Kunci</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($remembers as $data)
                                <tr>
                                    <td>{{ $data["name"] }}</td>
                                    <td>
                                        {{-- <a href="/admin/taksonomi-bloom/{{$data['id']}}" class="btn btn-warning">Edit</a> --}}
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-remember-{{$data['id']}}">Hapus</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-remember-{{$data['id']}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <center>
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Menghapus Data Taksonomi Bloom</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin untuk menghapus data taksonomi bloom
                                                            <pre>{{ $data["name"] }}?</pre>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                            <form action="/admin/taksonomi-bloom/delete/{{$data['id']}}" method="post">
                                                                {{ csrf_field() }}
                                                                <button class=" btn btn-danger" type="submit">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Understand</h3>
                        <div class="float-right">
                            <a class="btn btn-success" href="/admin/taksonomi-bloom/create/understand">Tambah Data Taksonomi Bloom - Understand</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tableUnderstand" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Kata Kunci</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($understands as $data)
                                <tr>
                                    <td>{{ $data["name"] }}</td>
                                    <td>
                                        {{-- <a href="/admin/taksonomi-bloom/{{$data['id']}}" class="btn btn-warning">Edit</a> --}}
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-understand-{{$data['id']}}">Hapus</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-understand-{{$data['id']}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <center>
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Menghapus Data Taksonomi Bloom</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin untuk menghapus data taksonomi bloom
                                                            <pre>{{ $data["name"] }}?</pre>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                            <form action="/admin/taksonomi-bloom/delete/{{$data['id']}}" method="post">
                                                                {{ csrf_field() }}
                                                                <button class=" btn btn-danger" type="submit">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Apply</h3>
                        <div class="float-right">
                            <a class="btn btn-success" href="/admin/taksonomi-bloom/create/apply">Tambah Data Taksonomi Bloom - Apply</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tableApply" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Kata Kunci</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applys as $data)
                                <tr>
                                    <td>{{ $data["name"] }}</td>
                                    <td>
                                        {{-- <a href="/admin/taksonomi-bloom/{{$data['id']}}" class="btn btn-warning">Edit</a> --}}
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-apply-{{$data['id']}}">Hapus</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-apply-{{$data['id']}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <center>
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Menghapus Data Taksonomi Bloom</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin untuk menghapus data taksonomi bloom
                                                            <pre>{{ $data["name"] }}?</pre>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                            <form action="/admin/taksonomi-bloom/delete/{{$data['id']}}" method="post">
                                                                {{ csrf_field() }}
                                                                <button class=" btn btn-danger" type="submit">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Analyze</h3>
                        <div class="float-right">
                            <a class="btn btn-success" href="/admin/taksonomi-bloom/create/analyze">Tambah Data Taksonomi Bloom - Analyze</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tableAnalyze" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Kata Kunci</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($analyzes as $data)
                                <tr>
                                    <td>{{ $data["name"] }}</td>
                                    <td>
                                        {{-- <a href="/admin/taksonomi-bloom/{{$data['id']}}" class="btn btn-warning">Edit</a> --}}
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-analyze-{{$data['id']}}">Hapus</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-analyze-{{$data['id']}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <center>
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Menghapus Data Taksonomi Bloom</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin untuk menghapus data taksonomi bloom
                                                            <pre>{{ $data["name"] }}?</pre>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                            <form action="/admin/taksonomi-bloom/delete/{{$data['id']}}" method="post">
                                                                {{ csrf_field() }}
                                                                <button class=" btn btn-danger" type="submit">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Evaluate</h3>
                        <div class="float-right">
                            <a class="btn btn-success" href="/admin/taksonomi-bloom/create/evaluate">Tambah Data Taksonomi Bloom - Evaluate</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tableEvaluate" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Kata Kunci</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($evaluates as $data)
                                <tr>
                                    <td>{{ $data["name"] }}</td>
                                    <td>
                                        {{-- <a href="/admin/taksonomi-bloom/{{$data['id']}}" class="btn btn-warning">Edit</a> --}}
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-evaluate-{{$data['id']}}">Hapus</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-evaluate-{{$data['id']}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <center>
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Menghapus Data Taksonomi Bloom</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin untuk menghapus data taksonomi bloom
                                                            <pre>{{ $data["name"] }}?</pre>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                            <form action="/admin/taksonomi-bloom/delete/{{$data['id']}}" method="post">
                                                                {{ csrf_field() }}
                                                                <button class=" btn btn-danger" type="submit">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create</h3>
                        <div class="float-right">
                            <a class="btn btn-success" href="/admin/taksonomi-bloom/create/create">Tambah Data Taksonomi Bloom - Create</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tableCreate" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Kata Kunci</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($creates as $data)
                                <tr>
                                    <td>{{ $data["name"] }}</td>
                                    <td>
                                        {{-- <a href="/admin/taksonomi-bloom/{{$data['id']}}" class="btn btn-warning">Edit</a> --}}
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-create-{{$data['id']}}">Hapus</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-create-{{$data['id']}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <center>
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Menghapus Data Taksonomi Bloom</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin untuk menghapus data taksonomi bloom
                                                            <pre>{{ $data["name"] }}?</pre>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                            <form action="/admin/taksonomi-bloom/delete/{{$data['id']}}" method="post">
                                                                {{ csrf_field() }}
                                                                <button class=" btn btn-danger" type="submit">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
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
<script src="{{url('plugins/sweetalert2/sweetalert2.min.js')}}"></script>

<!-- Page specific script -->
<script>
    $(document).ready(function() {
        $('#tableRemember').DataTable({
            "autoWidth": true,
            "ordering": true,
        });
    });
    $(document).ready(function() {
        $('#tableUnderstand').DataTable({
            "autoWidth": true,
            "ordering": true,
        });
    });
    $(document).ready(function() {
        $('#tableApply').DataTable({
            "autoWidth": true,
            "ordering": true,
        });
    });
    $(document).ready(function() {
        $('#tableAnalyze').DataTable({
            "autoWidth": true,
            "ordering": true,
        });
    });
    $(document).ready(function() {
        $('#tableEvaluate').DataTable({
            "autoWidth": true,
            "ordering": true,
        });
    });
    $(document).ready(function() {
        $('#tableCreate').DataTable({
            "autoWidth": true,
            "ordering": true,
        });
    });
</script>
<script type="text/javascript">
    $("#sidebar-admin-taksonomi").addClass("active");
</script>

<!-- Sweet Alert -->
<script>
    const deletebtn = document.querySelector('#delete');
    deletebtn.addEventListener('click', (e) => {
        Swal.fire({
            title: 'Anda yakin menghapus ini?',
            text: "File yang terhapus tidak akan dapat kembali",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Hapus',
                    'File anda berhasil dihapus.',
                    'success'
                )
            }
        })
    })
</script>
@endsection