@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Inicio de sesión</div>

                <div class="card-body">
                    <form class="mb-2" method="POST" action="{{ route('login') }}" aria-label="Ingresar">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">Correo electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Recordar sesión
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-secondary">
                                    Ingresar
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                        </div>
                    </form>

                    <a href="{{ url('login/facebook') }}" class="btn btn-primary btn-block">
                        <i class="fab fa-facebook-square"></i>
                        Ingresar usando Facebook
                    </a>

                    <a href="{{ url('login/twitter') }}" class="btn btn-info btn-block">
                        <i class="fab fa-twitter-square"></i>
                        Ingresar usando Twitter
                    </a>

                    <a href="{{ url('login/google') }}" class="btn btn-danger btn-block">
                        <i class="fab fa-google-plus-square"></i>
                        Ingresar usando Google+
                    </a>

                    <a href="{{ route('register') }}" class="btn btn-dark btn-block">
                        <i class="fas fa-envelope-square"></i>
                        Registro mediante correo
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
