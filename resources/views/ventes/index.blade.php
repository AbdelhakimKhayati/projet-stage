@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg-dark bg-opacity-50">
                <div class="card-header d-flex justify-content-between align-items-center" id="crd_header">
                    <h3>Liste des ventes</h3>
                    <form action="{{ route('ventes.index') }}" method="GET" class="form-inline">
                        <div class="input-group">
                          <input type="text" name="vente" id="Search" class="form-control" value="{{ request('vente') }}" placeholder="Rechercher un produit">
                          <div class="input-group-append mt-1">
                            <button type="submit" class="btn btn-default" id="searchIcon"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form>
                    <a href="{{ route('ventes.create') }}" id="btn" class="btn btn-primary ml-auto">Réaliser une vente</a>
                </div>            
                <div class="row mb-3">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="ventesTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th>Prix</th>
                                    <th>Date</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ventes as $vente)
                                    <tr>
                                        <td>{{ $vente->id }}</td>
                                        <td>{{ $vente->produit->nom }}</td>
                                        <td>{{ $vente->quantite }}</td>
                                        <td>{{ $vente->prix }}</td>
                                        <td>{{ $vente->created_at }}</td>
                                        {{-- <td>
                                            <a href="{{ route('ventes.edit', $vente->id) }}" class="btn btn-primary">Modifier</a>
                                            <form action="{{ route('ventes.destroy', $vente->id) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette vente?')">Supprimer</button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                              {{ $ventes->onEachSide(0)->links() }}
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
    