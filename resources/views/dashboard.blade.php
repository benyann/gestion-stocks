<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Gestion de Stock</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Style personnalisé -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            height: 100vh;
            background: #2c3e50;
            color: #fff;
            padding: 20px;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .sidebar a:hover {
            background: #34495e;
        }
        .main-content {
            padding: 20px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-header {
            background: #6a11cb;
            color: #fff;
            border-radius: 10px 10px 0 0;
        }
        .card-body {
            background: #fff;
            border-radius: 0 0 10px 10px;
        }
        .stat-card {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .stat-card h3 {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        .stat-card p {
            font-size: 1.2rem;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
                <h2 class="text-center mb-4">Menu</h2>
                <a href="{{ route('dashboard') }}">Tableau de Bord</a>
                <a href="{{ route('products.index') }}">Gestion des Produits</a>
                <a href="{{ route('sales.index')}}" >Gestion des Ventes</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 main-content">
                <h1 class="mb-4">Tableau de Bord</h1>

                <!-- Statistiques -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3>{{ $ProduitsStock }}</h3>
                            <p>Produits en Stock</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3>{{ number_format($totalRevenue) }} FCFA</h3>
                            <p>Chiffre d'Affaires</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3>{{ $VentesMois }}</h3>
                            <p>Ventes ce Mois</p>
                        </div>
                    </div>
                </div>

                <!-- Dernières Ventes -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Dernières Ventes</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Montant</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSales as $sale)
                                    <tr>
                                        <td>202500{{ $sale->id }}</td>
                                        <td>{{ $sale->sale_date }}</td>
                                        <td>{{ number_format($sale->total_amount) }} FCFA</td>
                                        <td><span class="btn btn-success btn-sm">Validé</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Produits Faible Stock -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Produits en Faible Stock</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Prix</th>
                                    <th>Stock</th>
                                    <th>Seuil Minimum</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($StockFaible as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ number_format($product->price) }} FCFA</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->quantity-5 }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lien vers Bootstrap JS (optionnel) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>