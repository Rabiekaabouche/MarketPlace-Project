@extends('layout.panel')

@section('title')
    Dashboard
@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link active" href="{{route('vendorDashboard')}}">
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
        <a class="nav-link" href="{{route('boutique.show',['idVend'=>session()->get('user')['id']])}}">
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

