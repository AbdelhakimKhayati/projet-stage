@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark bg-opacity-50">
                    <div id="crd_header" class="card-header d-flex justify-content-between align-items-center">
                        <h3>Liste des Fournisseurs</h3>
                        <form action="{{ route('fournisseurs.index') }}" method="GET" class="form-inline">
                            <div class="input-group">
                              <input type="text" name="fournisseur" id="Search" class="form-control" value="{{ request('fournisseur') }}" placeholder="Rechercher un produit">
                              <div class="input-group-append mt-1">
                                <button type="submit" class="btn btn-default" id="searchIcon"><i class="fas fa-search"></i></button>
                              </div>
                            </div>
                          </form>
                        <a href="{{ route('fournisseurs.create') }}" id="btn" class="btn btn-primary ml-auto">Ajouter une fournisseurs</a>
                    </div>
                    <div class="row mb-3">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="fournisseursTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID </th>
                                        <th> Nom </th>
                                        <th> Prénom </th>
                                        <th> Adresse </th>
                                        <th> Téléphone </th>
                                        <th> Email </th>
                                        {{-- <th>{{ __('ICE') }}</th> --}}
                                        {{-- <th>{{ __('Actions') }}</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fournisseurs as $fournisseur)
                                        <tr>
                                            <td>{{ $fournisseur->id }}</td>
                                            <td>{{ $fournisseur->nom }}</td>
                                            <td>{{ $fournisseur->prenom }}</td>
                                            <td>{{ $fournisseur->adresse }}</td>
                                            <td>{{ Str::limit($fournisseur->telephone, 4, '...') }}</td>
                                            <td>{{ $fournisseur->email }}</td>
                                            {{-- <td>{{ $fournisseur->ICE }}</td> --}}
                                            {{-- <td>
                                                <a href="{{ route('fournisseurs.show', $fournisseur->id) }}" class="btn btn-sm btn-primary">{{ __('Voir') }}</a>
                                                <a href="{{ route('fournisseurs.edit', $fournisseur->id) }}" class="btn btn-sm btn-warning">{{ __('Modifier') }}</a>
                                                <form action="{{ route('fournisseurs.destroy', $fournisseur->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Êtes-vous sûr de vouloir supprimer ce fournisseur ?') }}')">{{ __('Supprimer') }}</button>
                                                </form>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-white">
                                  {{ __('Affichage des résultats :start à :end sur :total', [
                                        'start' => $fournisseurs->firstItem(),
                                        'end' => $fournisseurs->lastItem(),
                                        'total' => $fournisseurs->total(),
                                    ]) }}
                                </div>
                                <div>
                                  {{ $fournisseurs->onEachSide(0)->links() }}
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
