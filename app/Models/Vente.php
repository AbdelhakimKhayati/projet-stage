<?php

namespace App\Models;
use App\Models\Produit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
    public static function boot()
    {
        parent::boot();

        self::created(function ($ventes) {
            $produit = $ventes->produit;
            $produit->quantite -= $ventes->quantite;
            $produit->save();
        });
    }
}
