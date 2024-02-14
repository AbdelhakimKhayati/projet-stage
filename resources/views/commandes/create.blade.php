@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card bg-dark bg-opacity-75">
                    <div class="card-header text-white" id="crd_header">Créer une commande </div>
                    <div class="card-body ">
                        <form action="{{ route('commandes.store') }}" method="POST">
                            @csrf
                            <div class="form-group row p-2">
                                <div class="col-md-2 text-white">
                                    <label for="produit_id">Produit</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="produit_id" id="produit_id"  class="form-control js-example-basic-single select2-custom">
                                        <option value="" selected>Sélectionner un produit</option>
                                        @foreach ($produits as $produit)
                                            <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                                        @endforeach
                                    </select> 
                                    @error('produit_id')
                                        <strong class="invalid-feedback" role="alert">{{ $message}}</strong>
                                    @enderror                       
                                </div>
                                <div class="col-md-2">
                                    <a type="button" class="btn btn-primary ml-2" href="{{ route('createModalProduit') }}">
                                        <i class="fa-sharp fa-solid fa-cart-plus"></i> 
                                    </a>
                                </div>
                                
                            </div>
                            <div class="form-group row p-2">
                                <div class="col-md-2 text-white">
                                    <label for="fournisseur_id">Fournisseur</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="fournisseur_id" id="fournisseur_id" class="form-control js-example-basic-single select2-custom">
                                        <option value="" selected>Sélectionner un fournisseur</option>
                                        @foreach ($fournisseurs as $fournisseur)
                                            <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }} {{ $fournisseur->prenom }}</option>
                                        @endforeach
                                    </select>
                                    @error('fournisseur_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <a type="button" class="btn btn-primary ml-2" href="{{ route('createModalFournissuer') }}">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="form-group row p-2">
                                <div class="col-2 text-white">
                                    <label for="quantite">Quantité</label>
                                </div>
                                <div class="col-6">
                                    <input type="number" name="quantite" id="quantite" class="form-control">
                                    @error('quantite')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row p-2">
                                <div class="col-3 text-white">
                                    <label for="prix">prix commande</label>
                                </div>
                                <div class="col-6">
                                    <input type="number" name="prix" id="prix" class="form-control">
                                    @error('prix')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class='d-flex justify-content-center mt-4'>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                <button type="submit" class="btn btn-primary">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 

