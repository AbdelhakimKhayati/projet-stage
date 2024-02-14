<?php

namespace App\Models;
use App\Models\Produit;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
    public function fournisseur()
    {

        return $this->belongsTo(Fournisseur::class);
    }
    
    public static function boot()
    {
        parent::boot();

        self::created(function ($commande) {
            $produit = $commande->produit;
            $produit->quantite += $commande->quantite;
            $produit->save();
        });
    }

}
