<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;

class Data
{
    function Categorie()
    {
        return [
            ['idCat' => 1, 'NomCat' => 'Artisanat'],
            ['idCat' => 2, 'NomCat' => 'Mode Femme'],
            ['idCat' => 3, 'NomCat' => 'Mode Homme'],
            ['idCat' => 4, 'NomCat' => 'Bijouterie'],
            ['idCat' => 5, 'NomCat' => 'Produits Alimentaires']
        ];
    }

    function CodePostal()
    {
        return [
            ['Cp' => "13001", 'Ville' => 'Marseille'],
            ['Cp' => "13002", 'Ville' => 'Marseille'],
            ['Cp' => "13003", 'Ville' => 'Marseille'],
            ['Cp' => "13009", 'Ville' => 'Marseille'],
            ['Cp' => "13400", 'Ville' => 'Aubagne'],
            ['Cp' => "13800", 'Ville' => 'Istres'],
            ['Cp' => "06950", 'Ville' => 'Falicon'],
            ['Cp' => '83000', 'Ville' => 'Toulon'],
            ['Cp' => '84000', 'Ville' => 'Avignon']

        ];
    }

    function Vendeurs()
    {
        return [
            [
                'IdVend' => 2, 'PrenomVend' => 'Victor', 'NomVend' => 'Comlan', 'NomEntreprise' => 'samsung',
                'DescripEntreprise' => 'mon magasin', 'MailVend' => 'victor@gmail.com',
                'TelVend' => '0645698745', 'SiretVend' => '98765432198745', 'RibVend' => '1234567891', 'Adresse' => 'rue saint pierre',
                'Ville' => 'marseille', 'Cp' => '13009'
            ],
            [
                'IdVend' => 2, 'PrenomVend' => 'Cesar', 'NomVend' => 'Ruiz', 'MailVend' => 'cesarr@gmail.com',
                'TelVend' => '0645698000', 'SiretVend' => '98765432198000', 'RibVend' => '1234567000', 'NumRue' => '201',
                'NomRue' => 'Bd Michelet', 'Cp' => '18000'
            ]
        ];
    }

    function Clients()
    {
        return [
            [
                'IdClient' => 1, 'PrenomClient' => 'Juan', 'NomClient' => 'Carlos', 'MailClient' => 'jc@gmail.com',
                'TelClient' => '0645600000', 'Ville' => 'marseille', 'Adresse' => 'Avenue du Prado', 'Cp' => '13000'
            ],
            [
                'IdClient' => 2, 'PrenomClient' => 'Carlos', 'NomClient' => 'Marx', 'MailClient' => 'cm@gmail.com',
                'TelClient' => '0645600500', 'NumRue' => '50', 'NomRue' => 'Avenue du luminy', 'Cp' => '18000'
            ],
        ];
    }

    function Produits()
    {
        return [
            [
                'IdProd' => 1, 'NomProd' => 'chaussures', 'DescriptionProd' => 'blablabla', 'EtatProd' => 'neuf',
                'QuantiteStock' => '5', 'PrixUnite' => 15.2, 'DateAjout' => '2021-01-25 17:25:00', 'imageProduit' => 'url:',
                'IdVend' => 1, 'IdCat' => 1
            ],
            [
                'IdProd' => 2, 'NomProd' => 'Pastis', 'DescriptionProd' => 'blablabla2', 'EtatProd' => 'neuf',
                'QuantiteStock' => '15', 'PrixUnite' => 21.2, 'DateAjout' => '2021-02-16 11:25:05', 'imageProduit' => 'url:',
                'IdVend' => 2, 'IdCat' => 2
            ]
        ];
    }

    function Commandes()
    {
        return [
            [
                'IdCommande' => 1, 'DateCommande' => '2021-02-16 11:25:05', 'ModeLivraison' => 'à domicile',
                'DateExpedition' => '2021-02-15 12:15:00', 'TotalPrix' =>  57.6, 'IdClient' => 2
            ]

        ];
    }

    function ContenuCommandes()
    {
        return [
            ['IdCommande' => 1, 'IdProd' => 1, 'Quant' => 1],
            ['IdCommande' => 1, 'IdProd' => 2, 'Quant' => 2]

        ];
    }

    function users()
    {

        return [
            ['Id' => 1, 'Email' => 'user@email.fr', 'Passeword_hash' => Hash::make("secret"), 'Droit_acces' => 0],
            ['Id' => 2, 'Email' => 'admin@email.fr', 'Passeword_hash' => Hash::make("secret"), 'Droit_acces' => 1],

        ];
    }
}
