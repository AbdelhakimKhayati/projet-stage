@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg-dark bg-opacity-50">
                <div class="card-header d-flex justify-content-between align-items-center" id="crd_header">
                    <h3>{{ __('Liste des commandes') }}</h3>
                    <form action="{{ route('commandes.index') }}" method="GET" class="form-inline">
                        <div class="input-group">
                          <input type="text" name="commande" id="Search" class="form-control" value="{{ request('commande') }}" placeholder="Rechercher un produit">
                          <div class="input-group-append mt-1">
                            <button type="submit" class="btn btn-default" id="searchIcon"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form>                  
                    <a href="{{ route('commandes.create') }}" class="btn btn-primary ml-auto" id="btn">Ajouter une commande</a>
                </div>
                <div class="row mb-3">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="commandesTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th>Prix de commande</th>
                                    <th>fournisseur</th>
                                    <th>Date</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($commandes as $commande)
                                    <tr>
                                        <td>{{ $commande->id }}</td>
                                        <td>{{ $commande->produit->nom }}</td>
                                        <td>{{ $commande->quantite }}</td>
                                        <td>{{ $commande->prix}}</td>
                                        <td>{{ $commande->fournisseur->nom }} {{$commande->fournisseur->prenom}}</td>
                                        <td>{{ $commande->created_at }}</td>
                                        {{-- <td>
                                            <a href="{{ route('commandes.edit', $commande->id) }}" class="btn btn-primary">Modifier</a>
                                            <form action="{{ route('commandes.destroy', $commande->id) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande?')">Supprimer</button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-white">
                              {{ __('Affichage des résultats :start à :end sur :total', [
                                    'start' => $commandes->firstItem(),
                                    'end' => $commandes->lastItem(),
                                    'total' => $commandes->total(),
                                ]) }}
                            </div>
                            <div>
                              {{ $commandes->onEachSide(0)->links() }}
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
