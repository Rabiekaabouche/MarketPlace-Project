@extends('layout.base')


@section('content')


<section class="collection">
    <div class="container py-5 px-0">
        <h2 class="text-center border-bottom shadow-sm p-3 "><span>Résultats de recherche</span></h2>
        @if(Session::get('success'))
                    <div class="alert alert-success w-50 mx-auto text-center mt-3">
                        {{session::get('success')}}
                    </div>
        @endif
        <div class="row py-5">
            @foreach($products as $product)
                <div class="col-md-3">
                    <div class="card ">
                        <img src="/store_image/fetch_image/{{$product['imageId']}}" class="img-fluid mb-3" alt="img9">
                        <form action="{{route('card.post')}}" method="POST">
                            @csrf
                            <input type="hidden" value="{{$product['IdProd']}}" name="IdProd">
                            <input type="submit" value="Ajouter au panier">
                        </form>
                        <div style="padding: 0 10px; height: 145px;">
                            <h5><a href="{{route('products.show', ['IdProduct'=>$product['IdProd']])}}"><b>{{$product['NomProd']}}</b></a></h5>
                            <h6 class="text-muted mb-2 font-italic">{{$product['brand']}}</h6>
                            <small class="limit-text" style="color:rgb(31, 30, 30)">{{$product['DescriptionProd']}}</small>
                            <p class="mt-3 text-right price"><small><del style="color: red; font-size: 16px">{{1.3*$product['PrixUnite']}} €</del></small> <span class="righ-price">{{$product['PrixUnite']}} €</span></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
@endsection
