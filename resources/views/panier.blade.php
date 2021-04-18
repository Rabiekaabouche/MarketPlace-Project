<?php
use App\Repositories\Card;
?>
@extends('layout.base')

@section('title')
    Panier
@endsection

@section('content')
<div class="container">
    <h2 class="text-center border-bottom shadow-sm p-3 mb-5 "><span>Panier</span></h2>
    <div class="text-right mb-3"><button class="btn btn-primary"><i class="fab fa-cc-visa mr-2"></i><i class="far fa-credit-card mr-2 p-2 "></i><b>Payer la commande</b></button></div>
    <table class="table table-striped text-center table-bordered table-link ">
        <thead class="thead-dark">
            <tr>
                <th width="20%" height='30%'>Image</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if (count($products)!=0)


            @foreach ($products as $product)

            <tr>
                <td><div class="w-100 m-auto" style="height: 30%"><img src="/store_image/fetch_image/{{$product['IdProd']}}" class=" img img-fluid img-thumbnail" style="height: 140px; width: 100%;" alt="image"></div></td>
                <td><a href="{{route('products.show', $product['IdProd'])}}" ><b>{{$product['NomProd']}}</b></a></td>
                <td>{{$product['DescriptionProd']}}</td>
                <td>{{Card::calcQuantity($product['IdProd'])}}</td>
                <td>{{$product['PrixUnite']}}€</td>
                <td>{{Card::calcPrice($product['IdProd'])}}€</td>
                <td>
                    <form action="{{route('panier.delete', ['IdProd' => $product['IdProd']])}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
            <td colspan="7" class="text-right table-dark" >Prix Total: <b style="color: rgb(61, 204, 61); font-weight: 900; font-size: 20px;">{{Card::calcPriceTot()}} €</b></td>
            @else
                <tr>
                    <td colspan="7">Votre panier est vide</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
