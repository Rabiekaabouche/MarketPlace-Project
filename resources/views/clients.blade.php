@extends('layout.panel')
@section('title')
    Clients
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
        <a class="nav-link active" href="{{route('clients')}}">
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
    @if(Session::get('success'))
            <div class="alert alert-success w-50 mx-auto my-3 text-center ">
                {{session::get('success')}}
            </div>
    @endif
    <table class="table table-bordered table-hover table-striped text-center">
        <thead class="thead-dark">
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Téléphone</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if (count($clients)==0)
                <td colspan="6">Aucun client n'exsiste pour l'instant</td>
            @else

                @foreach ($clients as $client)

                <tr>
                    <td><b>{{ $client['NomClient'] }}</b></td>
                    <td><b>{{ $client['PrenomClient'] }}</b></td>
                    <td><b>{{ $client['Adresse'] }}</b></td>
                    <td><b>{{ $client['Ville'] }}</b></td>
                    <td><b>{{ $client['TelClient'] }}</b></td>
                    <td>
                        <form action="{{route('client.delete', ['IdClient' => $client['IdClient']])}}" method="POST">
                            @csrf
                            <button class="btn btn-danger" type="submit"><i class="fas fa-user-times mr-2"></i>Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>

@endsection
