<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    // Afficher la liste des ventes
    public function index()
    {
        $sales = Sale::with(['user', 'products'])->get();
        return view('sales.index', compact('sales'));
    }

    // Afficher le formulaire de création d'une vente
    public function create()
    {
        $products = Product::all();
        return view('sales.create', compact('products'));
    }

    // Enregistrer une nouvelle vente
    public function store(Request $request)
{
    $validated = $request->validate([
        'sale_date' => 'required|date',
        'customer_name' => 'required|string|max:255',
        'products' => 'required|array',
        'products.*.id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|integer|min:1',
    ]);

    // Calcul du montant total
    $totalAmount = 0;
    foreach ($validated['products'] as $productData) {
        $product = Product::findOrFail($productData['id']);
        $totalAmount += $product->price * $productData['quantity'];
    }

    // Enregistrement de la vente
    $sale = new Sale();
    $sale->sale_date = $validated['sale_date'];
    $sale->customer_name = $validated['customer_name'];
    $sale->total_amount = $totalAmount;
    $sale->user_id = auth()->user()->id;
    $sale->save();

    // Association des produits via la table pivot
    foreach ($validated['products'] as $productData) {
        $product = Product::findOrFail($productData['id']);
        $sale->products()->attach($productData['id'], [
            'quantity' => $productData['quantity'],
            'unit_price' => $product->price,
        ]);

        // Réduction de la quantité du produit
        $product->decrement('quantity', $productData['quantity']);
    }

    return redirect()->route('sales.index')->with('success', 'Vente enregistrée avec succès');
}

    // Afficher les détails d'une vente
    public function show(string $id)
    {
        $sale = Sale::with(['user', 'products'])->findOrFail($id);
        return view('sales.show', compact('sale'));
    }

    // Afficher le formulaire de modification d'une vente
    public function edit(string $id)
    {
        $sale = Sale::with(['products'])->findOrFail($id);
        $products = Product::all();
        return view('sales.edit', compact('sale', 'products'));
    }

    // Mettre à jour une vente existante
    public function update(Request $request, string $id)
    {
        $request->validate([
            'sale_date' => 'required|date',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.unit_price' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'customer_name' => 'required|string|max:255',
        ]);

        $sale = Sale::findOrFail($id);
        $totalAmount = 0;
        foreach ($request->products as $product) {
            $totalAmount += $product['quantity'] * $product['unit_price'];
        }

        $changeAmount = $request->paid_amount - $totalAmount;

        $sale->update([
            'sale_date' => $request->sale_date,
            'total_amount' => $totalAmount,
            'payment_method' => $request->payment_method,
            'paid_amount' => $request->paid_amount,
            'change_amount' => $changeAmount,
            'customer_name' => $request->customer_name,
        ]);

        $sale->products()->detach();
        foreach ($request->products as $productData) {
            $product = Product::find($productData['id']);
            $product->decrement('quantity', $productData['quantity']);
            $sale->products()->attach($productData['id'], [
                'quantity' => $productData['quantity'],
                'unit_price' => $productData['unit_price'],
            ]);
        }

        return redirect()->route('sales.index')->with('success', 'Vente mise à jour avec succès.');
    }

    // Supprimer une vente
    public function destroy(string $id)
    {
        $sale = Sale::findOrFail($id);

        foreach ($sale->products as $product) {
            $product->increment('quantity', $product->pivot->quantity);
        }

        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Vente supprimée avec succès.');
    }

    // Générer un PDF pour une vente
    public function generatePdf(string $id)
    {
        $sale = Sale::with(['user', 'products'])->findOrFail($id);
        $pdf = Pdf::loadView('sales.pdf', compact('sale'));
        return $pdf->download('facture-vente-' . $sale->id . '.pdf');
    }
}
