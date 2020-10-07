<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('vendor/img/logo.png')}}">
    <link rel="stylesheet" href="{{asset('vendor/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    @yield('css')
    <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel='stylesheet' type="text/css" href='https://fonts.googleapis.com/css?family=Titillium+Web:400,600,700,300'>
    <!--link rel="shortcut icon" href="{{asset('favicons/favicon.ico')}}" /-->
</head>
<?php
$route = Route::current();
$laman = $route->parameters['query'];
$active_rapor_mutu = '';
if($laman == 'rapor-mutu'){
    $active_rapor_mutu = ' active';
}
$active_progres_data = '';
$sub_aktif = '';
if($laman == 'progres-data'){
    $active_progres_data = ' menu-open';
    $sub_aktif = ' active';
}
?>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark navbar-teal">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
              </li>
            </ul>
        
            </nav>
          <aside class="main-sidebar sidebar-light-primary elevation-4 bg-teal text-white">
            <!-- Brand Logo -->
            <a href="{{url('/')}}" class="brand-link">
              <img src="/images/AdminLTELogo.png" alt="APM SMK" class="brand-image img-circle elevation-3"
                   style="opacity: .8">
              <span class="brand-text font-weight-light">APM SMK</span>
            </a>
        
            <!-- Sidebar -->
            <div class="sidebar">
              <!-- Sidebar user panel (optional) -->
              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                MENU
              </div>
        
              <!-- Sidebar Menu -->
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{route('page', ['query' => 'rapor-mutu'])}}" class="nav-link text-white{{$active_rapor_mutu}}">
                          <i class="nav-icon fas fa-th"></i>
                          <p>Rapor Mutu</p>
                        </a>
                      </li>
                      <li class="nav-item has-treeview {{$active_progres_data}}">
                        <a href="#" class="nav-link text-white{{$sub_aktif}}">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                            Progres Data
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="{{route('page', ['query' => 'progres-data'])}}" class="nav-link text-white{{$sub_aktif}}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Pengisian Instrumen</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link text-white">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Hitung Rapor Mutu</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link text-white">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Cetak Pakta Integritas</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link text-white">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Verval Verifikator</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link text-white">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Verval Pusat</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link text-white">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Pengesahan Pusat</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                </ul>
              </nav>
            </div>
          </aside>
        <?php
        /*$class = 'container-fluid';
        $params = request()->route()->parameters();
        if($params){
            if($params['query'] != 'home'){
                $class = 'container';
            }
        }*/
        $class = 'container';
        ?>
        <div class="content-wrapper ">
            <div class="content-header">
                <div class="container-fluid">
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        <footer class="main-footer navbar-custom">
            Copyright &copy; 2020 <a href="http://psmk.kemdikbud.go.id/" target="_blank">DIREKTORAT SEKOLAH
                MENENGAH KEJURUAN</a>.
        </footer>
    </div>
    <div id="spinner"
        style="position:fixed; top: 50%; left: 50%; margin-left: -50px; margin-top: -50px;z-index: 999999;display: none;">
        <img src="{{asset('vendor/img/ajax-loader.gif')}}" />
    </div>
    <div id="modal_content" class="modal"></div>
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    @yield('js_file')
    <script src="{{asset('vendor/adminlte/dist/js/adminlte.min.js')}}"></script>
    <script>
        $(document).bind("ajaxSend", function() {
			$("#spinner").show();
		}).bind("ajaxStop", function() {
			$("#spinner").hide();
		}).bind("ajaxError", function() {
			$("#spinner").hide();
		});
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('js')
</body>

</html>