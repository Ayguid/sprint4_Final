@extends('layouts.app')


@section('content')
    <div class="h-20"></div>
    <div class="container">

        <div class="row">

            <div class="col-md-6 col-md-offset-3">
                @if(Session::has('alert-success'))
                    <div class="alert alert-success"><i class="fa fa-check" aria-hidden="true"></i> <strong>{!! session('alert-success') !!}</strong></div>
                @endif
                @if(Session::has('alert-danger'))
                    <div class="alert alert-danger"><i class="fa fa-times" aria-hidden="true"></i> <strong>{!! session('alert-danger') !!}</strong></div>
                @endif
            </div>

            <div class="col-md-6 col-md-offset-3">
              <div class="sliders">


                @include('widgets.sliders')

              </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">Configuracion de su cuenta</div>

                    <div class="panel-body">


                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/settings') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="type" value="account" />

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $user['name'] }}" required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $user['email'] }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('private') ? ' has-error' : '' }}">
                                <label for="private" class="col-md-4 control-label">Tipo de cuenta</label>

                                <div class="col-md-6">
                                  <select class="" name="private">
                                    <option value="0" @if($user['public'] == 0){{ 'selected' }}@endif>Publica</option>
                                    <option value="1" @if($user['private'] == 1){{ 'selected' }}@endif>Privada</option>
                                  </select>
                                    {{-- <input id="private" type="checkbox" name="private" value="1" @if($user['private'] == 1){{ 'checked' }}@endif> --}}

                                    {{-- @if  ($_POST['private']==null)  {{$_POST['private']==0}}@endif --}}




                                    @if ($errors->has('private'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('private') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Actualizar
                                    </button>
                                </div>
                            </div>

                        </form>


                    </div>
                </div>
            </div>

            <div class="col-md-6 col-md-offset-3">

                <div class="panel panel-primary">
                    <div class="panel-heading">Configuracion de Usuario</div>

                    <div class="panel-body">


                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/settings') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="type" value="username" />

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Usuario</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="username" value="{{ $user['username'] }}" required onkeypress="return AvoidSpace(event)">

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Actualizar
                                    </button>
                                </div>
                            </div>

                        </form>


                    </div>
                </div>
            </div>

            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">Configuracion de contraseña</div>

                    <div class="panel-body">


                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/settings') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="type" value="password" />

                            <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password Actual</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="current_password">

                                    @if ($errors->has('current_password'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('current_password') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Nuevo Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirme el nuevo Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Actualizar
                                    </button>
                                </div>
                            </div>

                        </form>


                    </div>

                </div>
                {{-- @include('widgets.sliders') --}}

            </div>
        </div>
    </div>
@endsection

<script type="text/javascript">
function AvoidSpace(event) {
  var k = event ? event.which : window.event.keyCode;
  if (k == 32) return false;
}
</script>
