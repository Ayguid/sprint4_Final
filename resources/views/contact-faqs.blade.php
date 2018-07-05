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
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('images/guest_logo.png') }}" alt="" />
            </a>
        </div>

        <div class="col-md-6">

<button class="tab_container home" type="button" name="button" onclick="window.location.href='/'" >HOME</button>
            <div class="tab_container">

                <input id="tab1" type="radio" name="tabs" {{ old('tab') != 'register' ? 'checked' : '' }} class="radio_hidden">
                <label for="tab1" class="head"></i><span>FAQs</span></label>

                <input id="tab2" type="radio" name="tabs" {{ old('tab') == 'register' ? 'checked' : '' }} class="radio_hidden">
                <label for="tab2" class="head"></i><span>Contact</span></label>

                <div class="contents">
                    <section id="content1" class="tab-content">
                      <h2>Preguntas Frecuentes</h2>

                        <ul>
                          <li> Que es "SOY BUENO EN"? <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, illo quas nulla voluptatum, ipsa, quae, magni vero eaque earum cupiditate dolore! Quidem nesciunt omnis provident voluptate dolores reprehenderit amet consectetur?</p></li>
                          <li> Que servicios puedo ofrecer en este sitio?<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, illo quas nulla voluptatum, ipsa, quae, magni vero eaque earum cupiditate dolore! Quidem nesciunt omnis provident voluptate dolores reprehenderit amet consectetur?</p></li>
                          <li> Cuales son sus politicas de privacidad?<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, illo quas nulla voluptatum, ipsa, quae, magni vero eaque earum cupiditate dolore! Quidem nesciunt omnis provident voluptate dolores reprehenderit amet consectetur?</p></li>
                          <li> Como hago para seguir a mis amigos?<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, illo quas nulla voluptatum, ipsa, quae, magni vero eaque earum cupiditate dolore! Quidem nesciunt omnis provident voluptate dolores reprehenderit amet consectetur?</p></li>
                          <li> Que metodos de pago acepta el sitio?<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, illo quas nulla voluptatum, ipsa, quae, magni vero eaque earum cupiditate dolore! Quidem nesciunt omnis provident voluptate dolores reprehenderit amet consectetur?</p></li>
                          <li> El envio corre por parte del vendedor?<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, illo quas nulla voluptatum, ipsa, quae, magni vero eaque earum cupiditate dolore! Quidem nesciunt omnis provident voluptate dolores reprehenderit amet consectetur?</p></li>
                          <li> Que hago en caso de un envio perdido?<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, illo quas nulla voluptatum, ipsa, quae, magni vero eaque earum cupiditate dolore! Quidem nesciunt omnis provident voluptate dolores reprehenderit amet consectetur?</p></li>
                          <li> Gano puntos por recomendar amigos?<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, illo quas nulla voluptatum, ipsa, quae, magni vero eaque earum cupiditate dolore! Quidem nesciunt omnis provident voluptate dolores reprehenderit amet consectetur?</p></li>
                        </ul>


                    </section>

                    <section id="content2" class="tab-content">

                <h2>Contacto</h2>

                <h4><a href="mailto:contacto@soybuenoen.com">contacto@soybuenoen.com</a></h4>
                <h4 >Telefono: (15)4444-4444</h4>
                <h4><a target="_blank" href="https://www.instagram.com/_digitalhouse/">Instagram <img src="./images/ig.png" alt="" width="100px"></h4>


                    </section>
                </div>
            </div>



        </div>

    </div>


    @include('widgets.footer')
</div>


<!-- Scripts -->
<script src="{{ asset('plugins/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
