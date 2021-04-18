@extends('layout.base')

@section('content')
@include('layout.carousel')

<section class="sub">
    <div class="container">
        <div class="row">
            <form class="form-inline my-2 my-lg-0 input-group" method="GET" action="{{route('search')}}">
                <input class="form-control mr-sm-2 search" type="text" id="key_word" name="key_word" placeholder="Trouver un produit" aria-label="Search">
                <button class="btn btn-outline-danger my-2 my-sm-0" type="submit"><i class="fas fa-search mr-2" style="color: white"></i>rechercher</button>
            </form>
        </div>
    </div>
</section>





<section class="collection">
    <div class="container py-5 px-0">
        @if ($errors->any())
            <div class="alert alert-danger text-center">
                Aucun produit trouvé
            </div>
        @endif
        <h2 class="text-center border-bottom shadow-sm p-3 "><span>Les articles récents</span></h2>

        <div class="row py-5">
            <div class="col-md-3">
                <div class="card ">
                    <img src="/imgs/img3.jpg" class="img-fluid mb-3" alt="img1">
                    <input type="button" value="Ajouter au panier">
                    <h5>Savon Marseillais</h5>
                    <p><small><del style="color: red; font-size: 16px">15,99€</del></small> <span class="righ-price">9,99€</span></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card ">
                    <img src="/imgs/img5.jpg" class="img-fluid mb-3" alt="img5">
                    <input type="button" value="Ajouter au panier">
                    <h5>Bagues</h5>
                    <p><small><del style="color: red; font-size: 16px">25,99€</del></small> <span class="righ-price">19,99€</span></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card ">
                    <img src="/imgs/img9.jpg" class="img-fluid mb-3" alt="img9">
                    <input type="button" value="Ajouter au panier">
                    <h5>Montre homme</h5>
                    <p><small><del style="color: red; font-size: 16px">159,99€</del></small> <span class="righ-price">139,99€</span></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card ">
                    <img src="/imgs/img11.jpg" class="img-fluid mb-3" alt="img10">
                    <input type="button" value="Ajouter au panier">
                    <h5>Tricot</h5>
                    <p><small><del style="color: red; font-size: 16px">19,99€</del></small> <span class="righ-price">15,99€</span></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="local py-5">
    <div class="container py-5 text-white text-center">
        <div class="row py-3">
            <div class="col-lg-9 mx-auto">
                <h2>Le meilleur des produits Bio</h2>
                <p class="py-3">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae esse, itaque tenetur quidem iusto laborum ipsa repudiandae.
                </p>
                <a href="/cat/5" class="btn1 mr-1">voir plus</a>
            </div>
        </div>

    </div>
</section>

<section class="collection">
    <div class="container py-5 px-0">
        <h2 class="text-center border-bottom shadow-sm p-3"><span>Les articles populaires</span></h2>

        <div class="row py-5">
            <div class="col-md-3 ">
                <div class="card ">
                    <img src="/imgs/img12.jpg" class="img-fluid mb-3" alt="img1">
                    <input type="button" value="Ajouter au panier">
                    <h5>Pantallon</h5>
                    <p><small><del style="color: red; font-size: 16px">29,99€</del></small> <span class="righ-price">19,99€</span></p>
                </div>
            </div>
            <div class="col-md-3 ">
                <div class="card ">
                    <img src="/imgs/img13.jpg" class="img-fluid mb-3" alt="img5">
                    <input type="button" value="Ajouter au panier">
                    <h5>Pull</h5>
                    <p><small><del style="color: red; font-size: 16px">25,99€</del></small> <span class="righ-price">19,99€</span></p>
                </div>
            </div>
            <div class="col-md-3 ">
                <div class="card ">
                    <img src="/imgs/img15.jpg" class="img-fluid mb-3" alt="img9">
                    <input type="button" value="Ajouter au panier">
                    <h5>Chaussures</h5>
                    <p><small><del style="color: red; font-size: 16px">120,99€</del></small> <span class="righ-price">89,99€</span></p>
                </div>
            </div>
            <div class="col-md-3 ">
                <div class="card ">
                    <img src="/imgs/img14.jpg" class="img-fluid mb-3" alt="img10">
                    <input type="button" value="Ajouter au panier">
                    <h5>Chaussures femme</h5>
                    <p><small><del style="color: red; font-size: 16px">79,99€</del></small> <span class="righ-price">69,99€</span></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
