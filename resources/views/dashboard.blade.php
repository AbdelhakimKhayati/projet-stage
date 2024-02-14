@extends('layouts.app')

@section('content')
<div class="container-fluid bg-dark bg-opacity-50">
  <h3 class="my-4 text-white"> Dashboard </h3>
  <div class="row">
    <div class="col-lg-3 col-md-6">
      <div class="card bg-primary text-white mb-4">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <i class="fas fa-box fa-3x"></i>
            <div class="text-right">
              <div class="h2">{{ $nbProduits }}</div>
              <div class="h5">Produit</div>
            </div>
          </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="{{ route('produits.index') }}">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card bg-warning text-white mb-4">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <i class="fas fa-truck fa-3x"></i>
            <div class="text-right">
              <div class="h2">{{ $nbFournisseurs }}</div>
              <div class="h5">Fournisseurs</div>
            </div>
          </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="{{ route('fournisseurs.index') }}">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card bg-success text-white mb-4">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <i class="fas fa-shopping-cart fa-3x"></i>
            <div class="text-right">
              <div class="h2">{{ $nbVentes }}</div>
              <div class="h5">{{ __('Ventes') }}</div>
            </div>
          </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="{{ route('ventes.index') }}">
          <span class="float-left">{{ __('View Details') }}</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card bg-danger text-white mb-4">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <i class="fas fa-clipboard-list fa-3x"></i>
            <div class="text-right">
              <div class="h2">{{ $nbCommandes }}</div>
              <div class="h5">Commandes</div>
            </div>
          </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="{{ route('commandes.index')}}">
            <span class="float-left">View Details </span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
        </a>
      </div>
    </div>
  </div>
</div>
<canvas id="myChart"></canvas>
@endsection

