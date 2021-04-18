@extends('layout.base')

@section('title')
Connexion
@endsection

@section('content')

<div class="container mb-5">
    <legend class="text-center "><i class="fa fa-user mr-3" aria-hidden="true"></i>Authentification</legend>
    <div class="dropdown-divider"></div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="{{route('login.post')}}">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger text-center">
                    Vous n'avez pas pu être authentifié. Email ou mot passe incorrect.
                    </div>
                @endif
                <div class="form-group">
                    <label for="id">Identifiant</label><br>
                    <input type="text" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror"  id="id" name="email" placeholder="votre e-mail" required>
                        @error('email')
                            <div id="date_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" class="form-control @error('mdp') is-invalid @enderror" name="mdp" id="mdp" placeholder="votre mot de passe" required>
                        @error('mdp')
                            <div id="date_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="agree">
                    <label class="form-check-label" for="agree"><small>Se souvenir de moi</small></label>
                </div>

                <button type="submit" class="btn btn-primary">Se connecter</button>
                <p><small>Vous n'avez pas de compte? <a href="{{route('register')}}"> S'inscrire.</a></small></p>
            </form>
        </div>
    </div>
</div>
@endsection
