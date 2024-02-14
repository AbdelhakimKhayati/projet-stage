<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Fournisseur;
use App\Models\Vente;
use App\Models\Commande;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $nbProduits = Produit::count();
        $nbFournisseurs = Fournisseur::count();
        $nbVentes = Vente::count();
        $nbCommandes = Commande::count();
        return view('dashboard', compact('nbProduits', 'nbFournisseurs', 'nbVentes', 'nbCommandes'));
    }

}
