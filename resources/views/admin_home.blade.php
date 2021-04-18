@extends('layout.panel')

@section('title')
    Dashboard
@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link active" href="{{route('adminDashboard')}}">
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
        <a class="nav-link" href="{{route('productForAdmin')}}">
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
