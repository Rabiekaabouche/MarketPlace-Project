@extends('layout.base')


@section('content')

<section class="collection">
    <div class="container py-5 px-0">
        <h2 class="text-center border-bottom shadow-sm p-3"><span>Boutique {{$products[0]['NomEntreprise']}}</span></h2>
        <div class="row justify-content-between py-3 border-bottom  ">
            <div class="col-md-7">
                <div class="p-2"><h2><b>Description</b></h2></div>
                <h5 style="line-height: 30px; text-align:justify; color: rgb(90, 88, 88,  65%); font-size: 17px;">{{$products[0]['DescripEntreprise']}}</h5><br>
            </div>
            <div class="col-md-4 px-2 pt-4 description-vend">
                <h5><b style="line-height: 2">Adresse: </b><br>{{$products[0]['Adresse'] .', '. $products[0]['Cp'] . ' '. $products[0]['Ville']}}</h5>
                <h5><b style="line-height: 2">Téléphone: </b><br>{{$products[0]['TelVend']}}</h5><br>
            </div>
        </div>
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
                    <h5 style="font-size: 21px"><a href="{{route('products.show', ['IdProduct'=>$product['IdProd']])}}"><b>{{$product['NomProd']}}</b></a></h5>
                    <h6 class="text-muted mb-2 font-italic">{{$product['NomEntreprise']}}</h6>
                    <small class="limit-text" style="color:rgb(31, 30, 30)">{{$product['DescriptionProd']}}</small>
                    <div ><p class="mt-3 text-right price"><small><del style="color: red; font-size: 16px">{{1.3*$product['PrixUnite']}} €</del></small> <span class="righ-price">{{$product['PrixUnite']}} €</span></p></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</section>
@endsection
