@extends('layout.base')

@section('title')
Inscription client
@endsection

@section('content')
{{--
<form method="POST" action="/register">
    <div class="form-group">
      <label for="civilite">Civilité</label>
      <input name="civilite" id="civilite" value="m" checked="" type="radio" >Homme
      <input name="civilite" value="f" id="civilite" type="radio" checked>Femme<br><br>
      <label for="prenom">Prénom</label><br>
      <input type="text" id="prenom" name="prenom" placeholder="votre prénom"><br><br>
      <label for="nom">Nom</label><br>
      <input type="text" id="nom" name="nom" placeholder="votre nom"><br><br>
      <label for="tel">Téléphone</label><br>
      <input type="text" id="tel" name="tel" placeholder="votre téléphone"><br><br>
      <label for="birth">Date de naissance</label><br>
      <input type="text" id="birth" name="birth" placeholder="votre date de naissance"><br><br>
      <label for="email">Email</label><br>
      <input type="email" id="email" name="email" placeholder="exemple@gmail.com"><br><br>
      <label for="mdp">Mot de passe</label><br>
      <input type="password" id="mdp" name="mdp" required="required"><br><br>
      <label for="mdp">Confirmer votre mot de passe</label><br>
      <input type="password" id="confirm" name="confirm" required="required"><br><br>
      <label for="adresse">Adresse</label><br>
      <textarea id="adresse" name="adresse" placeholder="votre adresse" ></textarea><br><br>
      <label for="cp">Code Postal</label><br>
      <input type="text" id="code_postal" name="code_postal" placeholder="code postal"><br><br>
      <label for="ville">Ville</label><br>
      <input type="text" id="ville" name="ville" placeholder="votre ville"><br><br>

    </div>
    <button type="submit" class="btn btn-primary">Soumettre</button>
</form >
--}}
<div class="container">
    <legend class="text-center"><i class="fas fa-sign-in-alt mr-3"></i>Remplissez le formulaire pour valider votre Inscription (Clients)</legend>
    <div class="dropdown-divider"></div>
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="POST" action="{{route('client.post')}}">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-warning">
                        {{$errors}}
                    </div>
                @endif

                @if(Session::get('success'))
                    <div class="alert alert-success">
                        {{session::get('success')}}
                    </div>
                @endif
                {{--<div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="civilite" id="civilite1" value="m">
                        <label class="form-ceheck-label mt-2" for="civilite1">Homme</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="civilite" id="civilite2" value="f" checked>
                        <label class="form-check-label" for="civilite2">Femme</label>
                    </div>
                </div>
                --}}
                <div class="form-group">
                    <label for="prenom">Prénom</label><br>
                    <input type="text" value="{{ old('prenom') }}" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" placeholder="votre prénom" >
                        @error('prenom')
                            <div id="date_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="nom">Nom</label><br>
                    <input type="text" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}" id="nom" name="nom" placeholder="votre nom" required>
                        @error('nom')
                            <div id="date_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>
                {{--
                <div class="form-group">
                    <label for="birth">Date de naissance</label><br>
                    <input type="date" class="form-control" id="birth" name="birth" placeholder="votre date de naissance">
                </div>
                --}}
                <div class="form-group">
                    <label for="tel">Téléphone</label><br>
                    <input type="tel" pattern="[0-9]{10}" class="form-control @error('tel') is-invalid @enderror" value="{{ old('tel') }}" id="tel" name="tel" placeholder="votre téléphone">
                        @error('tel')
                            <div id="date_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <input type="text" class="form-control @error('adresse') is-invalid @enderror" value="{{ old('adresse') }}" name="adresse" id="adresse" placeholder="adresse" required>
                        @error('adresse')
                            <div id="date_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="code_postal">Code Postal</label><br>
                    <input type="text" class="form-control @error('code_postal') is-invalid @enderror" id="code_postal" value="{{ old('code_postal') }}" name="code_postal" placeholder="code postal">
                        @error('code_postal')
                            <div id="date_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="ville">Ville</label><br>
                    <input type="text" class="form-control @error('ville') is-invalid @enderror" id="ville" name="ville" value="{{ old('ville') }}" placeholder="ville">
                        @error('ville')
                            <div id="date_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" aria-describedby="emailHelp" placeholder="email" required>
                        @error('email')
                            <div id="date_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" class="form-control @error('mdp') is-invalid @enderror" name="mdp" id="mdp" aria-describedby="passwordHelpBlock"  required>
                        @error('mdp')
                            <div id="date_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        Le mot de passe doit être compris entre 6-20 characters, et devra contenir des lettres et des nombres, et ne devra pas contenir d'éspaces ou d'emoji.
                    </small>
                </div>

                <div class="form-group">
                    <label for="mdpconfirm">Confirmation de mot de passe</label>
                    <input type="password" class="form-control @error('mdpconfirm') is-invalid @enderror" name="mdpconfirm" id="mdpconfirm"  required>
                        @error('mdpconfirm')
                            <div id="date_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>


                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="agree" required>
                    <label class="form-check-label" for="agree"><small>J'accepte les <a href="#">termes et conditions d'utilisation.</a></small></label>
                </div>

                <button type="submit" class="btn btn-primary">Valider</button>
            </form>
        </div>
    </div>
</div>
@endsection
