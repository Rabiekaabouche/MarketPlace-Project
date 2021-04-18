@extends('layout.base')


@section('content')

<div class="container py-5 px-0">
        <h2 class="text-center border-bottom shadow-sm p-3"><span>Partenaires</span></h2>
    <table class="table table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>Entreprise</th>
                <th>Description</th>
                <th>Adresse</th>
                <th>Téléphone</th>

            </tr>
    </thead>
    <tbody>
        @if (count($vendors)==0)
            <td colspan="6">Aucun vendeur n'exsiste pour l'instant</td>
        @else

            @foreach ($vendors as $vendor)

            <tr>
                <td><a href="{{route('booth.show',['idVend'=>$vendor['IdVend']])}}">{{ $vendor['NomEntreprise'] }}</a></td>
                <td><b>{{ $vendor['DescripEntreprise'] }}</b></td>
                <td><b>{{ $vendor['Adresse'] . ' ' . $vendor['Cp'] . ' ' . $vendor['Ville']}}</b></td>
                <td><b>{{ $vendor['TelVend'] }}</b></td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
</div>
@endsection
