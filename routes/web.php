<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\StoreImageController;
use App\Models\Images;
use Symfony\Component\Routing\Route as ComponentRoutingRoute;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('client/register', function () {
    return view('register');
})->name('register');

Route::get('Geolocalisation', function () {
    return view('geo');
})->name('geolocalisation');

Route::post('/client', [Controller::class, 'ajouterClient'])->name('client.post');

Route::get('vendor/register', [Controller::class, 'formVendeur'])->name('vendor');

Route::post('/vendor', [Controller::class, 'ajouterVendeur'])->name('vendeur.post');

Route::get('/login', [Controller::class, 'showLogin'])->name('login');

Route::post('/login', [Controller::class, 'login'])->name('login.post');

Route::post('/logout', [Controller::class, 'logout'])->name('logout');

Route::get('/vendeur/dashboard', [Controller::class, 'vendorDashboard'])->name('vendorDashboard');
//route boutique
Route::get('/vendeurs/{idVend}', [Controller::class, 'boutique'])->name('boutique.show');
Route::get('/admin/dashboard', [Controller::class, 'adminDashboard'])->name('adminDashboard');

Route::get('/admin/validation', [Controller::class, 'validationPage'])->name('validation');
Route::get('/admin/vendors', [Controller::class, 'vendorsPage'])->name('validateVendors');
Route::post('/admin/validation/{IdVend}', [Controller::class, 'validateVendors'])->where('IdVend', '[0-9]+')->name('validation.post');
Route::post('admin/deleteVendor/{IdVend}', [Controller::class, 'deleteVendor'])->where('IdVend', '[0-9]+')->name('vendor.delete');

Route::get('admin/clients', [Controller::class, 'getClients'])->name('clients');
Route::post('admin/clients/delete/{IdClient}', [Controller::class, 'deleteClient'])->name('client.delete');
Route::get('/admin/Products', [Controller::class, 'showProductForAdmin'])->name('productForAdmin');
Route::post('/admin/Product/delete/{id}', [Controller::class, 'deleteProduct'])->name('deleteProduct.post');
Route::post('/vendeur/Product/delete/{id}', [Controller::class, 'deleteProduct'])->name('deleteProduct_v.post');




// Ajout produit d'un produits
Route::get('add_product', 'App\Http\Controllers\StoreImageController@index')->name('prodForm');
Route::post('add_product/insert_image', 'App\Http\Controllers\StoreImageController@insert_image');
Route::get('store_image/fetch_image/{id}', 'App\Http\Controllers\StoreImageController@fetch_image');


//gestion du panier
Route::get('/panier', [Controller::class, 'showCard'])->name('showPanier');

Route::post('/panier/add', [Controller::class, 'addCard'])->name('card.post');

Route::post('/panier/delete/{IdProd}', [Controller::class, 'deleteItem'])->name('panier.delete');

//affichage catégories
Route::get('/cat/{idCat}', [Controller::class, 'showCat'])->name('cat.show');
//affichage résultats recherche
Route::get('/search', [Controller::class, 'search'])->name('search');
//affichage produit
Route::get('/products/{IdProduct}', [Controller::class, 'showProduct'])->where('IdProduct', '[0-9]+')->name('products.show');

//route partenaires
Route::get('/vendeur/{idVend}', [Controller::class, 'booth'])->name('booth.show');
Route::get('/partenaires', [Controller::class, 'vendors'])->name('vendors.show');
