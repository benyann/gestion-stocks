<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'quantity',
    ];

    // Relation avec plusieurs ventes (many-to-many)
    public function sales()
    {
        // Assure-toi que la table pivot 'product_sale' est bien configurée avec les bonnes clés étrangères
        return $this->belongsToMany(Sale::class, 'product_sale')
                    ->withPivot('quantity', 'unit_price') // Valeurs supplémentaires dans la table pivot
                    ->withTimestamps(); // Optionnel : ajoute des timestamps dans la table pivot
    }
}
