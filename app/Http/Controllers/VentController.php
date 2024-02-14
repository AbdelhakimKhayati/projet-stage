<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Produit;

class VentController extends Controller
{
    public function index(Request $request )
    {
        $query = Vente::query();
    
        if ($request->has('vente')) {
            $query->whereHas('produit', function ($query) use ($request) {
                $query->where('nom', 'like', '%'.$request->vente.'%');
            });
        }
    
        $ventes = $query->orderBy('created_at', 'desc')->paginate(5);
        return view('ventes.index', compact('ventes'));
    }

    public function create()
    {
        $produits = Produit::all();
        return view('ventes.create', compact('produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:1.00',
        ], [
            'produit_id.required' => 'le nom du produit est requis.',
            'produit_id.exists' => 'le nom du produit n\'est pas valide.',
            'quantite.required' => 'La quantité est requise.',
            'quantite.integer' => 'La quantité doit être un entier.',
            'quantite.min' => 'La quantité doit être d\'au moins 1.',
            'prix.required' => 'Le prix est requis.',
            'prix.numeric' => 'Le prix doit être un nombre.',
            'prix.min' => 'Le prix doit être d\'au moins 1.00.',
        ]);
    
        $produit = Produit::findOrFail($request->produit_id);
        $quantite_vendue = $request->quantite;
    
        if ($produit->quantite < $quantite_vendue) {
            return back()->withErrors(['quantite' => 'La quantité vendue est supérieure à la quantité en stock.']);
        }
    
        $vent = new Vente();
        $vent->produit_id = $request->produit_id;
        $vent->quantite = $quantite_vendue;
        $vent->prix = $request->prix;
        $vent->save();
    
        $produit->quantite -= $quantite_vendue;
        $produit->save();
    
        return redirect()->route('ventes.index')->with('success', 'Vente enregistrée avec succès.');
    }
    

    public function edit(Vente $vent)
    {
        $produits = Produit::all();
        return view('ventes.edit', compact('vent', 'produits'));
    }

    public function update(Request $request, Vente $vent)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
            'prix' => 'required|numeric|min:0.01',
        ]);

        $vent->produit_id = $request->produit_id;
        $vent->quantite = $request->quantite;
        $vent->prix = $request->prix;
        $vent->save();

        return redirect()->route('ventes.index')->with('success', 'Vente modifiée avec succès.');
    }

    public function destroy(Vente $vent)
    {
        $vent->delete();

        return redirect()->route('ventes.index')->with('success', 'Vente supprimée avec succès.');
    }
}
