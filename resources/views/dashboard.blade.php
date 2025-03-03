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
                <a href="">Gestion des Ventes</a>
                <a href="">Rapports</a>
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
                            <h3>150</h3>
                            <p>Produits en Stock</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3>€5,230</h3>
                            <p>Chiffre d'Affaires</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <h3>42</h3>
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
                                <tr>
                                    <td>#1001</td>
                                    <td>2023-10-01</td>
                                    <td>€120</td>
                                    <td><span class="badge bg-success">Complété</span></td>
                                </tr>
                                <tr>
                                    <td>#1002</td>
                                    <td>2023-10-02</td>
                                    <td>€80</td>
                                    <td><span class="badge bg-warning">En Attente</span></td>
                                </tr>
                                <tr>
                                    <td>#1003</td>
                                    <td>2023-10-03</td>
                                    <td>€200</td>
                                    <td><span class="badge bg-success">Complété</span></td>
                                </tr>
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
                                    <th>Stock</th>
                                    <th>Seuil Minimum</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Produit A</td>
                                    <td>5</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td>Produit B</td>
                                    <td>8</td>
                                    <td>15</td>
                                </tr>
                                <tr>
                                    <td>Produit C</td>
                                    <td>3</td>
                                    <td>5</td>
                                </tr>
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