@extends('layout.base')

@section('geoloc')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin="">
    </script>
@endsection



@section('content')
<section class="sub mb-5 " style="background-color: rgba(199, 0, 0, 0.699);">
    <div class="container">
        <div class="row">
            <form class="form-inline my-2 my-lg-0 input-group">
                <input class="form-control mr-sm-2 search" type="text" placeholder="Trouver un produit" aria-label="Search">
                <button class="btn btn-outline-danger my-2 my-sm-0" type="submit"><i class="fas fa-search mr-2" style="color: white"></i>rechercher</button>
            </form>
        </div>
    </div>
</section>
<div class="container p-0 mb-5 px-0 w-100">
    <div class="row">
        <div class="col-md-12 text-center mb-5">
            <h1 class="border-bottom shadow-sm p-3 px-md-4">Marchés à proximité</h1>
        </div>
        <div id="mapid" class="col-md-12" style="height: 500px"></div>
    </div>
</div>
@endsection

@section('script_geoloc')
<script>
    window.onload = function(){
        //->coordonées centrés sur de Noailles

        var mymap = L.map('mapid',{

        center : [43.296587, 5.378182],
        zoom: 13});

        var mapUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}';
        var mapAttribution= 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';
        var mapToken= 'pk.eyJ1IjoiY2FycDIxMTIiLCJhIjoiY2ttZWRoY3p3Mmk3ajJvbXo0eGZ3c2kycCJ9.deolEDEmtJihomemAE8mdg';

        var Tile_MapFrance = L.tileLayer(mapUrl, {
            attribution: mapAttribution,
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: mapToken
        });

        Tile_MapFrance.addTo(mymap);
        var marker01 = L.marker([43.29614, 5.37861]).addTo(mymap);
        marker01.bindPopup("<b>Maison Empereur</b><br>4 Rue des Récolettes, 13001<br>Ouvert L-S 10-17 hrs");//.openPopup();
        var marker02 = L.marker([43.29765, 5.36859]).addTo(mymap);
        marker02.bindPopup("<b>Le Bazar de César</b><br>4 Montée des Accoules, 13002 <br> Ouvert L-S 9-17 hrs");//.openPopup();
        var marker03 = L.marker([43.29100, 5.36776]).addTo(mymap);
        marker03.bindPopup("<b>Le Four des Navettes</b><br>136 Rue Sainte, 13007<br> Ouvert L-S 9-17 hrs");//.openPopup();
        var marker04 = L.marker([43.293218, 5.384386]).addTo(mymap);
        marker04.bindPopup("<b>Timomo Mode</b><br>10 Rue Bussy l'Indien, 13006 Marseille<br> Ouvert L-S 9-17 hrs");//.openPopup(); .
    }
</script>
@endsection

