@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

        <div class="col-md-8">
            <div class="card">
                <div class="card-header" id="crd_header">{{ $produit->nom }}</div>

                <div class="card-body">
                    <p><strong>Référence:</strong> {{ $produit->reference }}</p>
                    <p><strong>Marque:</strong> {{ $produit->marque }}</p>
                    <p><strong>Prix:</strong> {{ $produit->prix }} DH</p>
                    <p><strong>Description:</strong> {{ $produit->description }}</p>
                </div>
            </div>
            <div class="mt-3">
                <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-primary">Modifier</a>
                <a href="{{ route('commandes.create') }}" class="btn btn-success">Valider</a>
                <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" style="display: inline-block;">
                
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
                {{-- <a href="{{ route('produits.index') }}" class="btn btn-primary">Retour</a> --}}
            </div>
        </div>
    </div>
</div>
@endsection

