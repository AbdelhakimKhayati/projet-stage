<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VenteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/low-quantity-products', [ProduitController::class, 'getLowQuantityProducts']);
    Route::resource('produits', 'App\Http\Controllers\ProduitController');
    Route::post('/ajouter-produit', [ProduitController::class, 'modalProduit'])->name('ajouter_produit');
    Route::Put('/ajouter-update', [ProduitController::class, 'edit'])->name('produits.update');
    Route::get('/produits/search', [ProduitController::class, 'search'])->name('produits.search');
    Route::get('commande/produit', [ProduitController::class, 'createModal'])->name('createModalProduit');
    Route::resource('commandes', 'App\Http\Controllers\CommandeController');
    Route::resource('fournisseurs', 'App\Http\Controllers\FournisseurController');
    Route::post('/fournisseur/modal', [FournisseurController::class, 'modalFournisseur'])->name('modalFournisseur');
    Route::get('commande/fourinsseur', [FournisseurController::class, 'createModal'])->name('createModalFournissuer');
    Route::resource('ventes', 'App\Http\Controllers\VentController');
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
});


