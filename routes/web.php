<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Authentification
Route::get('/register', [AuthController::class, 'showSignup'])->name('register');
Route::post('/register', [AuthController::class, 'signUp'])->name('registration.register');

Route::get('/login', [AuthController::class, 'showFormlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Tableau de bord (protégé par le middleware 'auth')
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Routes pour les produits (protégées par le middleware 'auth')
Route::resource('products', ProductController::class)->middleware('auth');

// Routes pour les ventes (protégées par le middleware 'auth')
Route::resource('sales', SaleController::class)->middleware('auth');

// Génération du PDF pour une vente
Route::get('/sales/{id}/pdf', [SaleController::class, 'generatePdf'])->name('sales.pdf')->middleware('auth');
