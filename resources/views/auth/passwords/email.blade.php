<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap/css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/guest.css') }}" rel="stylesheet">
    <style media="screen">
      h2{
        font-size: 80px;
        font-variant: small-caps;
        color: rgb(219, 47, 36);
      }
    </style>
</head>
<body>

<div class="banner">

    <div class="container">
      <h2>Soy Bueno En</h2>
        <div class="row">

            <div class="col-md-6">
              <h1>Una red social distinta ..... nunca tanto </h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      {{-- <button class="tab_container home" type="button" name="button" onclick="window.location.href='/'" >HOME</button> --}}
      <a href="{{ url('/') }}" class="logo">
        <img src="{{ asset('images/guest_logo.png') }}" alt="" />
      </a>
    </div>

    <div class="col-md-6">


      <div class="tab_container">
        <input id="tab1" type="radio" name="tabs" {{ old('tab') != 'register' ? 'checked' : '' }} class="radio_hidden" onclick="window.location.href='/'" >
        <label for="tab1" class="head"><span>Home</span></label>


        <div class="contents">
          <section id="content1" class="tab-content">
            <div class="panel panel-default">
              <div class="panel-heading">Reset Password</div>
              <div class="panel-body">
                @if (session('status'))
                  <div class="alert alert-success">
                    {{ session('status') }}
                  </div>
                @endif

                <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                  {{ csrf_field() }}

                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                    <div class="row-md-6">
                      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                      @if ($errors->has('email'))
                        <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                      <button type="submit" class="btn btn-primary">
                        Send Password Reset Link
                      </button>

                    </div>
                  </div>
                </form>
              </div>
            </div>
          </section>
        </div>
      </div>



    </div>

  </div>


</div>

@include('widgets.footer')


<!-- Scripts -->

<script src="{{ asset('plugins/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
