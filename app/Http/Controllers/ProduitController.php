<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use Illuminate\Support\Facades\Validator;

class ProduitController extends Controller
{
    /**
     * Affiche une liste de tous les produits.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Produit::query();

        if ($request->has('produit')) {
            $query->where('nom', 'like', '%'.$request->produit.'%');
        }

        $produits = $query->orderBy('created_at', 'desc')->paginate(5);

        // $low_q= Produit::where('quantite', '<', 20)->count();

        return view('produits.index', ['produits']);
    }

    public function getLowQuantityProducts()
    {
    $low_q_products = Produit::where('quantite', '<', 10)->pluck('nom');
    return response()->json(['products' => $low_q_products]);
    }


    /**
     * Affiche le formulaire de création d'un nouveau produit.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produits.create');

    }
    public function createModal()
    {
        return view('commandes.produit');

    }

    public function search(Request $request)
    {
      $produits = Produit::where('nom', 'like', '%' . $request->query . '%')->get();
      return view('produits.search', compact('produits'));
    }



    /**
     * Enregistre un nouveau produit dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|unique:produits,nom',
            'reference' => 'required|unique:produits,reference',
            'marque' => 'required',
            'prix' => 'required|numeric|min:0',
            'description' => 'required',
        ], [
            'nom.required' => 'Le nom du produit est obligatoire.',
            'nom.unique' => 'Un produit avec ce nom existe déjà.',
            'reference.required' => 'La référence du produit est obligatoire.',
            'reference.unique' => 'Un produit avec cette référence existe déjà.',
            'marque.required' => 'La marque du produit est obligatoire.',
            'prix.required' => 'Le prix du produit est obligatoire.',
            'prix.numeric' => 'Le prix du produit doit être un nombre.',
            'prix.min' => 'Le prix du produit doit être supérieur ou égal à 0.',
            'description.required' => 'La description du produit est obligatoire.',
        ]);

        $produit = new Produit();
        $produit->nom = $validatedData['nom'];
        $produit->reference = $validatedData['reference'];
        $produit->marque = $validatedData['marque'];
        $produit->prix = $validatedData['prix'];
        $produit->description = $validatedData['description'];
        $produit->save();

        return redirect()->route('produits.index')->with('success', 'Le produit a été ajouté avec succès.');
    }


    public function modalProduit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|unique:produits,nom',
            'reference' => 'required|unique:produits,reference',
            'marque' => 'required',
            'prix' => 'required|numeric|min:0',
            'description' => 'required',
        ], [
            'nom.required' => 'Le nom du produit est obligatoire.',
            'nom.unique' => 'Un produit avec ce nom existe déjà.',
            'reference.required' => 'La référence du produit est obligatoire.',
            'reference.unique' => 'Un produit avec cette référence existe déjà.',
            'marque.required' => 'La marque du produit est obligatoire.',
            'prix.required' => 'Le prix du produit est obligatoire.',
            'prix.numeric' => 'Le prix du produit doit être un nombre.',
            'prix.min' => 'Le prix du produit doit être supérieur ou égal à 0.',
            'description.required' => 'La description du produit est obligatoire.',
        ]);

        if ($validator->fails()) {
            session()->flash('produit');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $produit = new Produit();
        $produit->nom = $request->input('nom');
        $produit->reference = $request->input('reference');
        $produit->marque = $request->input('marque');
        $produit->prix = $request->input('prix');
        $produit->description = $request->input('description');
        $produit->save();

        return redirect()->route('commandes.create')->with('success', 'Le produit a été ajouté avec succès.');
    }



    /**
     * Affiche les détails d'un produit.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produit = Produit::findOrFail($id);
        return view('produits.show', ['produit' => $produit]);
    }

    /**
     * Affiche le formulaire d'édition d'un produit existant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        return view('produits.edit', ['produit' => $produit]);
    }

    /**
     * Met à jour un produit existant dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'nom' => 'required|max:255',
            'reference' => 'required|max:255|unique:produits,reference,'.$id,
            'marque' => 'required|max:255',
            'description' => 'nullable',
            'prix' => 'required|numeric'
        ]);

        // Mise à jour du produit
        $produit = Produit::findOrFail($id);
        $produit->update($validatedData);

        // Redirection vers la page du produit mis à jour
        return redirect()->route('produits.show', $produit->id)->with('success', 'Le produit a été mis à jour avec succès.');
    }
    public function destroy($id)
    {
    $produit = Produit::findOrFail($id);
    $produit->delete();

    return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
    }
}
