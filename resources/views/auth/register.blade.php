<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Gestion de Stock</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Style personnalisé -->
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }
        .register-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
        }
        .register-container h2 {
            color: #333;
            margin-bottom: 1.5rem;
            font-weight: bold;
        }
        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
        }
        .form-control:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 5px rgba(106, 17, 203, 0.5);
        }
        .btn-register {
            background: #6a11cb;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
            border-radius: 10px;
            width: 100%;
            color: #fff;
            transition: background 0.3s ease;
        }
        .btn-register:hover {
            background: #2575fc;
        }
        .login-link {
            text-align: center;
            margin-top: 1rem;
            color: #333;
        }
        .login-link a {
            color: #6a11cb;
            text-decoration: none;
            font-weight: bold;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        
        <h2 class="text-center">Inscription</h2>
        <form action="{{ route('registration.register') }}" method="POST">
            @csrf <!-- Token CSRF pour la sécurité -->
            <div class="mb-3">
                <input type="text" class="form-control" name="name" placeholder="Nom complet" required>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Adresse email" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
            </div>
            <button type="submit" class="btn btn-register">S'inscrire</button>
        </form>
        <div class="login-link">
            Déjà inscrit ? <a href="{{ route('login') }}">Connectez-vous ici</a>
        </div>
    </div>

    <!-- Lien vers Bootstrap JS (optionnel) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>