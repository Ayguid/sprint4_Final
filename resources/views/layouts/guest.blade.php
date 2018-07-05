<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
    .mySlides {
      position: absolute;
      float: left;
      display:none;
    }
  </style>
  <title>Soy Bueno en</title>

<!-- Styles -->

<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">


<link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/bootstrap/css/bootstrap-theme.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/guest.css') }}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style media="screen">
h2{
  font-size: 80px;
  font-variant: small-caps;
  color: rgb(219, 47, 36);
}
.slides img{
  opacity: 0.7;
  width: 100px;
  height:250px;
}
</style>
</head>
<body>
  <div class="slides" style="max-width:500px">
    <img class="mySlides" src="{{ asset('images/foto1.jpg') }}" style="width:100%">
    <img class="mySlides" src="{{ asset('images/foto2.jpg') }}" style="width:100%">
    <img class="mySlides" src="{{ asset('images/foto3.jpg') }}" style="width:100%">
  </div>
  <div class="banner">

    <div class="container">

      <h2>Soy Bueno En</h2>
      <div class="row">
        <div class="col-md-6">
          <h1>Una red social distinta ..... nunca tanto </h1>
          @include('widgets.usersCount')

        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <a href="{{ url('/') }}" class="logo">
          <img src="{{ asset('images/guest_logo.png') }}" alt="" />
        </a>
      </div>

      <div class="col-md-6">


        <div class="tab_container">
          <input id="tab1" type="radio" name="tabs" {{ old('tab') != 'register' ? 'checked' : '' }} class="radio_hidden">
          <label for="tab1" class="head"><span>LOGIN</span></label>

          <input id="tab2" type="radio" name="tabs" {{ old('tab') == 'register' ? 'checked' : '' }} class="radio_hidden">
          <label for="tab2" class="head"><span>Registrate</span></label>

          <div class="contents">

            <section id="content1" class="tab-content">
              @include('auth.login')
            </section>

            <section id="content2" class="tab-content">
              @include('auth.register')
            </section>

          </div>
        </div>



      </div>

    </div>


  </div>
  <div class="">
    @include('widgets.footer')
  </div>
  <!-- Scripts -->
  <script src="{{ asset('js/guest.js') }}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



  {{-- <script src="{{ asset('plugins/jquery/jquery-3.2.1.min.js') }}"></script> --}}




  <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
