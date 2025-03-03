<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'sale_date' => 'required|date',
        'products' => 'required|array',
        'products.*.id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|integer|min:1',
        'products.*.unit_price' => 'required|numeric|min:0',
        'payment_method' => 'required|string|in:cash,card,mobile_money', // Exemple de modes de paiement
        'paid_amount' => 'required|numeric|min:0',
    ]);

    // Calcul du montant total
    $totalAmount = 0;
    foreach ($request->products as $product) {
        $totalAmount += $product['quantity'] * $product['unit_price'];
    }

    // Calcul du montant rendu
    $changeAmount = $request->paid_amount - $totalAmount;

    // Création de la vente
    $sale = Sale::create([
        'sale_date' => $request->sale_date,
        'total_amount' => $totalAmount,
        'user_id' => auth()->id(), // ID de l'utilisateur connecté
        'payment_method' => $request->payment_method,
        'paid_amount' => $request->paid_amount,
        'change_amount' => $changeAmount,
    ]);

    // Associer les produits à la vente
    foreach ($request->products as $product) {
        $sale->products()->attach($product['id'], [
            'quantity' => $product['quantity'],
            'unit_price' => $product['unit_price'],
        ]);
    }

    return redirect()->route('sales.index')->with('success', 'Vente enregistrée avec succès.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
