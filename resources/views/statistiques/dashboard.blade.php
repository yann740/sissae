@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<h2 data-aos="fade-up">Accueil des statistiques</h2>

<div class="row">
    <div class="col-md-8" data-aos="fade-right">
        <div class="card mb-3">
            <div class="card-header">Carte des indicateurs environnementaux</div>
            <div class="card-body p-0">
                <div id="map" style="height: 400px;"></div>
                <div class="p-3">
                    <strong>Légende :</strong>
                    <div class="d-flex align-items-center gap-3 mt-2" data-aos="fade-up">
                        <span class="badge bg-danger">Alerte critique</span>
                        <span class="badge bg-warning text-dark">Alerte modérée</span>
                        <span class="badge bg-success">Situation stable</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4" data-aos="fade-left">
        <!-- Statistiques récentes -->
        <div class="card mb-3">
            <div class="card-header">Statistiques récentes</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item" data-aos="zoom-in" data-aos-delay="100">
                    Qualité de l'air (Abidjan)
                    <div class="progress mt-2">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 75%;">75%</div>
                    </div>
                </li>
                <li class="list-group-item" data-aos="zoom-in" data-aos-delay="200">
                    Qualité de l'eau (Lagunes)
                    <div class="progress mt-2">
                        <div class="progress-bar bg-warning text-dark" role="progressbar" style="width: 62%;">62%</div>
                    </div>
                </li>
                <li class="list-group-item" data-aos="zoom-in" data-aos-delay="300">
                    Couverture forestière
                    <div class="progress mt-2">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 45%;">45%</div>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Alertes récentes -->
        <div class="card" data-aos="zoom-in" data-aos-delay="400">
            <div class="card-header">Alertes récentes</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item text-danger">Pollution de l’eau à Bouaké</li>
                <li class="list-group-item text-warning">Déforestation zone Man</li>
                <li class="list-group-item text-danger">Qualité de l'air Abidjan-Sud</li>
            </ul>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([7.54, -5.55], 6); // Centre de la Côte d'Ivoire

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Liste des alertes avec coordonnées et couleurs
    const alerts = [
        { coords: [5.35, -4.02], color: 'red', label: "Pollution critique à Abidjan" },
        { coords: [7.68, -5.03], color: 'orange', label: "Déforestation à Yamoussoukro" },
        { coords: [9.26, -5.82], color: 'yellow', label: "Qualité de l'air modérée à Korhogo" },
        { coords: [6.89, -6.45], color: 'green', label: "Situation stable à Daloa" }
    ];

    alerts.forEach(alert => {
        L.circleMarker(alert.coords, {
            radius: 8,
            color: alert.color,
            fillColor: alert.color,
            fillOpacity: 0.8
        }).addTo(map).bindPopup(alert.label);
    });
</script>
@endpush
