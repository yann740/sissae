<!-- resources/views/layouts/layout.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Suivi des Activités')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      background-color: #f8f9fa;
    }
    .navbar-custom {
      background-color: #198754; /* Vert foncé */
    }
    .navbar-custom .nav-link {
      color: white;
    }
    .navbar-custom .nav-link:hover,
    .navbar-custom .nav-link.active {
      color: #ffc107;
      font-weight: bold;
    }
    .header-text {
      color: white;
      font-size: 1rem;
      font-style: italic;
    }
    .badge-status {
      font-size: 0.8rem;
    }
    .table th, .table td {
      vertical-align: middle;
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

  </style>
</head>
<body>

  <!-- MENU VERT -->
  <nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
    <div class="container-fluid">

    
    <a class="navbar-brand" href="{{ route('interface1') }}">
            <img src="/images/armoirie.png" alt="Logo ENVISTAT">
            Indicateur
        </a>
      <div class="d-flex d-lg-none">
        <span class="header-text me-3">Suivi des activités projets et programmes</span>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="/dashboard">Tableau de bord</a></li>
          <li class="nav-item"><a class="nav-link" href="/activites">Activités</a></li>
          <li class="nav-item"><a class="nav-link" href="/structures">Structures</a></li>
          <li class="nav-item"><a class="nav-link" href="/taches">Tâches</a></li>
          <li class="nav-item"><a class="nav-link" href="/rapports2">Rapports</a></li>
          <li class="nav-item"><a class="nav-link" href="/administration">Administration</a></li>
        </ul>
        <span class="d-none d-lg-inline header-text">Suivi des activités projets et programmes</span>
      </div>
    </div>
  </nav>

  <!-- CONTENU QUI CHANGE -->
  <div class="container-fluid p-4">
    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
