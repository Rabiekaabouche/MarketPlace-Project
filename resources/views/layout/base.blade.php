<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="/css/app.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho+B1:wght@400;500&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@700&family=Shippori+Mincho+B1:wght@400;500&display=swap" rel="stylesheet">

    <title>@yield('title', 'page inconnue')</title>
    @yield('geoloc')
</head>
<body>

    @include('layout.navbar')
    @yield('content')

    <footer class="page-footer bg-dark">

        <div class="bg-danger">
            <div class="container">
                <div class="row py-4 d-flex align-items-center">
                    <div class="col-md-12 text-center">
                        <a href="#"><i class="fab fa-facebook-f text-white mr-4"></i></a>
                        <a href="#"><i class="fab fa-twitter text-white mr-4"></i></a>
                        <a href="#"><i class="fab fa-instagram text-white mr-4"></i></a>
                        <a href="#"><i class="fab fa-google-plus-g text-white mr-4"></i></a>

                    </div>
                </div>
            </div>
        </div>

        <div class="container text-center text-md-left mt-5">
            <div class="row">
                <div class="col-md-4 mx-auto mb-4">
                    <h6 class="text-uppercase font-weight-bold">Partenaires</h6>
                    <hr class="bg-danger mb-4 mt-0 d-inline-block mx-auto" style="width: 125px; height: 2px;">
                    <p class="mt-2"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente nesciunt maxime, corrupti dolore doloribus quo praesentium fuga, possimus hic optio maiores commodi necessitatibus id nulla, amet iste earum dolor quas?</p>
                </div>
                <div class="col-md-3 mx-auto mb-4">
                    <h6 class="text-uppercase font-weight-bold mx-auto">Catégories</h6>
                    <hr class="bg-danger mb-4 mt-0 d-inline-block mx-auto" style="width: 115px; height: 2px;">

                    <ul class="list-unstyled">
                        <li class="my-2  clickable"><a href="/cat/3" class="bg-menu deco-none">Mode homme</a></li>
                        <li class="my-2  clickable"><a href="/cat/2" class="bg-menu deco-none">Mode femme</a></li>
                        <li class="my-2  clickable"><a href="/cat/1" class="bg-menu deco-none">Artisanat</a></li>
                        <li class="my-2  clickable"><a href="/cat/4" class="bg-menu deco-none">Bijouterie</a></li>
                        <li class="my-2  clickable"><a href="/cat/5" class="bg-menu deco-none">Produits alimentaires</a></li>

                    </ul>
                </div>

                <div class="col-md-3 mx-auto mb-4">
                    <h6 class="text-uppercase font-weight-bold">Liens utiles</h6>
                    <hr class="bg-danger mb-4 mt-0 d-inline-block mx-auto" style="width: 125px; height: 2px;">

                    <ul class="list-unstyled">
                        <li class="my-2 clickable"><a href="{{route('home')}}" class="bg-menu deco-none">Acceuil</a></li>
                        <li class="my-2 clickable"><a href="#" class="bg-menu deco-none">A propos</a></li>
                        <li class="my-2 clickable"><a href="#" class="bg-menu deco-none">Contact</a></li>
                        <li class="my-2 clickable"><a href="{{route('login')}}" class="bg-menu deco-none">Connexion</a></li>
                        <li class="my-2 clickable"><a href="{{route('register')}}" class="bg-menu deco-none">Inscription clients</a></li>
                        <li class="my-2 clickable"><a href="{{route('vendor')}}" class="bg-menu deco-none">Inscription vendeurs</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-copyright text-center py-3">
            <p><small>&copy; Copyright 2021. Designed by Group 7</small></p>
        </div>

    </footer>
    @yield('script_geoloc')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>
