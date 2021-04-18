@extends('layout.base')

@section('title')
{{ $productRow['NomProd'] }}
@endsection

@section('content')

<style>

#cont1 {
    position: relative;
    top: 80px;
    left: 0;
    height: 650px;
}

#pic{
  position: relative;
  top: 10px;
  left: 0;
  width: 645px;
  height: 80%;
}

#cont2 {
    position: absolute;
    top: 140px;
    left: 53%;
    height: 700px;
    text-align: justify;
    width: 600px;
}

#price {
    font-weight:bold;
}

#description{
    margin-bottom: 20px
}

#liv {
    font-style:italic;

}
#dispo {
    color:green;
    font-weight:bold;
}

#non_dispo {
    color:red;
    font-weight:bold;
}

#btn {

    border: 2px solid black;
    color:black;
    font-weight: 700;
    background: white;
    transition: all 500ms ease;
}

#btn:hover {
    color: white;
    background: black;
    border: 2px solid black;
    border-radius: 7px;
    padding: .375rem .75rem;
}
#marge {
    height:20px;
}
</style>


<div class="container-fluid">
    <div class="container-fluid" id="cont1">
        <img src="/store_image/fetch_image/{{$productRow['id']}}" class="rounded" id="pic" alt="...">
    </div>
    <div class="container-fluid" id="cont2">

        <h2 id="nom">{{ $productRow['NomProd'] }}
    </h2><br>


    <div id="price" style="color: red"><del>{{1.3 * $productRow['PrixUnite'] }} €</del></div>
    <div id="price">{{ $productRow['PrixUnite'] }} €

    </div>
    <br>

    @if ($dispo['QuantiteStock']>0)
    <div id="dispo"> En Stock </div><br>
    @else
    <div id="non_dispo"> Non disponible </div><br>
    @endif

    <div class="my-3" style="color: blue;"><b>{{$productRow['EtatProd']}}</b></div>
    <div id="description">{{ $productRow['DescriptionProd'] }}
    <br></div>

    <div id="vendor">Vendu par : <b>{{ $vendor['NomEntreprise'] }}</b></div><br>

    <div id="m_liv"><div id="liv">Mode de livraison :</div>
        En magasin: <span style="color: green; font-weight:bold">Gratuit</span> <br>
        A domicile ou en point de retrait: 4 €
     </div><br>

     <form action="{{route('card.post')}}" method="POST">
        @csrf
        <input type="hidden" value="{{$productRow['IdProd']}}" name="IdProd">
        <button type="submit" id=btn class="btn btn-primary {{--disabled disabled-link--}}">Ajouter au panier</button>
    </form>


    <div id="marge"></div>
    </div>
    @if(Session::get('success'))
                <div class="alert alert-success w-50 mx-auto">
                    {{session::get('success')}}
                </div>
    @endif
    </div>
@endsection
