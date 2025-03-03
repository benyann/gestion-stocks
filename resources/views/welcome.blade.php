<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue - Gestion de Stock</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lien vers Animate.css (optionnel) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Style personnalisé -->
    <style>
        .welcome-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem;
            text-align: center;
        }
        .welcome-container h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #2c3e50;
        }
        .welcome-container p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #7f8c8d;
        }
        .btn-custom {
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
            margin: 0.5rem;
        }
        footer {
            margin-top: 3rem;
            color: #6c757d;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Redirection si l'utilisateur est déjà connecté -->
    @if (Auth::check())
        <script>window.location = "{{ route('dashboard') }}";</script>
    @endif

    <div class="welcome-container">
        <!-- Affichage des messages de session -->
        @if (session('success'))
            <div class="alert alert-success animate__animated animate__fadeInDown" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger animate__animated animate__fadeInDown" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="display-4 animate__animated animate__fadeInDown">Bienvenue sur notre système de gestion de stock</h1>
        <p class="lead animate__animated animate__fadeInUp">Gérez vos stocks et vos ventes en toute simplicité.</p>
        <div class="d-flex justify-content-center">
            <a href="{{ route('login') }}" class="btn btn-primary btn-custom animate__animated animate__fadeInLeft">Connexion</a>
            <a href="{{ route('register') }}" class="btn btn-success btn-custom animate__animated animate__fadeInRight">Inscription</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-5">
        <p>&copy; 2023 Gestion de Stock. Tous droits réservés.</p>
    </footer>

    <!-- Lien vers Bootstrap JS (optionnel) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>