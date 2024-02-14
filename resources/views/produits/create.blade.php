@extends('layouts.app')

@section('content')
    <div class="container" style="width: 70%">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="card bg-dark bg-opacity-75">
                    <div class="card-header " id="crd_header">
                        <h3>Ajouter un produit</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('produits.store') }}">
                            @csrf
                            <div class="form-group row mt-2">
                                <label for="nom" class="col-md-4 text-white col-form-label text-md-right">Nom</label>
                                <div class="col-md-6">
                                    <input id="nom" type="text" class="form-control{{ $errors->has('nom') ? ' is-invalid' : '' }}" name="nom" value="{{ old('nom') }}" placeholder="Entrez le nom du produit" required autofocus>
                                    @if ($errors->has('nom'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nom') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="reference" class="col-md-4 text-white col-form-label text-md-right">Référence</label>
                                <div class="col-md-6">
                                    <input id="reference" type="text" class="form-control{{ $errors->has('reference') ? ' is-invalid' : '' }}" name="reference" value="{{ old('reference') }}" placeholder="Entrez Reference" required autofocus>
                                    @if ($errors->has('reference'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('reference') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="marque" class="col-md-4 text-white col-form-label text-md-right">Marque</label>
                                <div class="col-md-6">
                                    <input id="marque" type="text" class="form-control{{ $errors->has('marque') ? ' is-invalid' : '' }}" name="marque" value="{{ old('marque') }}" placeholder="Entrez la marque de produit" required autofocus>
                                    @if ($errors->has('marque'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('marque') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="prix" class="col-md-4 text-white col-form-label text-md-right">Prix</label>
                                <div class="col-md-6">
                                    <input id="prix" type="number" min="0.01" step="0.01" class="form-control{{ $errors->has('prix') ? ' is-invalid' : '' }}" name="prix" value="{{ old('prix') }}" placeholder="Entrez le proix" required>
                                    @if ($errors->has('prix'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('prix') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="description" class="col-md-4 text-white col-form-label text-md-right">Description</label>
                                <div class="col-md-6">
                                    <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" placeholder="Tapez une description" required>{{ old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0 mt-2">
                                <div class="col-6 row offset-md-4 d-flex  align-items-center">
                                    <div class="col-7">
                                    <button type="submit" class="btn btn-success w-100">
                                        Ajouter
                                    </button>
                                    </div>
                                    <div class="col-5">
                                    <a href="{{ route('produits.index') }}" class="btn btn-primary w-100">Annuler</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


