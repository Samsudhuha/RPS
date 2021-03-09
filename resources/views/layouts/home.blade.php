<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('title') | RPS {{ date("Y") }}</title>
    <!-- Favicon-->
    <link rel="icon" href="{{url('bower_components/adminbsb-materialdesign/favicon.ico')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    @section('include-css')
    <!-- Bootstrap Core Css -->
    <link href="{{url('bower_components/adminbsb-materialdesign/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{url('bower_components/adminbsb-materialdesign/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{url('bower_components/adminbsb-materialdesign/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{url('bower_components/adminbsb-materialdesign/css/style.css')}}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{url('bower_components/adminbsb-materialdesign/css/themes/theme-green.css')}}" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('css/jquery.loading.min.css')}}">
    @show

    @yield('custom-css')
</head>

<body class="theme-green">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar" style="background-color: #2249aa;">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="{{url('/home')}}" style="color: white;">
                    RPS
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons" style="color: white">more_vert</i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/logout')}}"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <!-- <div class="user-info" style="background: url('/img/sidebar-background.jpg') no-repeat; background-size: 300px 150px">
                <div class="info-container">
                </div>
            </div> -->
            <!-- #User Info -->
            @yield('sidebar')
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; {{ date("Y") }}
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li><a href="/home">Home</a></li>
                @for($i = 1; $i <= count(Request::segments()); $i++) @if (Request::segment($i) !='home' ) @if ($i==count(Request::segments())) <li class="active">{{ucwords(Request::segment($i))}}</li>
                    @else
                    <li><a href="/{{Request::segment($i)}}">{{ucwords(Request::segment($i))}}</a></li>
                    @endif
                    @endif
                    @endfor
            </ol>
            @yield('content')
        </div>
    </section>
    @section('include-js')
    <!-- Jquery Core Js -->
    <script src="{{url('bower_components/adminbsb-materialdesign/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{url('bower_components/adminbsb-materialdesign/plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Select Plugin Js -->
    <script src="{{url('bower_components/adminbsb-materialdesign/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{url('bower_components/adminbsb-materialdesign/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{url('bower_components/adminbsb-materialdesign/plugins/node-waves/waves.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{url('bower_components/adminbsb-materialdesign/js/admin.js')}}"></script>

    <!-- Demo Js -->
    <script src="{{url('bower_components/adminbsb-materialdesign/js/demo.js')}}"></script>
    <script src="{{asset('js/jquery.loading.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    @show

    @yield('custom-js')
</body>

</html>