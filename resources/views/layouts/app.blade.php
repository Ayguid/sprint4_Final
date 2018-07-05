


<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Soy Bueno en</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/pace-master/themes/white/pace-theme-flash.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/fancybox/dist/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap3-dialog/dist/css/bootstrap-dialog.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap/css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/around.css') }}" rel="stylesheet">

    @yield('header')
</head>
<body id="body"  >

<div id="app"style="background-color:rgb({{ Auth::user()->bio}})">
    <nav class="navbar navbar-default navbar-static-top navbar-around">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                  <h2 style="color:white">soyBuenoEn</h2>
                    {{-- <img src="{{ asset('images/logo.jpg') }}" alt="" /> --}}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <div class="navbar-form navbar-left">
                    <form id="custom-search-input" method="get" action="{{ url('/search') }}">
                        <div class="input-group col-md-12">
                            <input type="text" class="form-control input-lg" name="s" placeholder="Busca..algo." />
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-lg" type="button">
                                    <i class="	fa fa-search-plus"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>


                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    @include('widgets.notifications')
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle parent" data-toggle="dropdown" role="button" aria-expanded="false">

                            <img src="{{ Auth::user()->getPhoto() }}" alt="" />
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/'.Auth::user()->username) }}">
                                    <i class="	fa fa-user-circle-o"></i> Mi Perfil
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/settings') }}">
                                    <i class="fa fa-wrench"></i> Configuracion
                                </a>
                            </li>
                            <li>
                              {{-- <a href="{{ route('logout') }}"><i class="fa fa-sign-out">Logout</i> </a> --}}

                            <a href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> Logout
                             </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                               {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-content">
        @yield('content')






        <div class="" >
          @include('widgets.footer')
        </div>

    </div>




</div>
<div class="loading-page">
    <img src="{{ asset('images/rolling.gif') }}" alt="">
</div>
@include('widgets.error')
<!-- Scripts -->
<script type="text/javascript">
    var BASE_URL = "{{ url('/') }}";
    var REQUEST_URL = "<?=Request::url()?>";
    var CSRF = "{{ csrf_token() }}";
    var WALL_ACTIVE = false;
</script>
<script src="{{ asset('plugins/jquery/jquery-2.1.4.min.js')  }}"></script>
<script src="{{ asset('plugins/pace-master/pace.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/jquery.serializeJSON/jquery.serializejson.min.js') }}"></script>
<script src="{{ asset('plugins/fancybox/dist/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js') }}"></script>
<script src="{{ asset('plugins/select2/dist/js/select2.full.min.js') }}"></script>



<script src="{{ asset('plugins/gmaps/gmaps.min.js') }}"></script>
<script src="{{ asset('js/around.js') }}"></script>
<script src="{{ asset('js/wall.js') }}"></script>
<script src="{{ asset('js/notifications.js') }}"></script>

@yield('footer')

</body>
</html>
