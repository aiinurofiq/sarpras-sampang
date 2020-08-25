<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{asset('vendor/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!--link rel="shortcut icon" href="{{asset('favicons/favicon.ico')}}" /-->
    <style>
        .header{
            background-image: url('{{asset('vendor/img/bgheader-min.png')}}');
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
    </style>
</head>

<body class="layout-top-nav">
    <div class="wrapper">
        <header class="header bg-default">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="header-logo float-left my-4 mr-4">
                            <a href="{{url('/')}}"><img src="{{asset('vendor/img/kemdikbud.png')}}" alt=""
                                    class="img-responsive"></a>
                        </div>
                        <div class="header-text">
                            <h1 class="mb-0">Aplikasi Penjaminan Mutu SMK</h1>
                            <p class="lead mb-0"><strong>Direktorat Sekolah Menengah Kejuruan</strong></p>
                            <p class="lead mb-0"><strong>Direktorat Jenderal Pendidikan Vokasi</strong></p>
                            <p class="lead">Kementerian Pendidikan dan Kebudayaan</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <nav class="main-header navbar navbar-expand-lg navbar-info navbar-dark sticky-top">
            <div class="container">
                <a href="{{asset('home')}}" class="navbar-brand ml-2">
                    <span class="brand-text font-weight-light">
                        Beranda
                    </span>
                </a>
                <button class="navbar-toggler order-1 ml-2" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fas fa-bars" style="color:#fff; font-size:28px;"></i></span>
                </button>
                <div class="collapse navbar-collapse order-2 ml-2" id="navbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="{{url('/berita')}}">Berita</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/progres')}}">Progres Data</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/galeri')}}">Galeri</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/faq')}}">FAQ</a></li>
                    </ul>
                </div>
                <ul class="navbar-nav ml-auto order-3 order-md-3 navbar-no-expand">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <a class="dropdown-item" href="{{ url('app/beranda') }}">
                                Dashboard
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>
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
                <div class="container">
                </div>
            </div>
            <div class="content">
                <div class="{{$class}}">
                    @yield('content')
                </div>
            </div>
        </div>
        <footer class="main-footer bg-info">
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