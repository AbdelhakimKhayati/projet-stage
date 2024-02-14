@extends('layouts.app')

@section('content')
    <div class="container" style="width: 70%">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark bg-opacity-75">
                    <div class="card-header d-flex justify-content-between align-items-center" id="crd_header">
                        <h3>réaliser une vente</h3>
                        <a href="{{ route('ventes.index') }}" class="btn btn-primary ml-auto">Retour à la liste des ventes</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('ventes.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="produit_id" class="col-md-4 text-white col-form-label text-md-right">{{ __('Produit') }}</label>
                                <div class="col-md-6">
                                    <select name="produit_id" id="produit_id" class="form-control{{ $errors->has('produit_id') ? ' is-invalid' : '' }}  js-example-basic-single select2-custom">
                                        <option value="" selected disabled>Choisir un produit</option>
                                        @foreach($produits as $produit)
                                            <option value="{{ $produit->id }}" {{ old('produit_id') == $produit->id ? 'selected' : '' }}>{{ $produit->nom }}</option>
                                        @endforeach
                                    </select> 
                                    @if ($errors->has('produit_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('produit_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="quantite" class="col-md-4 text-white col-form-label text-md-right">Quantité</label>
                                <div class="col-md-6">
                                    <input id="quantite" type="number" min="1" class="form-control{{ $errors->has('quantite') ? ' is-invalid' : '' }}" name="quantite" value="{{ old('quantite') }}" required>
                                    @if ($errors->has('quantite'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('quantite') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="prix" class="col-md-4 text-white col-form-label text-md-right">Prix</label>
                                <div class="col-md-6">
                                    <input id="prix" type="number" min="0.01" step="0.01" class="form-control{{ $errors->has('prix') ? ' is-invalid' : '' }}" name="prix" value="{{ old('prix') }}" required>
                                    @if ($errors->has('prix'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('prix') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div>
                            <div class="form-group row mb-0 mt-2">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Enregistrer la vente
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
