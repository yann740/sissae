<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SISSAE')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

    @stack('styles')
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            background-color: #f5f7fa;
        }

        main {
            flex: 1;
            padding-top: 120px;
        }

        .navbar {
            background-color: #005f3c !important;
            padding: 1.2rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1050;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.6rem;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .nav-link {
            color: #fff !important;
            margin-right: 0.8rem;
            transition: all 0.3s ease-in-out;
            display: flex;
            align-items: center;
        }

        .nav-link i {
            margin-right: 5px;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 6px;
        }

        .footer {
            background-color: #003300;
            color: #ccc;
            padding: 2rem 0;
            text-align: center;
            font-size: 0.95rem;
        }

        .footer span {
            color: #fff;
            font-weight: 500;  
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('interface1') }}">
            <img src="/images/armoirie.png" alt="Logo ENVISTAT">
            ENVISTAT
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
                aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

<div class="collapse navbar-collapse" id="navbarMain">
    <ul class="navbar-nav ms-auto">
        @auth
            @if (Auth::user()->role === 'admin')
                {{-- Menu complet pour les admins --}}
                <li class="nav-item"><a class="nav-link" href="{{ route('statistiques') }}"><i class="fas fa-chart-line"></i> Statistiques</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('indicateurs.index') }}"><i class="fas fa-chart-area"></i> Indicateurs</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('mesures') }}"><i class="fas fa-map-marker-alt"></i> Mesures</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('zones') }}"><i class="fas fa-globe-africa"></i> Zones Geo</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('rapports') }}"><i class="fas fa-file-alt"></i> Rapports</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('alertes') }}"><i class="fas fa-bell"></i> Alertes</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('administration') }}"><i class="fas fa-cogs"></i> Administration</a></li>
            @else
                {{-- Menu restreint pour les utilisateurs lambda --}}
                <li class="nav-item"><a class="nav-link" href="{{ route('indicateurs.index') }}"><i class="fas fa-chart-area"></i> Indicateurs</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('mesures') }}"><i class="fas fa-map-marker-alt"></i> Mesures</a></li>
            @endif
        @endauth
    </ul>
</div>
</div>
</nav>

<main class="container">
    @yield('content')
</main>

<footer class="footer mt-auto">
    <div class="container">
        © 2025 - <span>Ministère de l’Environnement, du Développement Durable et de la Transition Écologique</span><br>
        <small>Propulsé par ENVISTAT</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        mirror: false
    });
</script>
@stack('scripts')
</body>
</html>
 