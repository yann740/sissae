@extends('layouts.app')

@section('title', 'Rapports')

@section('content')
<div class="row">
    <div class="col-md-8" data-aos="fade-up">
        <h3 class="mb-3">📄 Gestion des Rapports environnementaux</h3>

        <!-- Filtres -->
        <form class="row g-3 mb-3 align-items-end" data-aos="fade-up">
            <div class="col-md-4">
                <label class="form-label">Type</label>
                <select class="form-select" data-aos="zoom-in" data-aos-delay="100">
                    <option value="">Tous</option>
                    <option>Trimestriel</option>
                    <option>Mensuel</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Période</label>
                <input type="month" class="form-control" data-aos="zoom-in" data-aos-delay="200"/>
            </div>
            <div class="col-md-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-success" data-aos="fade-up" data-aos-delay="300">Filtrer</button>
            </div>
        </form>

        <!-- Tableau -->
        <table class="table table-bordered table-hover" data-aos="fade-right">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Titre du rapport</th>
                    <th>Type</th>
                    <th>Date de création</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
            <tr onclick="showDetails(1, 'Mensuel', '2025-01-15', 'publié', 'Kouassi', `Ce rapport traite de la qualité de l’air mesurée dans différentes régions en janvier 2025.`, ['PM2.5', 'NO2', 'Ozone'])">
                    <td>1</td>
                    <td>État de la qualité de l'air</td>
                    <td>Mensuel</td>
                    <td>2025-01-15</td>
                    <td><span class="badge bg-success">publié</span></td>
            </tr>
            <tr onclick="showDetails(2, 'Trimestriel', '2025-03-10', 'En revue', 'Kouassi', `Rapport sur la couverture forestière en 2025`, ['Déforestation', 'Taux de reboisement'])">
                    <td>2</td>
                    <td>Bilan couverture forestière</td>
                    <td>Trimestriel</td>
                    <td>2025-03-10</td>
                    <td><span class="badge bg-warning text-dark">En revue</span></td>
            </tr>

            </tbody>
        </table>

        <!-- Boutons en bas -->
        <div class="d-flex justify-content-between mt-3" data-aos="fade-up">
            <button class="btn btn-primary">➕ Nouveau rapport</button>
            <button class="btn btn-outline-secondary">⬇️ Exporter</button>
        </div>
    </div>

    <!-- Détails du rapport -->
    <div class="col-md-4" id="rapportDetails" style="display: none;" data-aos="fade-left">
    <div class="card">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            📋 Détail du rapport
            <button class="btn btn-sm btn-danger" onclick="hideDetails()">✖</button>
        </div>
        <div class="card-body">
            <h5 class="card-title mb-3">🧾 Informations générales</h5>
            <ul class="list-group mb-3">
                <li class="list-group-item"><strong>ID :</strong> <span id="detail-id">1</span></li>
                <li class="list-group-item"><strong>Type :</strong> <span id="detail-type">PDF</span></li>
                <li class="list-group-item"><strong>Date de création :</strong> <span id="detail-date">2025-01-15</span></li>
                <li class="list-group-item"><strong>Statut :</strong> <span id="detail-statut" class="badge bg-success">publié</span></li>
                <li class="list-group-item"><strong>Ajouté par :</strong> <span id="detail-auteur">Kouassi</span></li>
            </ul>

            <h5 class="card-title">📄 Résumé</h5>
            <p id="detail-resume">Ce rapport traite de la qualité de l’air mesurée dans différentes régions en janvier 2025.</p>

            <h5 class="card-title">📊 Indicateurs</h5>
            <ul id="detail-indicateurs">
                <li>PM2.5</li>
                <li>NO2</li>
                <li>Ozone</li>
            </ul>

            <div class="d-flex justify-content-between mt-3">
                <button class="btn btn-outline-primary">✏️ Éditer</button>
                <button class="btn btn-outline-success">📄 PDF</button>
            </div>
        </div>
    </div>
</div>


<!-- JS pour afficher/masquer les détails -->
<script>
    function showDetails(id, type, date, statut, auteur, resume, indicateurs) {
        document.getElementById('rapportDetails').style.display = 'block';
        document.getElementById('detail-id').textContent = id;
        document.getElementById('detail-type').textContent = type;
        document.getElementById('detail-date').textContent = date;
        document.getElementById('detail-auteur').textContent = auteur;
        document.getElementById('detail-resume').textContent = resume;

        const statutSpan = document.getElementById('detail-statut');
        statutSpan.textContent = statut;
        statutSpan.className = 'badge';
        if (statut === 'publié') {
            statutSpan.classList.add('bg-success');
        } else if (statut === 'En revue') {
            statutSpan.classList.add('bg-warning', 'text-dark');
        } else {
            statutSpan.classList.add('bg-secondary');
        }

        const indicateurList = document.getElementById('detail-indicateurs');
        indicateurList.innerHTML = '';
        indicateurs.forEach(i => {
            const li = document.createElement('li');
            li.textContent = i;
            indicateurList.appendChild(li);
        });
    }

    function hideDetails() {
        document.getElementById('rapportDetails').style.display = 'none';
    }
</script>

@endsection
