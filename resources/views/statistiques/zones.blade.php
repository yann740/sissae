@extends('layouts.app')

@section('title', 'Zones géographiques')

@section('content')
<h2 data-aos="fade-up">Gestion des zones géographiques</h2>

<div class="row">
    <div class="col-md-8" data-aos="fade-up">
        <!-- Carte des zones -->
        <div class="card mb-3" data-aos="fade-right">
            <div class="card-header bg-info text-white">
                🗺️ Carte des zones géographiques
            </div>
            <div class="card-body p-0" style="height: 450px;">
                <div id="zone-map" style="width: 100%; height: 100%;"></div>
            </div>
            <div class="card-footer bg-light">
                <strong>Légende :</strong>
                <span class="badge bg-danger">🔴 Région critique</span>
                <span class="badge bg-warning text-dark">🟠 Région à surveiller</span>
                <span class="badge bg-success">🟢 Région normale</span>
            </div>
        </div>

        <!-- Liste des zones -->
        <div class="card" data-aos="fade-up">
            <div class="card-header bg-secondary text-white">📋 Liste des zones</div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom de la zone</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Région</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Zone urbaine sud</td>
                            <td>Zone densément peuplée</td>
                            <td>Urbain</td>
                            <td>Abidjan</td>
                        </tr>
                        <!-- autres zones -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Colonnes de droite -->
    <div class="col-md-4" data-aos="fade-left">
        <!-- Détails de la zone -->
        <div class="card mb-3" data-aos="fade-left">
            <div class="card-header bg-primary text-white">📌 Détails de la zone</div>
            <div class="card-body">
                <p><strong>Nom :</strong> Zone urbaine sud</p>
                <p><strong>Type :</strong> Urbain</p>
                <p><strong>Région :</strong> Abidjan</p>
                <p><strong>Description :</strong> Zone densément peuplée avec forte activité économique.</p>
            </div>
        </div>

        <!-- Indicateurs de la zone -->
        <div class="card" data-aos="fade-up">
            <div class="card-header bg-success text-white">📈 Indicateurs associés</div>
            <div class="card-body">
                <p><strong>Qualité de l’air :</strong> 75</p>
                <p><strong>Pollution de l’eau :</strong> Modérée</p>
                <p><strong>Déforestation :</strong> Faible</p>
                <div class="mt-3">
                    <button class="btn btn-sm btn-primary">Modifier</button>
                    <button class="btn btn-sm btn-secondary">Détail</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('zone-map').setView([7.54, -5.5471], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Exemple de zones avec légendes colorées
        L.circle([5.35, -4.02], {
            color: 'red',
            fillColor: 'red',
            fillOpacity: 0.5,
            radius: 10000
        }).addTo(map).bindPopup("Abidjan - Région critique");

        L.circle([7.68, -5.03], {
            color: 'orange',
            fillColor: 'orange',
            fillOpacity: 0.5,
            radius: 10000
        }).addTo(map).bindPopup("Bouaké - Région à surveiller");

        L.circle([9.26, -5.82], {
            color: 'green',
            fillColor: 'green',
            fillOpacity: 0.5,
            radius: 10000
        }).addTo(map).bindPopup("Korhogo - Région normale");
    });
</script>
@endpush
