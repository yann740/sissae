@extends('layouts.app')

@section('title', 'Alertes')

@section('content')
<h3 class="mb-4" data-aos="fade-up">🚨 Alertes environnementales</h3>

<!-- Filtres -->
<div class="row mb-3" data-aos="fade-up">
    <div class="col-md-3">
        <input type="text" class="form-control" placeholder="🔍 Rechercher une alerte...">
    </div>
    <div class="col-md-2">
        <select class="form-select" data-aos="zoom-in" data-aos-delay="100">
            <option value="">🎯 Niveau</option>
            <option value="critique">Critique</option>
            <option value="modéré">Modéré</option>
            <option value="faible">Faible</option>
        </select>
    </div>
    <div class="col-md-2">
        <select class="form-select" data-aos="zoom-in" data-aos-delay="200">
            <option value="">📌 Statut</option>
            <option value="en cours">En cours</option>
            <option value="résolue">Résolue</option>
        </select>
    </div>
    <div class="col-md-3 text-end offset-md-2" data-aos="fade-left">
        <button class="btn btn-primary">➕ Nouveau</button>
    </div>
</div>

<div class="row">
    <!-- Tableau des alertes -->
    <div class="col-md-8" data-aos="fade-right">
        <table class="table table-bordered table-hover">
            <thead class="table-danger">
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Niveau</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <tr onclick="showAlerteDetails('A001', 'Pollution eau Bouaké', 'Critique', 'Eau', '2025-04-12', 'En cours', 'Une pollution grave de l’eau a été détectée à Bouaké.')">
                    <td>A001</td>
                    <td>Pollution eau Bouaké</td>
                    <td><span class="badge bg-danger">Critique</span></td>
                    <td>Eau</td>
                    <td>2025-04-12</td>
                    <td><span class="badge bg-warning text-dark">En cours</span></td>
                </tr>
                <tr onclick="showAlerteDetails('A002', 'Déforestation zone Man', 'Modéré', 'Forêt', '2025-03-30', 'Résolue', 'Déforestation signalée et contrôlée dans la région de Man.')">
                    <td>A002</td>
                    <td>Déforestation zone Man</td>
                    <td><span class="badge bg-warning text-dark">Modéré</span></td>
                    <td>Forêt</td>
                    <td>2025-03-30</td>
                    <td><span class="badge bg-success">Résolue</span></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Détails de l'alerte -->
    <div class="col-md-4" id="alerteDetails" style="display: none;" data-aos="fade-left">
        <div class="card">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                📋 Détail de l’alerte
                <button class="btn btn-sm btn-danger" onclick="hideAlerteDetails()">✖</button>
            </div>
            <div class="card-body">
                <ul class="list-group mb-3">
                    <li class="list-group-item"><strong>ID :</strong> <span id="alerte-id"></span></li>
                    <li class="list-group-item"><strong>Titre :</strong> <span id="alerte-titre"></span></li>
                    <li class="list-group-item"><strong>Niveau :</strong> <span id="alerte-niveau" class="badge"></span></li>
                    <li class="list-group-item"><strong>Type :</strong> <span id="alerte-type"></span></li>
                    <li class="list-group-item"><strong>Date :</strong> <span id="alerte-date"></span></li>
                    <li class="list-group-item"><strong>Statut :</strong> <span id="alerte-statut" class="badge"></span></li>
                </ul>
                <h5>📝 Description</h5>
                <p id="alerte-description"></p>
            </div>
        </div>
    </div>
</div>



<!-- JS dynamique -->
<script>
    function showAlerteDetails(id, titre, niveau, type, date, statut, description) {
        document.getElementById('alerteDetails').style.display = 'block';

        document.getElementById('alerte-id').textContent = id;
        document.getElementById('alerte-titre').textContent = titre;
        document.getElementById('alerte-niveau').textContent = niveau;
        document.getElementById('alerte-niveau').className = 'badge ' + getNiveauClass(niveau);
        document.getElementById('alerte-type').textContent = type;
        document.getElementById('alerte-date').textContent = date;
        document.getElementById('alerte-statut').textContent = statut;
        document.getElementById('alerte-statut').className = 'badge ' + getStatutClass(statut);
        document.getElementById('alerte-description').textContent = description;
    }

    function hideAlerteDetails() {
        document.getElementById('alerteDetails').style.display = 'none';
    }

    function getNiveauClass(niveau) {
        switch (niveau.toLowerCase()) {
            case 'critique': return 'bg-danger';
            case 'modéré': return 'bg-warning text-dark';
            case 'faible': return 'bg-info text-dark';
            default: return 'bg-secondary';
        }
    }

    function getStatutClass(statut) {
        switch (statut.toLowerCase()) {
            case 'en cours': return 'bg-warning text-dark';
            case 'résolue': return 'bg-success';
            default: return 'bg-secondary';
        }
    }
</script>
@endsection
