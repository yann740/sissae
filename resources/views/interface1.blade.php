<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Système SISSAE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
      html, body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
}


body {
    background: linear-gradient(to right, #e8f5e9, #ffffff);
}


        /* HEADER */
        .main-header {
            background: linear-gradient(90deg, #004d00, #117a00);
            color: white;
            padding: 2rem 1rem;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            animation: slideDown 0.6s ease-in-out;
        }

        .main-header h1 {
            font-size: 1.8rem;
            margin-bottom: 0.2rem;
            letter-spacing: 1px;
        }

        .main-header h5 {
            font-weight: 300;
            color: #ccc;
            font-size: 1.1rem;
        }

        @keyframes slideDown {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* CONTENT */
      
.main-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 100px 20px;
    animation: fadeIn 1.2s ease;
}

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .action-btn {
            width: 240px;
            height: 100px;
            font-size: 20px;
            font-weight: bold;
            margin: 20px;
            color: white;
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
        }

        .action-btn::after {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(255,255,255,0.1);
            opacity: 0;
            transition: opacity 0.4s;
        }

        .action-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 25px rgba(0,0,0,0.2);
        }

        .action-btn:hover::after {
            opacity: 1;
        }

        .btn-statistiques {
            background: linear-gradient(135deg, #1b5e20, #66bb6a);
        }

        .btn-suivi {
            background: linear-gradient(135deg, #f57c00, #ffb74d);
        }

        /* FOOTER */
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

        @media (min-width: 768px) {
            .main-header h1 {
                font-size: 2.2rem;
            }

            .main-content {
                flex-direction: row;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
<header class="main-header d-flex flex-column flex-md-row align-items-center justify-content-center text-center text-md-start px-4">
    <img src="{{ asset('images/armoirie.png') }}" alt="Logo SISSAE" class="me-md-4 mb-3 mb-md-0" style="height: 80px;">
    <div>
    @auth
    <form method="POST" action="{{ route('logout') }}" class="text-end p-3">
        @csrf
        <button type="submit" class="btn btn-outline-danger">
            <i class="fas fa-sign-out-alt me-1"></i> Se déconnecter
        </button> 
    </form>
@endauth
        <h1 class="mb-1">SYSTÈME INTÉGRÉ DE SUIVI DES STATISTIQUES ENVIRONNEMENTALES</h1>
        <h5 class="text-light">SISSAE</h5>
    </div>
</header>
    <div class="main-content">
        <a href="{{ route('statistiques') }}">
            <button class="action-btn btn-statistiques"><i class="fas fa-chart-bar me-2"></i>Statistiques</button>
        </a>
        <a href="{{ route('activites') }}">
            <button class="action-btn btn-suivi"><i class="fas fa-tasks me-2"></i>Suivi des Activités</button>
        </a>
    </div>

    <footer class="footer mt-auto">
        © 2025 - <span>Ministère de l’Environnement, du Développement Durable et de la Transition Écologique</span>
    </footer>
</body>
</html>
  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Add a dynamic clock in the footer
    const footer = document.querySelector('.footer');
    const clock = document.createElement('div');
    clock.style.color = '#fff';
    clock.style.marginTop = '10px';
    footer.appendChild(clock);

    function updateClock() {
        const now = new Date();
        clock.textContent = now.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>
