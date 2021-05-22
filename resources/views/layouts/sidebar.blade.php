<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a class="brand-link">
        <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">RPS - {{ Auth::user()->level }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>{{ Auth::user()->name }}</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Dashboard</li>
                <li class="nav-item">
                    <a href="/home" class="nav-link" id='sidebar-home'>
                        <i class="fas fa-home"></i>
                        <p>Beranda</p>
                    </a>
                </li>
                @switch(Auth::user()->level)
                @case('Admin')
                <li class="nav-header">Data</li>
                <li class="nav-item">
                    <a href="/admin/pt" class="nav-link" id='sidebar-admin-pt'>
                        <i class="fas fa-university"></i>
                        <p>Perguruan Tinggi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/taksonomi-bloom" class="nav-link" id='sidebar-admin-taksonomi'>
                        <i class="fas fa-layer-group"></i>
                        <p>Taksonomi Bloom</p>
                    </a>
                </li>
                @break
                @case('PT')
                <li class="nav-header">Data</li>
                <li class="nav-item">
                    <a href="/pt" class="nav-link" id='sidebar-pt-pt'>
                        <i class="fas fa-university"></i>
                        <p>Perguruan Tinggi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/fakultas" class="nav-link" id='sidebar-pt-fakultas'>
                        <i class="fas fa-school"></i>
                        <p>Fakultas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/jurusan" class="nav-link" id='sidebar-pt-jurusan'>
                        <i class="far fa-building"></i>
                        <p>Departemen</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/rmk" class="nav-link" id='sidebar-pt-rmk'>
                        <i class="fas fa-book"></i>
                        <p>Rumpun Mata Kuliah</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/matakuliah" class="nav-link" id='sidebar-pt-matakuliah'>
                        <i class="fas fa-book-open"></i>
                        <p>Mata Kuliah</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dosen" class="nav-link" id='sidebar-pt-dosen'>
                        <i class="fas fa-user"></i>
                        <p>Dosen</p>
                    </a>
                </li>
                @break
                @case('Dosen')
                <li class="nav-header">Data</li>
                <li class="nav-item">
                    <a href="/rps/dosen" class="nav-link" id='sidebar-dosen-dosen'>
                        <i class="fas fa-user"></i>
                        <p>Dosen</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/rps" class="nav-link" id='sidebar-dosen-rps'>
                        <i class="fas fa-file-alt"></i>
                        <p>Rencana Pembelajaran Semester</p>
                    </a>
                </li>
                @break
                @endswitch
                <!-- <li class="nav-header">Dropdown</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Contoh Dropdown
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link" id='sidebar-dropdown-1'>
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" id='sidebar-dropdown-2'>
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" id='sidebar-dropdown-3'>
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v3</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" id='sidebar-contoh'>
                        <i class="nav-icon fas fa-th"></i>
                        <p>Contoh Sidebar<span class="right badge badge-danger">New</span></p>
                    </a>
                </li>
                <li class="nav-header">Test</li>
                <li class="nav-item">
                    <a href="#" class="nav-link" id='sidebar-test'>
                        <i class="nav-icon fas fa-ellipsis-h"></i>
                        <p>Test</p>
                    </a>
                </li> -->
            </ul>
        </nav>
    </div>
</aside>