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
                    <li class="breadcrumb-item active">Daftar - Departemen</li>
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
                <h3 class="card-title">Data Departemen</h3>
                <div class="float-right">
                    <a class="btn btn-success" href="/jurusan/create">Tambah Data Departemen</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tableRps" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fakultas</th>
                            <th>Departemen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jurusans as $data)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $data['fakultas_name'] }}</td>
                            <td>{{ $data["name"] }}</td>
                            <td>
                                <a href="/jurusan/{{$data['id']}}" class="btn btn-primary">Edit</a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default-{{$no}}">Hapus</button>
                                <!-- Modal -->
                                <div class="modal fade" id="modal-default-{{$no}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <center>
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Menghapus Data Departemen</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin untuk menghapus data departemen
                                                    <pre>{{ $data["name"] }}?</pre>
                                                    </p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                    <form action="/jurusan/delete/{{$data['id']}}" method="post">
                                                        {{ csrf_field() }}
                                                        <button class=" btn btn-danger" type="submit">Hapus</button>
                                                    </form>
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                <a href="/cpl/{{$data['id']}}" class="btn btn-success">Data Capaian Pembelajaran Lulusan</a>
                            </td>
                        </tr>
                        <?php $no++ ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
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
        $('#tableRps').DataTable({
            "autoWidth": true,
            "ordering": true,
        });
    });
</script>
<script type="text/javascript">
    $("#sidebar-pt-jurusan").addClass("active");
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