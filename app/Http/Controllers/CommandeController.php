<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Fournisseur;
use App\Models\Produit;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index(Request $request){
        $query = Commande::query();
    
        if ($request->has('commande')) {
            $query->whereHas('produit', function ($query) use ($request) {
                $query->where('nom', 'like', '%'.$request->commande.'%');
            });
        }
    
        $commandes = $query->orderBy('created_at', 'desc')->paginate(5);
        return view('commandes.index', compact('commandes'));
    }
    

    public function create()
    {
        $produits = Produit::all();
        $fournisseurs = Fournisseur::all();

        return view('commandes.create', compact('produits', 'fournisseurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'quantite' => 'required|numeric|min:1',
            'prix' => 'required|numeric|min:0',
        ]);

        $commande = new Commande();
        $commande->quantite = $request->quantite;
        $commande->produit_id = $request->produit_id;
        $commande->fournisseur_id = $request->fournisseur_id;
        $commande->prix = $request->prix;
        $commande->save();

        return redirect()->route('commandes.index')->with('success', 'La commande a été ajoutée avec succès.');
    }
}
