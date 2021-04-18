@extends('layout.panel')

@section('title')
Ajout de Produit
@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link " href="{{route('vendorDashboard')}}">
        <span data-feather="home"></span>
        Dashboard
        </a>
    </li>
    <li class="nav-item ">
        <a class="nav-link active" href="{{route('prodForm')}}">
        <span data-feather="file"></span>
        ajouter un produit
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="{{route('boutique.show',['idVend'=>session()->get('user')['id']])}}">
        <span data-feather="shopping-cart"></span>
        Produits
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
        <span data-feather="users"></span>
        Achats
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
        <span data-feather="bar-chart-2"></span>
        Commandes
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
        <span data-feather="layers"></span>
        Integrations
        </a>
    </li>
@endsection

@section('content')

<div class="container mb-5">

    <div class="row justify-content-center">
        <div class="col-md-10">

         <form method="post" action="{{ url('add_product/insert_image') }}"  enctype="multipart/form-data">
         @csrf
         @if(Session::get('success'))
                    <div class="alert alert-success">
                        {{session::get('success')}}
                    </div>
                @endif

         @if ($errors->any())
                <div class="alert alert-warning">Le produit n'a pas pu être ajouté &#9785;</div>
            @endif

                <div class="form-group">
                    <label for="nomProduit">Nom du produit</label><br>
                    <input type="text" class="form-control @error('NomProd') is-invalid @enderror" id="nomProduit" name="NomProd" value="{{ old('NomProd') }}" required>
                    @error('NomProd')
                            <div id="date_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                </div>

                <div class="form-group">
                    <label for="categorieProduit">Catégorie</label>
                    <select class="form-control @error('IdCat') is-invalid @enderror" id="categorieProduit" name="IdCat" required>
                    <option value=" ">Choisissez une catégorie </option>
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie['IdCat'] }}" {{(old('IdCat')==$categorie['IdCat'])? 'selected':''}}>{{ $categorie['NomCat'] }}</option>
                    @endforeach

                    </select>
                    @error('IdCat')
                            <div id="NomCat_feedback" class="invalid-feedback">
                            {{ $message }}
                             </div>
                            @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label><br>
                    <textarea class="form-control @error('DescriptionProd') is-invalid @enderror" id="description" name="DescriptionProd"
                     maxlength="250" required rows="4" cols="50"></textarea>
                    <small id="descriptionHelpBlock" class="form-text text-muted">
                    Veuillez renseigner une description détaillée et concise (max 250 caractères) de votre produit</small>
                    @error('DescriptionProd')
                            <div id="date_feedback" class="invalid-feedback">
                            {{ $message }}
                             </div>
                            @enderror
                </div>

                <div class="form-group">
                    <label for="photoProduit">Photo du Produit</label><br>
                    <input type="file" class="form-control-file" id="photoProduit" name="prod_image"  required >
                </div>

                <div class="form-group">
                    <label for="etatProduit">Etat du produit</label>
                    <select class="form-control @error('EtatProd') is-invalid @enderror" id="etatProduit" name="EtatProd" required>
                    <option value =''>Choisissez l'état du produit</option>
                    <option value ='--'></option>
                    <option value ='Neuf'>Neuf</option>
                    <option value = 'Occasion'>Occasion</option>
                    </select>
                    @error('EtatProd')
                            <div id="date_feedback" class="invalid-feedback">
                            {{ $message }}
                             </div>
                            @enderror
                </div>

                <div class="form-group">
                    <label for="quantite">Quantité disponible</label><br>
                    <input type="text" class="form-control @error('QuantiteStock') is-invalid @enderror" id="quantite" name="QuantiteStock" value="{{ old('QuantiteStock') }}" required>
                    @error('QuantiteStock')
                            <div id="date_feedback" class="invalid-feedback">
                            {{ $message }}
                             </div>
                            @enderror
                </div>

                <div class="form-group">
                    <label for="prixunitaire">Prix unitaire</label><br>
                    <input type="text" class="form-control @error('PrixUnite') is-invalid @enderror" id="prixunitaire" name="PrixUnite" placeholder="Prix HT" value="{{ old('PrixUnite') }}" required>
                        @error('PrixUnite')
                            <div id="date_feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="dateAjoutProd">Date d'ajout du produit</label><br>
                    <input type="date" class="form-control" id="dateAjoutProd" name="DateAjout" value="{{ old('birth') }}" placeholder="Indiquez la date d'ajout du produit " required>
                        @error('DateAjout')
                            <div id="date_feedback" class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                </div>


                <input type="submit" name="store_image" class="btn btn-primary" value="Ajouter le produit" />
            </form>
        </div>
    </div>
</div>
{{--
<div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Les produits disponibles </h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th width="30%">Image</th>
                        <th width="70%">Name</th>
                    </tr>
                    @foreach($data as $row)
                    <tr>
                        <td>
                            <img src="store_image/fetch_image/{{ $row['id'] }}"  class="img-thumbnail" style="border-radius: 50%;" width="100"  />
                        </td>
                        <td>{{ $row->NomProd }}</td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>
</div>
--}}
@endsection




