<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Vente</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lien vers Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Style personnalisé -->
    <style>
        .details-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .details-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-custom {
            border-radius: 25px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="details-container">
            <!-- Bouton Retour -->
            <div class="mb-4">
                <a href="{{ route('sales.index') }}" class="btn btn-secondary btn-custom">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>

            <h2>Détails de la Vente</h2>

            <!-- Affichage des détails de la vente -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informations de la vente</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>ID de la vente :</strong> 202500{{ $sale->id }}
                        </li>
                        <li class="list-group-item">
                            <strong>Date de vente :</strong> {{ $sale->sale_date }}
                        </li>
                        <li class="list-group-item">
                            <strong>Nom du client :</strong> {{ $sale->customer_name }}
                        </li>
                        <li class="list-group-item">
                            <strong>Produit :</strong>
                            @foreach($sale->products as $product)
                                <div>{{ $product->name }}</div>
                            @endforeach
                        </li>
                        <li class="list-group-item">
                            <strong>Quantité :</strong> {{ $sale->quantity }}
                        </li>
                        <li class="list-group-item">
                            <strong>Prix unitaire :</strong> @foreach($sale->products as $product)<div>{{ $product->price }} FCFA</div>
                            @endforeach
                        </li>
                        <li class="list-group-item">
                            <strong>Total :</strong> {{ number_format($sale->total_amount, 2) }} FCFA
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Lien vers Bootstrap JS (optionnel) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>