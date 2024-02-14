@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg-dark bg-opacity-50">
                <div class="card-header d-flex justify-content-between align-items-center" id="crd_header">
                    <h3> Liste des produits </h3>
                    <form action="{{ route('produits.index') }}" method="GET" class="form-inline">
                        <div class="input-group">
                          <input type="text" name="produit" id="Search" class="form-control" value="{{ request('produit') }}" placeholder="Rechercher un produit">
                          <div class="input-group-append mt-1">
                            <button type="submit" class="btn btn-default" id="searchIcon"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form>
                      <a href="{{ route('produits.create')}}" class="btn btn-success" id="btn"> Ajouter un produit </a>
                </div>
                <div class="row mb-3">
                </div>
                <div class="card-body" >
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Référence</th>
                                    <th>Marque</th>
                                    <th>Quantité</th>
                                    <th>Prix</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($produits as $produit)
                                    <tr>
                                        <td>{{ $produit->id }}</td>
                                        <td>{{ $produit->nom }}</td>
                                        <td>{{ $produit->reference }}</td>
                                        <td>{{ $produit->marque }}</td>
                                        <td>{{ $produit->quantite }}</td>
                                        <td>{{ $produit->prix }}</td>
                                        <td>
                                            {{-- <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-info btn-sm">Voir</a> --}}
                                            <a href="{{ route('produits.edit', $produit->id) }}" ><i class="fa-solid fa-pen-to-square fa-lg" style="color: #fafafa;"></i></i></a>
                                            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn" onclick="return confirm('Voulez-vous vraiment supprimer ce produit?')"><i class="fa-solid fa-trash fa-lg" style="color: #fafafa;"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-white">
                              {{__('Affichage des résultats :start à :end sur :total', [
                                    'start' => $produits->firstItem(),
                                    'end' => $produits->lastItem(),
                                    'total' => $produits->total(),
                                ]) }}
                            </div>
                            <div>
                              {{ $produits->onEachSide(0)->links() }}
                            </div>
                          </div>
                          
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
@endsection
