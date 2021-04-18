@extends('layout.panel')

@section('title')
    Produits
@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="{{route('adminDashboard')}}">
        <span data-feather="home"></span>
        Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('validation')}}">
        <span data-feather="file"></span>
        Validation <span style="background-color: red; font-size: 13px; padding: 0px 6px; border-radius: 50%; color: white;">{{App\Repositories\Repository::notValidate()}}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{route('productForAdmin')}}">
        <span data-feather="shopping-cart"></span>
        Produits
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('validateVendors')}}">
        <span data-feather="users"></span>
        Vendeurs
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('clients')}}">
        <span data-feather="bar-chart-2"></span>
        Clients
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
        @foreach($products as $product)
        <div class="col-md-4">
            <div class="card ">
                <img src="/store_image/fetch_image/{{$product['imageId']}}" class="img-fluid mb-3" alt="img">
                <form action="{{route('deleteProduct.post', ['id'=>$product['IdProd']])}}" method="POST" >
                    @csrf
                    <input type="submit" value="Supprimer" >
                </form>
                <div style="padding: 0 10px; height: 145px;">
                    <h5><a href="{{route('products.show', ['IdProduct'=>$product['IdProd']])}}">{{$product['NomProd']}}</a></h5>
                    <h6>{{$product['NomEntreprise']}}</h6>
                    <small class="limit-text" style="color:rgb(31, 30, 30)">{{$product['DescriptionProd']}}</small>
                    <div><p class="mt-3 text-right price"><small><del style="color: red; font-size: 16px">{{1.3*$product['PrixUnite']}} €</del></small> <span class="righ-price">{{$product['PrixUnite']}} €</span></p></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
</section>
@endsection
