@extends('layouts.layout')

@section('content')
<div class="container-fluid bg-login">
    <div class="row justify-content-center">
        <div class="col-md-5 login-modal">
            <div class="card login-modal-container">
                <h1 class="text-center"><img src="{{ asset('img/brand/beer.png') }}" width="30" height="30" alt="">  Se connecter </h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Nom d'utilisateur" required autofocus>

                            @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Mot de passe"  required>

                            @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                    <div class="checkbox">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="custom-control-input" id="customCheck2" >
                          <label class="custom-control-label" for="customCheck2">Se souvenir de moi</label>
                      </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-block btn-primary">
                    Connexion
                </button>
                <br>
                <div class="col-md-12 text-center">
                    <a href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
