<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion | ENVISTAT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #A8E6CF;
            color: #333;
            font-family: sans-serif;
            margin: 0;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 420px;
        }

        .login-box {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .logo img {
            display: block;
            margin: 0 auto 1rem auto;
            height: 80px;
        }

        .app-title {
            text-align: center;
            color: #006400;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            text-align: center;
            font-size: 0.9rem;
            color: #555;
            font-style: italic;
            margin-bottom: 1.5rem;
        }

        .form-title {
            text-align: center;
            color: #006400;
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }

        .alert {
            background-color: #d1fae5;
            color: #065f46;
            padding: 0.5rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.3rem;
            color: #006400;
        }

        .form-group input {
            width: 100%;
            padding: 0.55rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            background: #f9f9f9;
        }

        .error {
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: #006400;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .form-actions a {
            font-size: 0.85rem;
            color: #006400;
            text-decoration: underline;
        }

        .form-actions button {
            background: #006400;
            color: white;
            padding: 0.5rem 1.2rem;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .form-actions button:hover {
            background: #004d00;
        }

        @media (max-width: 480px) {
            .login-box {
                padding: 1.2rem;
            }

            .form-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .form-actions a {
                text-align: center;
                margin-top: 0.5rem;
            }

            .form-actions button {
                width: 100%;
            }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const emailField = document.getElementById("email");
            if (emailField) emailField.focus();
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="logo">
                <img src="{{ asset('images/armoirie.png') }}" alt="Logo Ministère">
            </div>

            <h1 class="app-title">ENVISTAT</h1>
            <p class="subtitle">Suivi des indicateurs environnementaux</p>
            <h2 class="form-title">Connexion</h2>

            @if (session('status'))
                <div class="alert">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input id="password" name="password" type="password" required>
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group remember">
                    <input id="remember" name="remember" type="checkbox">
                    <label for="remember">Se souvenir de moi</label>
                </div>

                <div class="form-actions">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                    @endif
                    <button type="submit">Connexion</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
