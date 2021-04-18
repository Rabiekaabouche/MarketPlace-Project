@extends('layout.panel')

@section('title')
    Validation
@endsection

@section('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="{{route('adminDashboard')}}">
        <span data-feather="home"></span>
        Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{route('validation')}}">
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

@section('content')
<table class="table table-bordered table-hover table-striped text-center">
    <thead class="thead-dark">
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Entreprise</th>
            <th>Ville</th>
            <th>Téléphone</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if (count($vendors)==0)
            <td colspan="6">Vous n'avez aucun vendeur à valider pour l'instant</td>
        @else

            @foreach ($vendors as $vendor)

            <tr>
                <td><b>{{ $vendor['NomVend'] }}</b></td>
                <td><b>{{ $vendor['PrenomVend'] }}</b></td>
                <td><b>{{ $vendor['NomEntreprise'] }}</b></td>
                <td><b>{{ $vendor['Ville'] }}</b></td>
                <td><b>{{ $vendor['TelVend'] }}</b></td>
                <td><form action="{{route('validation.post', ['IdVend' => $vendor['IdVend']])}}" method="POST">@csrf<button class="btn btn-success" type="submit"><i class="fas fa-user-lock mr-2"></i>Valider</button></form></td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>

@endsection
