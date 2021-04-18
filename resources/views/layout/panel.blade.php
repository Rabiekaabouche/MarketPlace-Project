<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"/>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho+B1:wght@400;500&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@700&family=Shippori+Mincho+B1:wght@400;500&display=swap" rel="stylesheet">

        <title>@yield('title', 'page inconnue')</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/dashboard/"/>

        <!-- Bootstrap core CSS
        <link href="../../dist/css/bootstrap.min.css" rel="stylesheet" />
            -->
        <!-- Custom styles for this template -->
        <link href="/css/dashboard.css" rel="stylesheet" />
    </head>

    <body>
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
            <a
                class="navbar-brand col-sm-3 col-md-2 text-center "
                href="{{route('home')}}"
                style="font-family: 'Merienda', cursive; font-size: 1.25rem;"
                >PACA <span style="color: rgb(199, 0, 0)">Market</span>
            </a>

            <div class="navbar-nav ">
                <form class="navbar-nav" method="POST" action="{{route('logout')}}">
                    @csrf
                    <div class="navbar-nav btn-group">
                        <span class="btn btn-danger disabled text-center" style="padding-bottom: 7px;" >{{session()->get('user')['email']}}</span>
                        <button type="submit" class="btn btn-outline-danger"><i class="fas fa-sign-out-alt mr-2" aria-hidden="true" style="color: white"></i>Déconnexion</button>
                    </div>
                </form>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 col-sm-12 d-none d-md-block bg-light sidebar ">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            @yield('sidebar')

                        </ul>
                        {{--
                        <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted"
                        >
                        <span>Saved reports</span>
                        <a class="d-flex align-items-center text-muted" href="#">
                            <span data-feather="plus-circle"></span>
                        </a>
                        </h6>
                        <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Current month
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Last quarter
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Social engagement
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            Year-end sale
                            </a>
                        </li>
                        </ul>
                        --}}
                    </div>
                </nav>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                        <h1 class="h2">@yield('title')</h1>
                    </div>

                    @yield('content')
                {{--
                <div class="row">
                    <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="..." class="card-img-top" alt="..." />
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                            Some quick example text to build on the card title and make
                            up the bulk of the card's content.
                        </p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    </div>

                    <div class="col-md-4 align-items-center">
                    <div class="card">
                        <img src="..." class="card-img-top" alt="..." />
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                            Some quick example text to build on the card title and make
                            up the bulk of the card's content.
                        </p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    </div>

                    <div class="col-md-4 align-items-center">
                    <div class="card">
                        <img src="..." class="card-img-top" alt="..." />
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                            Some quick example text to build on the card title and make
                            up the bulk of the card's content.
                        </p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    </div>

                    <div class="col-md-4 align-items-center">
                    <div class="card">
                        <img src="..." class="card-img-top" alt="..." />
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                            Some quick example text to build on the card title and make
                            up the bulk of the card's content.
                        </p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    </div>
                </div>
                --}}
                </main>
            </div>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        <!-- Icons -->
        <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
        <script>
        feather.replace();
        </script>

        <script
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"
        ></script>
        <script
        src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"
        ></script>
        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF"
        crossorigin="anonymous"
        ></script>
    </body>
</html>
