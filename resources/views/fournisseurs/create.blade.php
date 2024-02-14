@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark bg-opacity-75">
                    <div class="card-header" id="crd_header">{{ __('Ajouter un fournisseur') }}</div>

                    <div class="card-body ">
                        <form method="POST" action="{{ route('fournisseurs.store') }}">
                            @csrf

                            <div class="form-group row mt-2">
                                <label for="nom" class="col-md-4 text-white col-form-label text-md-right">Nom</label>
                                <div class="col-md-6">
                                    <input id="nom" type="text" class="form-control @if($errors->has('nom')) is-invalid @endif" name="nom" value="{{ old('nom') }}" required placeholder="Entrez le nom du fournisseur" autocomplete="nom" autofocus>
                                    @if ($errors->has('nom'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nom') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                            

                            <div class="form-group row mt-2">
                                <label for="prenom" class="col-md-4 text-white  col-form-label text-md-right">Prénom</label>

                                <div class="col-md-6">
                                    <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" placeholder="Entrez le prenom du fournisseur" required autocomplete="prenom">

                                    @if ($errors->has('prenom'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('prenom') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <label for="adresse" class="col-md-4 text-white  col-form-label text-md-right">Adresse</label>

                                <div class="col-md-6">
                                    <input id="adresse" type="text" class="form-control @error('adresse') is-invalid @enderror" name="adresse" value="{{ old('adresse') }}" placeholder="adresse" required autocomplete="adresse">

                                    @error('adresse')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <label for="telephone" class="col-md-4 text-white  col-form-label text-md-right">Téléphone</label>

                                <div class="col-md-6">
                                    <input id="telephone" type="number" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" placeholder="Numéro de téléphone" required autocomplete="telephone">

                                    @error('telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <label for="email" class="col-md-4 text-white  col-form-label text-md-right">Adresse e-mail</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Adresse e-mail" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="ICE" class="col-md-4 text-white  col-form-label text-md-right">ICE : </label>

                                <div class="col-md-6">
                                    <input id="ICE" type="text" class="form-control @error('ICE') is-invalid @enderror" name="ICE" value="{{ old('ICE') }}" placeholder="Entrez le ICE de fournisseur" required autocomplete="ICE">

                                    @error('ICE')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 row offset-md-4 mt-2">
                                    <div class="col-6">
                                    <button type="submit" class="btn btn-primary w-100">
                                        Ajouter
                                    </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('fournisseurs.index') }}" class="btn btn-primary w-100">Annuler</a>
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