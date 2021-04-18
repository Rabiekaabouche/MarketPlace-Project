@extends('layout.panel')

@section('title')
Produits
@endsection
@section('sidebar')
    <li class="nav-item">
        <a class="nav-link " href="{{route('vendorDashboard')}}">
        <span data-feather="home"></span>
        Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('prodForm')}}">
        <span data-feather="file"></span>
        ajouter un produit
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{route('boutique.show',['idVend'=>session()->get('user')['id']])}}">
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


<section class="collection">
    <div class="container py-2 px-0">
    <div class="row py-5">
        @if (!empty($products))

            @foreach($products as $product)
            <div class="col-md-4">
                <div class="card ">
                    <img src="/store_image/fetch_image/{{$product['imageId']}}" class="img-fluid mb-3" alt="img9">
                    <form action="{{route('deleteProduct_v.post', ['id'=>$product['IdProd']])}}" method="POST" >
                        @csrf
                        <input type="submit" value="Supprimer" >
                    </form>
                    <div style="padding: 0 10px; height: 145px;">
                        <h5><a href="{{route('products.show', ['IdProduct'=>$product['IdProd']])}}"><b>{{$product['NomProd']}}</b></a></h5>
                        <h6>{{$product['NomEntreprise']}}</h6>
                        <small class="limit-text" style="color:rgb(31, 30, 30)">{{$product['DescriptionProd']}}</small>
                        <div><p class="mt-3 text-right price"><small><del style="color: red; font-size: 16px">{{1.3*$product['PrixUnite']}} €</del></small> <span class="righ-price">{{$product['PrixUnite']}} €</span></p></div>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
        @else
            <div class='mx-auto'><b>Vous n'avez posté produit. Pensez à remplir votre boutique.</b></div>
        @endif
</div>
</section>
@endsection
