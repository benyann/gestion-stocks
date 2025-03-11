<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Afficher la liste des produits.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Afficher le formulaire de création d'un produit.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Enregistrer un nouveau produit.
     */
    public function store(Request $request)
    {
        // Validation des données d'entrée
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0', // Validation de la quantité pour ne pas accepter des valeurs négatives
        ]);

        // Créer un produit
        Product::create($request->only(['name', 'description', 'price', 'quantity']));

        // Retourner une réponse avec succès
        return redirect()->route('products.index')->with('success', 'Produit créé avec succès.');
    }

    /**
     * Afficher un produit spécifique.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id); // Utilisation de findOrFail pour gérer les erreurs
        return view('products.show', compact('product'));
    }

    /**
     * Afficher le formulaire de modification d'un produit.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id); // Utilisation de findOrFail pour garantir la validité de l'ID
        return view('products.edit', compact('product'));
    }

    /**
     * Mettre à jour un produit existant.
     */
    public function update(Request $request, string $id)
    {
        // Validation des données d'entrée
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0', // Validation de la quantité
        ]);

        // Récupérer le produit et mettre à jour ses données
        $product = Product::findOrFail($id);
        $product->update($request->all());

        // Retourner une réponse avec succès
        return redirect()->route('products.index')
            ->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Supprimer un produit.
     */
    public function destroy(string $id)
    {
        // Tenter de trouver le produit
        $product = Product::findOrFail($id);

        // Supprimer le produit
        $product->delete();

        // Retourner une réponse avec succès
        return redirect()->route('products.index')
            ->with('success', 'Produit supprimé avec succès.');
    }
}
