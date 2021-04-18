<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand h1" href="{{route('home')}}" style="font-family: 'Merienda', cursive ;">PACA <span style="color: rgb(199, 0, 0);">Market</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('home')}}">Acceuil <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">A propos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('vendors.show')}}">Partenaires</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Catégories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('cat.show', ['idCat'=> 1])}}">Artisanat</a>
                    <a class="dropdown-item" href="{{route('cat.show', ['idCat'=> 2])}}">Mode femme</a>
                    <a class="dropdown-item" href="{{route('cat.show', ['idCat'=> 3])}}">Mode homme</a>
                    <a class="dropdown-item" href="{{route('cat.show', ['idCat'=> 4])}}">Bijouterie</a>
                    <a class="dropdown-item" href="{{route('cat.show', ['idCat'=> 5])}}">Produits Alimentaires</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Carte</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
        </ul>

{{--
        <form class="navbar-nav form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-danger my-2 my-sm-0" type="submit">Search</button>
        </form>
--}}

        <div class="navbar-nav">
            <a class="nav-item nav-link my-0" href="{{route('geolocalisation')}}"><i class="fas fa-map-marker-alt" style="color: white;"></i></a>

                @if (session()->has('user') && session()->get('user')['droit']==0)
                <a class="nav-item nav-link my-0" href="{{route('showPanier')}}"><i class="fas fa-shopping-cart mr-1" style="color: white; "></i>
                {{App\Repositories\Card::count(session('user')['id'])}}</a>

                @endif

            @if (session()->has('user'))
            <form class="navbar-nav" method="POST" action="{{route('logout')}}">
                @csrf
                <div class="navbar-nav btn-group">
                    <span class="btn btn-danger disabled">
                        @if (session()->get('user')['droit']==2)
                        {{session()->get('user')['email']}}
                        @else
                        {{session()->get('user')['Nom']}}
                        @endif

                    </span>

                    <button type="submit" class="btn btn-outline-danger "><i class="fas fa-sign-out-alt mr-2" aria-hidden="true" style="color: white"></i>Déconnexion</button>

            </form>
            @else

                    <a class="btn btn-outline-danger" href="{{route('login')}}" role="button" style="margin-top: 2px;" ><i class="fas fa-sign-in-alt mr-2" aria-hidden="true" style="color: white"></i>Connexion</a>
                </div>
            @endif
        </div>

    </div>
</nav>
</header>
