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
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Filter<i class="fas fa-filter"></i></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tahun Kurikulum</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">2020/2021</option>
                                    <option>2019/2020</option>
                                    <option>2018/2019</option>
                                    <option>2017/2018</option>
                                    <option>2016/2017</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Semester</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">Genap</option>
                                    <option>Ganjil</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Program</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">D4</option>
                                    <option>S1</option>
                                    <option>S2</option>
                                    <option>S3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Departemen</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option selected="selected">Teknik Informatika</option>
                                    <option>Sistem Informasi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Rencana Pembelajaran Semester</h3>
                <div class="float-right">
                    <a class="btn btn-success" href="/rps/matakuliah">Tambah Data Mata Kuliah</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="tableRps" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode/Matakuliah</th>
                            <th>Bobot</th>
                            <th>Semester</th>
                            <th>Dosen Pengembang RPS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $data["kode"] }} : {{ $data["name"] }}</td>
                            <td>{{ $data["bobot"] }} SKS</td>
                            <td>{{ $data["semester"] }}</td>
                            <td>
                                <?php $nomor = 1 ?>
                                @foreach($data["dosen"] as $dosen)
                                <?php echo $nomor ?>. {{ $dosen }}
                                <br>
                                <?php $nomor++ ?>
                                @endforeach
                            </td>
                            <td>
                                <a href="/rps/{{$data['id']}}" class="btn btn-primary">Detail</a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default">Hapus</button>
                                <!-- Modal -->
                                <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <center>
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Menghapus Data Mata Kuliah</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin untuk menghapus data rencana pembelajaran semester mata kuliah
                                                    <pre>{{ $data["name"] }}?</pre>
                                                    </p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                    <form action="/rps/delete/{{$data['id']}}" method="post">
                                                        {{ csrf_field() }}
                                                        <button class=" btn btn-danger" type="submit">Hapus</button>
                                                    </form>
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                <a class="btn btn-success mt-1" href="/rps/cetakRPS/{{$data['id']}}"> Cetak PDF</a>
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
    $("#sidebar-dosen-rps").addClass("active");
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