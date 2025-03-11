<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Vente - Gestion de Stock</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Style personnalisé -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 30px;
            max-width: 800px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
        }
        .form-label {
            font-weight: bold;
            color: #495057;
        }
        .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 10px;
        }
        .form-control:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 5px rgba(106, 17, 203, 0.5);
        }
        .btn-primary {
            background-color: #6a11cb;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #2575fc;
        }
        .btn-back {
            background-color: #6c757d;
            border: none;
            color: #fff;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        .btn-back:hover {
            background-color: #5a6268;
            color: #fff;
        }
        .product-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Bouton de retour -->
        <a href="{{ route('sales.index') }}" class="btn btn-back">Retour à la Liste des Ventes</a>

        <h1>Ajouter une Vente</h1>

        <!-- Formulaire de création -->
        <form action="{{ route('sales.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="sale_date" class="form-label">Date de vente</label>
                <input type="date" class="form-control" id="sale_date" name="sale_date" required>
            </div>
            <div class="mb-3">
                <label for="customer_name" class="form-label">Nom du client</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
            </div>

            <!-- Section pour les produits -->
            <div id="products-container">
                <div class="product-group" id="product-0">
                    <label for="products[0][id]" class="form-label">Produit</label>
                    <select class="form-control" name="products[0][id]" required>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} - {{ $product->price }} FCFA</option>
                        @endforeach
                    </select>
                    <label for="products[0][quantity]" class="form-label">Quantité</label>
                    <input type="number" name="products[0][quantity]" class="form-control" min="1" required>
                </div>
            </div>

            <!-- Bouton pour ajouter un produit -->
            <button type="button" id="add-product-btn" class="btn btn-secondary">Ajouter un autre produit</button>

            <button type="submit" class="btn btn-primary mt-3">Enregistrer la Vente</button>
        </form>
    </div>

    <!-- Lien vers Bootstrap JS (optionnel) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    
</body>
</html>
