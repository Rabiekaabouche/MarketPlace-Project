<?php

namespace App\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Repositories\Data;


use function PHPUnit\Framework\returnValueMap;

class Repository
{
    function createDatabase(): void
    {
        DB::unprepared(file_get_contents('database/build.sql'));
    }

    /**
     * Utilities
     */
    function getName($Id): array
    {
        return DB::table('Clients')->where('IdClient', '=', $Id)->get('*')->toArray();
    }

    // fonction d'insertion dans la base de données

    function insertClient(array $client): int
    {

        DB::table('Clients')->insert($client);
        return $client['IdClient'];
    }

    //Rmq:Avant chaque insertClient ou insertVendeur ,il faut appeler dabord addUser

    function insertVendeur(array $vendeur): int
    {

        DB::table('Vendeurs')->insert($vendeur);
        return $vendeur['IdVend'];
    }

    function insertProduit(array $produit): int
    {
        $id = DB::table('Produits')->insertGetId($produit);
        return $id;
    }

    function insertCategorie(array $cat): int
    {
        $id = DB::table('Categories')->insertGetId($cat);
        return $id;
    }

    function insertCodepostal(array $cp)
    {
        return DB::table('CodePostal')->insert($cp);
    }

    function insertImage(array $image): int
    {
        $id = DB::table('images')->insertGetId($image);
        return $id;
    }
    //array image= nomProd + prod_image

    //Recupération de tous les cps et categories et vendeurs et BD

    function cps(): array
    {
        return DB::table('CodePostal')
            ->orderBy('Cp', 'asc')
            ->get()
            ->toArray();
    }

    function categories(): array
    {
        return DB::table('Categories')
            ->orderBy('IdCat', 'asc')
            ->get()->toArray();
    }

    function vendeurs(): array
    {
        return DB::table('Vendeurs')
            ->orderBy('IdVend', 'asc')
            ->get()->toArray();
    }

    function clients(): array
    {
        return DB::table('Clients')
            ->orderBy('IdClient', 'asc')
            ->get()->toArray();
    }

    function deleteClient($id)
    {
        DB::table('Paniers')->where('IdClient', $id)->delete();
        DB::table('Clients')->where('IdClient', $id)->delete();
        DB::table('Utilisateurs')->where('Id', $id)->delete();
    }
    // fonction de remplissage de la BD

    function premierRemplissage(): void
    {
        $data = new Data();
        $categories = $data->Categorie();
        $cps = $data->CodePostal();
        foreach ($categories as $cat) {
            $this->insertCategorie($cat);
        };
        foreach ($cps as $cp) {
            $this->insertCodePostal($cp);
        };
    }

    //Fonction authentification

    function addUser(string $email, string $password, int $droit): int
    {
        $passwordHash =  Hash::make($password);
        return DB::table('Utilisateurs')->insertGetId([
            'Email' => $email,
            'Password_hash' => $passwordHash,
            'Droit_acces' => $droit
        ]);
    }

    function getUser(string $email, string $password): array
    {
        $user = DB::table('Utilisateurs')->where('Email', $email)->get()->toArray();
        $infoClient = DB::table('Clients')->where('IdClient', $user[0]['Id'])->get()->toArray();
        $infoVendor = DB::table('Vendeurs')->where('IdVend', $user[0]['Id'])->get()->toArray();
        if (!$user)
            throw new Exception("Utilisateur inconnu");
        $hash_password = $user[0]['Password_hash'];
        if (Hash::check($password, $hash_password)) {
            if ($user[0]['Droit_acces'] == 0) {
                return [
                    'id' => $user[0]['Id'],
                    'email' => $user[0]['Email'],
                    'droit' => $user[0]['Droit_acces'],
                    'Nom' => $infoClient[0]['NomClient'],
                    'Prenom' => $infoClient[0]['PrenomClient']
                ];
            }
            if ($user[0]['Droit_acces'] == 1) {
                return [
                    'id' => $user[0]['Id'],
                    'email' => $user[0]['Email'],
                    'droit' => $user[0]['Droit_acces'],
                    'Nom' => $infoVendor[0]['NomVend'],
                    'Prenom' => $infoVendor[0]['PrenomVend']
                ];
            }
            return [
                'id' => $user[0]['Id'],
                'email' => $user[0]['Email'],
                'droit' => $user[0]['Droit_acces']
                /*
                'Nom' => $infoVendor[0]['NomVend'],
                'Prenom' => $infoVendor[0]['PrenomVend']
                */
            ];
        } else {
            throw new Exception('Utilisateur inconnu');
        }
    }

    function notValidateVendor(): array
    {
        return DB::table('Utilisateurs')->join('Vendeurs', 'Utilisateurs.Id', '=', 'Vendeurs.IdVend')
            ->where('Utilisateurs.Droit_acces', 0)->orWhere('Vendeurs.Validation', 0)->get()->toArray();
    }

    static function notValidate()
    {
        return DB::table('Utilisateurs')->join('Vendeurs', 'Utilisateurs.Id', '=', 'Vendeurs.IdVend')
            ->where('Utilisateurs.Droit_acces', 0)->orWhere('Vendeurs.Validation', 0)->count();
    }

    function validateVendors($IdVend)
    {
        DB::table('Utilisateurs')->where('Id', $IdVend)->update(['Droit_acces' => 1]);
        DB::table('Vendeurs')->where('IdVend', $IdVend)->update(['Validation' => 1]);
    }

    function getVendors(): array
    {
        return DB::table('Vendeurs')->where('Validation', 1)->get()->toArray();
    }

    /// cette fonction retourne tous les produits vendus par un vendeurs
    function produitsVend(int $IdVend): array
    {
        $produitsV = DB::table('Produits')
            ->where('Idvend', '=', $IdVend)
            ->orderBy('IdProd', 'asc')
            ->get()
            ->toArray();
        return $produitsV;
    }



    /// Supprime les produits du vendeurs de toutes les table ,les images et le vendeur
    function  deleteVendor($IdVend): void
    {
        $produitsV = $this->produitsVend($IdVend);
        foreach ($produitsV as  $produit) {
            DB::table('ContenuCommandes')->where('IdProd', '=', $produit["IdProd"])->delete();
            DB::table('Paniers')->where('IdProd', '=', $produit["IdProd"])->delete();
        }
        DB::table('Produits')->where('IdVend', '=', $IdVend)->delete();
        foreach ($produitsV as  $produit) {
            DB::table('images')->where('id', '=', $produit["imageId"])->delete();
        }
        DB::table('Vendeurs')->where('IdVend', '=', $IdVend)->delete();
        DB::table('Utilisateurs')->where('Id', '=', $IdVend)->delete();
    }

    /*
    function deleteVendor($IdVend)
    {
        $Produit = DB::table('Produits')->where('IdVend', $IdVend)->get(['NomProd', 'IdProd', 'imageId'])->toArray();
        DB::table('Produits')->where('IdVend', $IdVend)->delete();
        DB::table('Paniers')->where('IdProd', $Produit[0]['IdProd'])->delete();
        DB::table('images')->where('id', $Produit[0]['imageId'])->delete();
        DB::table('Vendeurs')->where('IdVend', $IdVend)->update(['Validation' => 0]);
        DB::table('Utilisateurs')->where('Id', $IdVend)->update(['Droit_acces' => 0]);
    }
    */

    //affichage produits
    function product($IdProduct): array
    {
        $prod = DB::table('Produits')->join('images', 'Produits.imageId', '=', 'images.id')->where('IdProd', $IdProduct)->get()->toArray();
        return count($prod) == 0 ? throw new Exception('Produit inconnu') : $prod[0];
    }

    function vendor($IdProduct): array
    {
        $row = DB::table('Produits')->join('Vendeurs', 'Produits.IdVend', '=', 'Vendeurs.IdVend')->where('IdProd', $IdProduct)->get(['Vendeurs.NomEntreprise'])->toArray();
        return count($row) == 0 ? throw new Exception('Produit inconnu') : $row[0];
    }

    function dispo($IdProduct): array
    {
        $row = DB::table('Produits')->where('IdProd', $IdProduct)->get('QuantiteStock')->toArray();
        return count($row) == 0 ? throw new Exception('Produit inconnu') : $row[0];
    }

    function boutique($IdVend)
    {
        $rows = DB::table('Produits')->join('Vendeurs', 'Produits.IdVend', '=', 'Vendeurs.IdVend')->join('images', 'Produits.imageId', '=', 'images.id')->where('Vendeurs.IdVend', $IdVend)->get()->toArray();
        return $rows;
        /*count($rows) == 0 ? throw new Exception('Vendeur inconnu') :*/
    }

    /*for admin*/

    function showProduct()
    {
        return DB::table('Produits')->join('Vendeurs', 'Produits.IdVend', '=', 'Vendeurs.IdVend')->join('images', 'Produits.imageId', '=', 'images.id')->get()->toArray();
    }

    function deleteProduct($id)
    {
        $idImage = DB::table('Produits')->where('IdProd', $id)->get('imageId')->toArray();
        DB::table('Paniers')->where('IdProd', $id)->delete();
        DB::table('Produits')->where('IdProd', $id)->delete();
        DB::table('images')->where('id', $idImage[0]['imageId']);
    }
}
