<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class FournisseurController extends Controller
{
    public function index(Request $request){
        $query = Fournisseur::query();
    
        if ($request->has('fournisseur')) {
            $query->where('nom', 'like', '%'.$request->fournisseur.'%');
        }
    
        $fournisseurs = $query->orderBy('created_at', 'desc')->paginate(6);
        return view('fournisseurs.index', compact('fournisseurs'));
    }

    public function create(){
        return view('fournisseurs.create');
    }
    public function createModal(){
        return view('commandes.fournisseur');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'adresse' => 'required |unique:fournisseurs,adresse|',
            'telephone' => 'required|unique:fournisseurs,telephone|max:255',
            'email' => 'required|unique:fournisseurs,email|max:255',
            'ICE' => 'required|max:255',
        ], [
            'nom.required' => 'Le champ nom est obligatoire.',
            'nom.max' => 'Le champ nom ne doit pas dépasser :max caractères.',
            'prenom.required' => 'Le champ prénom est obligatoire.',
            'prenom.max' => 'Le champ prénom ne doit pas dépasser :max caractères.',
            'adresse.required' => 'Le champ adresse est obligatoire.',
            'adresse.unique' => 'Un fournisseur avec la même adresse existe déjà.',
            'telephone.required' => 'Le champ téléphone est obligatoire.',
            'telephone.unique' => 'Un fournisseur avec le même numéro de téléphone existe déjà.',
            'telephone.max' => 'Le champ téléphone ne doit pas dépasser :max caractères.',
            'email.required' => 'Le champ email est obligatoire.',
            'email.unique' => 'Un fournisseur avec le même email existe déjà.',
            'email.max' => 'Le champ email ne doit pas dépasser :max caractères.',
            'ICE.required' => 'Le champ ICE est obligatoire.',
            'ICE.max' => 'Le champ ICE ne doit pas dépasser :max caractères.',
        ]);

        $existingFournisseur = Fournisseur::where('nom', $request->nom)
        ->where('prenom', $request->prenom)
        ->first();

        if ($existingFournisseur) {
        return redirect()->back()->withErrors(['Fournisseur avec le même nom et prénom existe déjà.'])->withInput($request->all());
        }
    
        if ($validator->fails()) {
            session()->flash('fournisseur');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        
    
        $fournisseur = new Fournisseur();
        $fournisseur->nom = $request->input('nom');
        $fournisseur->prenom = $request->input('prenom');
        $fournisseur->adresse = $request->input('adresse');
        $fournisseur->telephone = $request->input('telephone');
        $fournisseur->email = $request->input('email');
        $fournisseur->ICE = $request->input('ICE');
        $fournisseur->save();
    
        return redirect()->route('fournisseurs.index');
    }
    

    public function modalFournisseur(Request $request){
        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'adresse' => 'required |unique:fournisseurs,adresse|',
            'telephone' => 'required|unique:fournisseurs,telephone|max:255',
            'email' => 'required|unique:fournisseurs,email|max:255',
            'ICE' => 'required|max:255',
        ], [
            'nom.required' => 'Le champ nom est obligatoire.',
            'nom.max' => 'Le champ nom ne doit pas dépasser :max caractères.',
            'prenom.required' => 'Le champ prénom est obligatoire.',
            'prenom.max' => 'Le champ prénom ne doit pas dépasser :max caractères.',
            'adresse.required' => 'Le champ adresse est obligatoire.',
            'adresse.unique' => 'Un fournisseur avec la même adresse existe déjà.',
            'telephone.required' => 'Le champ téléphone est obligatoire.',
            'telephone.unique' => 'Un fournisseur avec le même numéro de téléphone existe déjà.',
            'telephone.max' => 'Le champ téléphone ne doit pas dépasser :max caractères.',
            'email.required' => 'Le champ email est obligatoire.',
            'email.unique' => 'Un fournisseur avec le même email existe déjà.',
            'email.max' => 'Le champ email ne doit pas dépasser :max caractères.',
            'ICE.required' => 'Le champ ICE est obligatoire.',
            'ICE.max' => 'Le champ ICE ne doit pas dépasser :max caractères.',
            
        ]);

        $existingFournisseur = Fournisseur::where('nom', $request->nom)
        ->where('prenom', $request->prenom)
        ->first();

        if ($existingFournisseur) {
        return redirect()->back()->withErrors(['Fournisseur avec le même nom et prénom existe déjà.'])->withInput($request->all());
        }
    
        if ($validator->fails()) {
            session()->flash('fournisseur');
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        
    
        $fournisseur = new Fournisseur();
        $fournisseur->nom = $request->input('nom');
        $fournisseur->prenom = $request->input('prenom');
        $fournisseur->adresse = $request->input('adresse');
        $fournisseur->telephone = $request->input('telephone');
        $fournisseur->email = $request->input('email');
        $fournisseur->ICE = $request->input('ICE');
        $fournisseur->save();
    
        return redirect()->route('commandes.create')->with('success', 'Le fournisseur a été ajouté avec succès.');
    }



    
    public function edit($id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        return view('fournisseurs.edit', compact('fournisseur'));
    }

    public function update(Request $request, $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->nom = $request->nom;
        $fournisseur->adresse = $request->adresse;
        $fournisseur->telephone = $request->telephone;
        $fournisseur->save();

        return redirect()->route('fournisseurs.index');
    }

    public function destroy($id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->delete();

        return redirect()->route('fournisseurs.index');
    }
}
