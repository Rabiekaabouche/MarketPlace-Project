<?php

namespace App\Http\Controllers;

use App\Repositories\Repository;
use App\Repositories\Card;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(Repository $repository, Card $card)
    {
        $this->repository = $repository;
        $this->card = $card;
    }

    public function showLogin()
    {
        if (session()->has('user')) return redirect()->back();
        //session()->put('link', url()->previous());
        return view('login');
    }

    public function login(Request $request, Repository $repository)
    {
        $rules = [
            'email' => ['required', 'email', 'exists:utilisateurs,Email'],
            'mdp' => ['required']
        ];
        $messages = [
            'email.required' => 'Vous devez saisir un e-mail.',
            'email.email' => 'Vous devez saisir un e-mail valide.',
            'email.exists' => "Cet utilisateur n'existe pas.",
            'mdp.required' => "Vous devez saisir un mot de passe.",
        ];
        $validatedData = $request->validate($rules, $messages);
        try {
            $user = $this->repository->getUser($validatedData['email'], $validatedData['mdp']);
            $request->session()->put('user', $user);
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors("Impossible de vous authentifier.");
        }
        if ($user['droit'] == 0) {
            return view('home');
        }
        if ($user['droit'] == 1) {
            return redirect()->route('vendorDashboard');
        }
        return redirect()->route('adminDashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect()->route('home');
    }

    public function vendorDashboard()
    {
        if (!session()->has('user') || session()->get('user')['droit'] != 1) return redirect()->route('login');
        return view('vendeur_home');
    }

    public function adminDashboard()
    {
        if (!session()->has('user') || session()->get('user')['droit'] != 2) return redirect()->route('login');
        return view('admin_home');
    }

    public function validationPage()
    {
        if (!session()->has('user') || session()->get('user')['droit'] != 2) return redirect()->route('login');
        $vendors = $this->repository->notValidateVendor();
        return view('validation', ['vendors' => $vendors]);
    }

    public function validateVendors(Request $request, $IdVend)
    {
        try {
            $this->repository->validateVendors($IdVend);
        } catch (Exception $e) {
            return redirect()->route('validation')->withErrors('Impossible de valider le vendeur');
        }
        return redirect()->back();
    }

    public function vendorsPage()
    {
        if (!session()->has('user') || session()->get('user')['droit'] != 2) return redirect()->route('login');
        $validateVendors = $this->repository->getVendors();
        return view('validateVendors', ['vendors' => $validateVendors]);
    }

    public function deleteVendor(Request $request, $IdVend)
    {
        $this->repository->deleteVendor($IdVend);
        return redirect()->back()->withSuccess('Le vendeur a bien été supprimé');
    }

    public function getClients()
    {
        if (!session()->has('user') || session()->get('user')['droit'] != 2) return redirect()->route('login');
        $clients = $this->repository->clients();
        return view('clients', ['clients' => $clients]);
    }

    public function deleteClient(Request $request, $IdClient)
    {
        $this->repository->deleteClient($IdClient);
        return redirect()->back()->withSuccess('Le client a bien été supprimé');
    }

    public function showProductForAdmin()
    {
        if (!session()->has('user') || session()->get('user')['droit'] != 2) return redirect()->route('login');
        $products = $this->repository->showProduct();
        return view('product_admin', ['products' => $products]);
    }

    public function ajouterClient(Request $request)
    {
        //if (!$request->session()->has('user'))
        //return redirect()->route('login');
        $rules = [
            'email' => ['required', 'email', 'unique:Utilisateurs,Email'],
            'mdp' => ['required', 'min:6', 'max:20'],
            'mdpconfirm' => ['required', 'same:mdp'],
            'tel' => ['required'],
            'nom' => ['required'],
            'adresse' => ['required'],
            'ville' => ['required'],
            'code_postal' => ['required'],
            'prenom' => ['required']
        ];

        $messages = [
            'email.email' => 'Vous devez saisir un e-mail valide.',
            'email.unique' => "Cet utilisateur existe déjà .",
            'email.required' => 'Vous devez saisir un e-mail.',
            'mdp.required' => "Vous devez saisir un mot de passe.",
            'tel.required' => "Vous devez saisir un numero de téléphone valide.",
            'nom.required' => "Vous devez saisir votre nom.",
            'prenom.required' => "Vous devez saisir votre prénom.",
            'adresse.required' => "Vous devez saisir une adresse.",
            'ville.required' => "Vous devez saisir un ville.",
            'code_postal.required' => "Vous devez saisir un code postal."
        ];

        $validatedData = $request->validate($rules, $messages);

        try {
            $userId = $this->repository->addUser($validatedData['email'], $validatedData['mdp'], 0);
            $tab = [
                'IdClient' => $userId,
                'PrenomClient' => $validatedData['prenom'],
                'NomClient' => $validatedData['nom'],
                'MailClient' => $validatedData['email'],
                'TelClient' => $validatedData['tel'],
                'Adresse' => $validatedData['adresse'],
                'Cp' => $validatedData['code_postal'],
                'Ville' => $validatedData['ville']
            ];
            $this->repository->insertClient($tab);
        } catch (Exception $expression) {

            return redirect()->route('register')->withErrors("Inscription echouee .");
        }

        return redirect()->route('register')->withSuccess('Votre inscription a bien été prise en compte. Vous pouvez vous connecter dés maintenant.');
    }

    public function formVendeur()
    {
        $cps = $this->repository->cps();
        return view('vendor', ['cps' => $cps]);
    }

    public function ajouterVendeur(Request $request)
    {
        //if (!$request->session()->has('user'))
        //return redirect()->route('login');
        $rules = [
            'email' => ['required', 'email', 'unique:Utilisateurs,Email'],
            'mdp' => ['required'],
            'tel' => ['required'],
            'nom' => ['required'],
            'prenom' => ['required'],
            'adresse' => ['required'],
            'ville' => ['required'],
            'cp' => ['required'],
            'company' => ['required'],
            'description' => ['required'],
            'siret'  => ['required', 'unique:Vendeurs,SiretVend'],
            'rib'  => ['required']
        ];

        $messages = [
            'email.required' => 'Vous devez saisir un e-mail.',
            'email.email' => 'Vous devez saisir un e-mail valide.',
            'email.unique' => "Cet utilisateur existe déjà .",
            'mdp.required' => "Vous devez saisir un mot de passe.",
            'tel.required' => "Vous devez saisir un numero de téléphone valide.",
            'nom.required' => "Vous devez saisir votre nom.",
            'prenom.required' => "Vous devez saisir votre prénom.",
            'adresse.required' => "Vous devez saisir une adresse.",
            'ville.required' => "Vous devez saisir une ville.",
            'cp.required' => "Vous devez saisir un code postal.",
            'company.required' => "Vous devez saisir le nom de votre entreprise.",
            'description.required' => "Veuillez renseigner la description de votre entreprise.",
            'siret.required' => "Vous devez renseigner un numéro de siret valide.",
            'siret.unique' => "Cette entreprise  existe déjà .",
            'rib.required' => "Vous devez saisir un RIB valide."
        ];

        $validatedData = $request->validate($rules, $messages);

        try {
            $userId = $this->repository->addUser($validatedData['email'], $validatedData['mdp'], 0);
            $tab = [
                'IdVend' => $userId,
                'PrenomVend' => $validatedData['prenom'],
                'NomVend' => $validatedData['nom'],
                'NomEntreprise' => $validatedData['company'],
                'DescripEntreprise' => $validatedData['description'],
                'MailVend' => $validatedData['email'],
                'TelVend' => $validatedData['tel'],
                'Adresse' => $validatedData['adresse'],
                'Ville' => $validatedData['ville'],
                'Cp' => $validatedData['cp'],
                'SiretVend' => $validatedData['siret'],
                'RibVend' => $validatedData['rib']
            ];
            $this->repository->insertVendeur($tab);
        } catch (Exception $expression) {
            Log::debug($expression);
            return redirect()->route('vendor')->withErrors("Inscription  echouee .");
        }

        return redirect()->route('vendor')->withSuccess('Votre inscription a bien été prise en compte. Vous pouvez vous connecter dés maintenant.');
    }

    //fonction d'affichage d'un produit après click sur son lien
    public function showProduct(int $IdProduct)
    {
        $productRow = $this->repository->product($IdProduct);
        $vendor = $this->repository->vendor($IdProduct);
        $dispo = $this->repository->dispo($IdProduct);
        return view('product', ['productRow' => $productRow, 'vendor' => $vendor, 'dispo' => $dispo]);
    }

    //fonction qui permet d'afficher les produits d'une catégorie donnée
    public function showCat(int $idCat)
    {
        $products = DB::table('Produits')->join('images', 'Produits.imageId', '=', 'images.id')->join('Vendeurs', 'Produits.IdVend', '=', 'Vendeurs.IdVend')->join('Categories', 'Produits.IdCat', '=', 'Categories.IdCat')->where('Produits.Idcat', $idCat)->get(['Produits.*', 'Vendeurs.NomEntreprise as brand', 'Categories.NomCat as NomCat'])->toArray();
        return view('cat', ['products' => $products]);
    }

    //fonction recherche produit par mot-clé
    public function search(Request $request)
    {
        $kw = $request->input('key_word');
        $products = DB::table('Produits')->join('Vendeurs', 'Produits.IdVend', '=', 'Vendeurs.IdVend')->join('images', 'Produits.imageId', '=', 'images.id')->where('Produits.NomProd', 'like', '%' . $kw . '%')->orWhere('Produits.DescriptionProd', 'like', '%' . $kw . '%')->get(['Produits.*', 'Vendeurs.NomEntreprise as brand'])->toArray();
        if (count($products) == 0) {
            return redirect()->route('home')->withErrors("Aucun produit correspondant");
        }
        return view('search', ['products' => $products]);
    }

    public function boutique($IdVend)
    {
        $products = $this->repository->boutique($IdVend);
        return view('boutique', ['products' => $products]);
    }

    /*for both admin and vendor*/

    public function deleteProduct(Request $request, $id)
    {
        $this->repository->deleteProduct($id);
        return redirect()->back()->withSuccess('Le produit à bien été supprimé.');
    }

    /*gestion panier*/

    public function addCard(Request $request)
    {
        if (!session()->has('user') || session()->get('user')['droit'] != 0) return redirect()->route('login');
        $tab = [
            'IdProd' => $request->input('IdProd'),
            'IdClient' => session()->get('user')['id']
        ];

        $this->card->addCard($tab);

        return redirect()->back()->withSuccess('Le produit a bien été ajouté dans votre panier.');
    }

    public function showCard()
    {
        $products = $this->card->showPanier();
        //$quantite = $this->card->calcQuantity();
        //$Price = $this->card->calcPrice();
        return view('panier', ['products' => $products]);
    }

    public function deleteItem(Request $request, int $IdProd)
    {
        try {
            $this->card->deleteItem($IdProd);
        } catch (Exception $e) {
            return redirect()->back()->withErrors('Impossible');
        }
        return redirect()->back();
    }

    public function vendors()
    {
        $vendors = $this->repository->getVendors();
        return view('partenaires', ['vendors' => $vendors]);
    }

    public function booth($IdVend)
    {
        $products = $this->repository->boutique($IdVend);
        return view('booth', ['products' => $products]);
    }
}
