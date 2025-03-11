<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //return view('dashboard'); // Assurez-vous que cette vue existe



    $ProduitsStock = Product::count();

    $totalRevenue = Sale::sum('total_amount');

    $VentesMois = Sale::whereMonth('sale_date', now()->month)->count();

    $recentSales = Sale::orderBy('sale_date', 'desc')->take(5)->get();  

    $StockFaible = Product::where('quantity', '<', 10)->get();  // Produits en faible stock

    return view('dashboard', compact('ProduitsStock', 'VentesMois', 'totalRevenue', 'recentSales', 'StockFaible'));
}

}
