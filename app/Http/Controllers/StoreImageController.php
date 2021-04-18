<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Images;
use Illuminate\Support\Facades\Response;
use App\Models\Images;
use Intervention\Image\Facades\Image;

use App\Repositories\Repository;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\StoreImageController as BaseController;
use Illuminate\Support\Facades\Log;




class StoreImageController extends Controller
{
    function index()
    {
        if (!session()->has('user') || session()->get('user')['droit'] != 1) return redirect()->route('login');
        $categories = $this->repository->categories();
        $data = Images::latest()->paginate(5);
        return view('add_product', ['data' => $data, 'categories' => $categories])
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    function insert_image(Request $request)
    {
        $rules = [
            'NomProd' => ['required', 'max:50'],
            'EtatProd' => ['required'],
            'QuantiteStock' => ['required', 'integer'],
            'PrixUnite' => ['required', 'numeric'],
            'DateAjout' => ['required'],
            'DescriptionProd' => ['required', 'max:250'],
            //'imageProduit' => ['required'],
            'IdCat' => ['required'],
            'prod_image' => ['required', 'image', 'max:2048']
        ];
        $messages = [
            'NomProd.required' => 'Vous devez saisir un nom de produit.',
            'NomProd.alpha_dash' => 'Vous devez saisir un nom valide.',
            'NomProd.max' => "Ce nom est trop long .",
            'EtatProd.required' => "Vous devez choisir l'état du produit.",
            'QuantiteStock.required' => "Vous devez saisir une quantité.",
            'QuantiteStock.integer' => "Vous devez saisir un entier.",
            'PrixUnite.required' => "Vous devez saisir le prix unitaire.",
            'PrixUnite.max' => "Le prix unitaire est trop grand.",
            'PrixUnite.numeric' => "Vous devez saisir un prix valide sous format numérique (xx.xx)",
            'DateAjout.required' => "Vous devez saisir une date.",
            'prod_image.required' => "Image manquante",
            'prod_image.image' => "Vous devez choisir une image",
            'prod_image.max' => "La taille de l'image est trop grande",
            'IdCat.required' => "Vous devez choisir la catégorie.",
            'DescriptionProd.required' => "Vous devez choisir la description.",
            'DescriptionProd.max' => "Cette description est trop longue ."
        ];
        $validatedData = $request->validate($rules, $messages);
        try {
            $image_file = $request->prod_image;

            $image = Image::make($image_file);

            Response::make($image->encode('jpeg'));

            $form_data = array(
                'NomProd' => $request->NomProd,
                'prod_image' => $image
            );

            $imageId = $this->repository->insertImage($form_data);
            //Images::create($form_data);
            $tab = [
                'NomProd' => $validatedData['NomProd'],
                'DescriptionProd' => $_POST['DescriptionProd'],
                'EtatProd' => $validatedData['EtatProd'],
                'QuantiteStock' => $validatedData['QuantiteStock'],
                'PrixUnite' => $validatedData['PrixUnite'],
                'DateAjout' => $validatedData['DateAjout'],
                'imageId' => $imageId,
                'IdVend' => session()->get('user')['id'],
                'IdCat' => $validatedData['IdCat']
            ];

            $this->repository->insertProduit($tab);
        } catch (Exception $expression) {
            Log::debug($expression);
            return redirect()->route('prodForm')->withErrors("Ajout  echouée .");
        }

        return redirect()->route('prodForm')->withSuccess("L'ajout de produit a bien été pris en compte.");
    }


    function fetch_image($image_id)
    {
        $image = Images::findOrFail($image_id);

        $image_file = Image::make($image->prod_image);

        $response = Response::make($image_file->encode('jpeg'));

        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }
}
