@extends('layout.base')

@section('title')
Inscription Vendeur
@endsection

@section('content')

<div class="container">
    <legend class="text-center border-bottom"><i class="fas fa-sign-in-alt mr-3"></i>Remplissez le formulaire pour valider votre Inscription (Vendeurs)</legend>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{route('vendeur.post')}}">
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
                {{--
                <div class="form-group ">
                    <div class="form-check form-check-inline align-baseline ">
                        <input class="form-check-input " type="radio" name="civilite" id="civilite1" value="m">
                        <label class="form-ceheck-label mt-2" for="civilite1">Homme</label>
                    </div>
                    <div class="form-check form-check-inline align-baseline">
                        <input class="form-check-input" type="radio" name="civilite" id="civilite2" value="f" checked>
                        <label class="form-check-label" for="civilite2">Femme</label>
                    </div>
                </div>
                --}}
                <div class="form-group">
                    <label for="prenom"><b>Prénom</b></label><br>
                    <input type="text" class="form-control @error('prenom') is-invalid @enderror" value="{{ old('prenom') }}" id="prenom" name="prenom" placeholder="votre prénom" required>
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

                <div class="form-group">
                    <label for="company">Nom entreprise</label><br>
                    <input type="text" class="form-control @error('company') is-invalid @enderror" value="{{ old('company') }}" id="company" name="company" placeholder="votre entreprise" required>
                        @error('company')
                            <div id="date_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="SIRET">SIRET</label><br>
                    <input type="text" class="form-control @error('siret') is-invalid @enderror" id="SIRET" value="{{ old('siret') }}" name="siret" placeholder="votre SIRET" required>
                        @error('siret')
                            <div id="date_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="RIB">RIB</label><br>
                    <input type="text" class="form-control @error('rib') is-invalid @enderror" id="RIB" name="rib" placeholder="votre RIB" required>
                        @error('rib')
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
                    <input type="text" class="form-control @error('tel') is-invalid @enderror" id="adresse" name="adresse" value="{{ old('adresse') }}" placeholder="adresse" required>
                        @error('adresse')
                            <div id="date_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="code_postal">Code Postal</label><br>
                    <select type="text" class="form-control @error('cp') is-invalid @enderror" id="cp" name="cp" aria-placeholder="coucou" placeholder="code postal" aria-describedby="cp_feedback">
                        <option value="">-- Choisissez votre code postal --</option>
                        @foreach ($cps as $cp)
                            <option value={{$cp['Cp']}} {{(old('cp')==$cp['Cp'])? 'selected':''}} required>{{ $cp['Cp'] }}</option>
                        @endforeach
                    </select>
                        @error('cp')
                            <div id="Cp_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="ville">Ville</label><br>
                    <input type="text" class="form-control  @error('ville') is-invalid @enderror" value="{{ old('ville') }}" id="ville" name="ville" placeholder="ville">
                        @error('ville')
                            <div id="Cp_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="descript">Description entreprise</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" id="descript" placeholder="description entreprise..." rows="4" cols="50"></textarea>
                        @error('description')
                            <div id="Cp_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" aria-describedby="emailHelp" name="email" placeholder="email" required>
                        @error('email')
                            <div id="Cp_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" class="form-control  @error('mdp') is-invalid @enderror" name="mdp" id="mdp" aria-describedby="passwordHelpBlock"  required>
                        @error('mdp')
                            <div id="Cp_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        Le mot de passe doit être compris entre 8-20 characters, et devra contenir des lettres et des nombres, et ne devra pas contenir d'éspaces ou d'emoji.
                    </small>
                </div>

                <div class="form-group">
                    <label for="mdpconfirm">Confirmation de mot de passe</label>
                    <input type="password" class="form-control  @error('mdpconfirm') is-invalid @enderror" name="mdpconfirm" id="mdpconfirm"  required>
                        @error('mdpconfirm')
                            <div id="Cp_feedback" class="invalid-feedback">
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
