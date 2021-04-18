<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;


class Card
{

    static function count($id)
    {
        return DB::table('Paniers')->where('IdClient', $id)->count();
    }

    function addCard($array): int
    {
        return DB::table('Paniers')->insertGetId($array);
    }

    function showPanier()
    {
        return DB::table('Produits')->join('images', 'Produits.imageId', '=', 'images.id')
            ->join('Paniers', 'Paniers.IdProd', '=', 'Produits.IdProd')
            ->where('Paniers.IdClient', session()->get('user')['id'])
            ->groupBy('Produits.IdProd')
            ->orderBy('Paniers.Id', 'asc')
            ->get()
            ->toArray();
    }

    static function calcQuantity($IdProd)
    {
        return DB::table('Paniers')->where('IdClient', session()->get('user')['id'])->where('IdProd', $IdProd)
            ->sum('Quantite');
    }

    static function calcPrice($IdProd)
    {
        return DB::table('Paniers')
            ->join('Produits', 'Produits.IdProd', '=', 'Paniers.IdProd')
            ->where('IdClient', session()->get('user')['id'])
            ->where('Paniers.IdProd', $IdProd)
            ->sum('PrixUnite');
    }

    static function calcPriceTot()
    {
        return DB::table('Paniers')
            ->join('Produits', 'Produits.IdProd', '=', 'Paniers.IdProd')
            ->where('IdClient', session()->get('user')['id'])
            ->sum('PrixUnite');
    }

    function deleteItem($IdProd)
    {
        DB::table('Paniers')->where('IdProd', $IdProd)->where('IdClient', session()->get('user')['id'])->delete();
    }
}
