<form id="signUpForm" class="register" role="form" method="POST" action="{{ route('register') }}" novalidate>
    <input type="hidden" value="register" name="tab" />
    {{ csrf_field() }}

    <h2>Empeza a navegar alta red!</h2>

    <div class="row">
        <div class="form-group{{ old('tab') == 'register' && $errors->has('name') ? ' has-error' : '' }} col-md-12">
            <label for="name" class="control-label">Nombre</label>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user-circle-o"></i> </span>

                    <input id="name" type="text" placeholder="Nombre y Apellido" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                </div>

                @if (old('tab') == 'register' && $errors->has('name'))
                    <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ old('tab') == 'register' && $errors->has('email') ? ' has-error' : '' }} col-md-12">
            <label for="email" class="control-label">E-Mail</label>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope"></i> </span>

                    <input id="email" type="email" class="form-control" placeholder="email@ejemplo.com" name="email" value="{{ old('email') }}" required>

                </div>
                @if (old('tab') == 'register' && $errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>


        </div>

        <div class="form-group{{ old('tab') == 'register' && $errors->has('username') ? ' has-error' : '' }} col-md-12">
            <label for="username" class="control-label">Usuario</label>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i> </span>

                    <input id="username" type="text" class="form-control" placeholder="Nombre de Usuario" name="username" value="{{ old('username') }}" required>

                </div>
                @if (old('tab') == 'register' && $errors->has('username'))
                    <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
                @endif
            </div>


        </div>

        <div class="form-group{{ old('tab') == 'register' && $errors->has('password') ? ' has-error' : '' }} col-md-12">
            <label for="password" class="control-label">Contraseña</label>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="fas fa-key"></i> </span>

                    <input id="password" type="password" placeholder="********" class="form-control" name="password" required>

                </div>
                @if (old('tab') == 'register' && $errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group  col-md-12">
            <label for="password_confirm" class="control-label">Confirma tu Contraseña</label>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="fas fa-key"></i></i> </span>

                    <input id="password_confirm" type="password" placeholder="********" class="form-control" name="password_confirmation" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8 col-md-offset-2">
                <button type="submit" class="btn btn-primary btn-register" >
                    Registrate
                </button>
            </div>
        </div>
    </div>
</form>
