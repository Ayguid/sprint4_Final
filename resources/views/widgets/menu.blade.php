<div class="menu">
    <ul class="list-group">
        {{-- <li class="list-group-item">
            <a href="{{ url('/') }}" class="menu-home">
              <i class="fas fa-align-justify"></i>


                Home
            </a>
        </li> --}}

        <li class="list-group-item">
            <a href="{{ url('/direct-messages') }}" class="menu-dm">
              <i class="fa fa-envelope" style="color:black;" aria-hidden="true"></i>

                Mensajes directos
            </a>
        </li>
        <li class="list-group-item">

          <a class="menu-dm" href="{{ url('/'.$user->username) }}">
            <i class="	fa fa-send" style="color:black;" aria-hidden="true"></i>
              {{ $user->posts()->count() }}          Posts
          </a>

        </li>
        <li class="list-group-item">
          <a class="menu-dm" href="{{ url('/'.$user->username.'/following') }}">
            <i class="	fa fa-eye" style="color:black;" aria-hidden="true"></i>
            Siguiendo  {{ $user->following()->where('allow', 1)->count().' ' }}usuarios

          </a>

        </li>
        <li class="list-group-item">
          <a class="menu-dm" href="{{ url('/'.$user->username.'/followers') }}">
              <i class="	fa fa-eye-slash" style="color:black;" aria-hidden="true"></i>
              {{ $user->follower()->where('allow', 1)->count() }}          Seguidores
          </a>

        </li>
        <li class="list-group-item ">
          <script>
            (function() {
              var cx = '010538304943305528697:if5hlmoph24';
              var gcse = document.createElement('script');
              gcse.type = 'text/javascript';
              gcse.async = true;
              gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
              var s = document.getElementsByTagName('script')[0];
              s.parentNode.insertBefore(gcse, s);
            })();
          </script>
          <gcse:search></gcse:search>
        </li>

    </ul>
</div>
