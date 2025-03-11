<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Ventes</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lien vers Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Style personnalisé -->
    <style>
        .btn-back {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-back:hover {
            background-color: #5a6268;
            transform: scale(1.05);
        }
        .btn-back:active {
            transform: scale(0.95);
        }
        .table {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table th, .table td {
            padding: 12px;
            text-align: center;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .btn-success {
            border-radius: 25px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .btn-success:hover {
            transform: scale(1.05);
        }
        .btn-success:active {
            transform: scale(0.95);
        }
        .btn-sm {
            border-radius: 20px;
            padding: 5px 10px;
            transition: all 0.3s ease;
        }
        .btn-sm:hover {
            transform: scale(1.05);
        }
        .btn-sm:active {
            transform: scale(0.95);
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #007bff;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Bouton de retour -->
        <div class="mb-4">
            <a href="{{ route('dashboard') }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Retour au tableau de bord
            </a>
        </div>

        <!-- Titre -->
        <h1 class="text-center mb-4">Liste des Ventes</h1>

        <!-- Message lorsque la liste est vide -->
        @if($sales->isEmpty())
            <div class="alert alert-info text-center">
                Aucune vente n'a été enregistrée.
            </div>
        @else
            <!-- Tableau des ventes -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date de vente</th>
                        <th>Nom du client</th>
                        <th>Produits</th> <!-- Nouvelle colonne pour les produits -->
                        <th>Quantités</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Boucle pour afficher les ventes -->
                    @foreach ($sales as $sale)
                    <tr>
                        <td>202500{{ $sale->id }}</td>
                        <td>{{ $sale->sale_date }}</td>
                        <td>{{ $sale->customer_name }}</td>
                        <td>
                            <!-- Affichage des produits et de leur quantité -->
                            @foreach($sale->products as $product)
                                <div>{{ $product->name }}</div>
                            @endforeach
                        </td>
                        <td>
                            @foreach($sale->products as $product)
                                <div>{{ $product->pivot->quantity }}</div>
                            @endforeach
                        </td>
                        <td>{{ number_format($sale->total_amount, 2) }} FCFA</td>
                        <td>
                            <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-primary btn-sm">Voir</a>
                            
                            <!-- Formulaire de suppression -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-sale-id="{{ $sale->id }}">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <!-- Bouton "Ajouter une vente" -->
        <div class="text-center mt-4">
            <a href="{{ route('sales.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Ajouter une vente
            </a>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cette vente ?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script pour la gestion de la suppression -->
    <script>
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; 
            var saleId = button.getAttribute('data-sale-id');
            var formAction = '/sales/' + saleId;

            var form = document.getElementById('deleteForm');
            form.action = formAction;
        });
    </script>
</body>
</html>
