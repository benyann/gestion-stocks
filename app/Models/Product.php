<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity', // Assurez-vous que 'quantity' est inclus
    ];

    public function sales()
    {
    return $this->belongsToMany(Sale::class)->withPivot('quantity', 'unit_price');
    }
}
