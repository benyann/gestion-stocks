<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Gestion de Stock</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Style personnalisé -->

    </head>
<body>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu de Vente #{{ $sale->id }}</title>
</head>
<body>
    <h1>Reçu de Vente #{{ $sale->id }}</h1>
    <p>Date de vente : {{ $sale->sale_date }}</p>
    <p>Vendeur : {{ $sale->user->name }}</p>
    <p>Client : {{ $sale->customer_name }}</p>
    <p>Montant total : {{ $sale->total_amount }} FCFA</p>

    <h2>Articles vendus</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sale->products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ $product->pivot->unit_price }} FCFA</td>
                    <td>{{ $product->pivot->quantity * $product->pivot->unit_price }} FCFA</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>


<!-- Lien vers Bootstrap JS (optionnel) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>