@extends('layouts.app')

@section('title', 'Sources de données')

@section('content')
<div class="container-fluid" data-aos="fade-in">

    <div class="d-flex gap-3 my-3" data-aos="fade-down">
        <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">👤 Utilisateurs</a>
        <a href="{{ route('admin.categories') }}" class="btn btn-outline-secondary">🗂️ Catégories</a>
        <a href="{{ route('admin.config') }}" class="btn btn-outline-secondary">⚙️ Configuration système</a>
        <a href="{{ route('admin.logs') }}" class="btn btn-outline-secondary">📜 Journaux</a>
    </div>

    <h3 class="mb-4" data-aos="zoom-in">📚 Sources de données</h3>

    <!-- Filtres -->
    <div class="row mt-3 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="col-md-3">
            <input type="text" class="form-control" placeholder="🔍 Rechercher une source...">
        </div>
        <div class="col-md-2">
            <select class="form-select">
                <option value="">Type</option>
                <option value="API">API</option>
                <option value="Fichier">Fichier</option>
                <option value="Manuel">Manuel</option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-select">
                <option value="">Statut</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="en_attente">En attente</option>
            </select>
        </div>
        <div class="col-md-2 offset-md-3 text-end">
            <button class="btn btn-primary">➕ Nouvelle source</button>
        </div>
    </div>

    <div class="row">
        <!-- Liste des sources -->
        <div class="col-md-8" data-aos="fade-right" data-aos-delay="200">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nom de la source</th>
                        <th>Type</th>
                        <th>Fréquence</th>
                        <th>Dernière mise à jour</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <tr onclick="showDetails('S001')" style="cursor:pointer;">
                        <td>S001</td>
                        <td>Système Hydrométrique Régional</td>
                        <td>API</td>
                        <td>Hebdomadaire</td>
                        <td>2025-04-10</td>
                        <td><span class="badge bg-success">Active</span></td>
                    </tr>
                    <!-- Autres lignes -->
                </tbody>
            </table>
        </div>

        <!-- Détails de la source -->
        <div class="col-md-4" id="sourceDetails" style="display: none;" data-aos="fade-left" data-aos-delay="300">
            <div class="card">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    🧾 Détails de la source
                    <button class="btn btn-sm btn-danger" onclick="hideDetails()">✖</button>
                </div>
                <div class="card-body">
                    <ul class="list-group mb-3">
                        <li class="list-group-item"><strong>ID :</strong> <span id="detail-id">S001</span></li>
                        <li class="list-group-item"><strong>Nom :</strong> <span id="detail-nom">Système Hydrométrique Régional</span></li>
                        <li class="list-group-item"><strong>Type :</strong> <span id="detail-type">API</span></li>
                        <li class="list-group-item"><strong>Fréquence :</strong> <span id="detail-frequence">Hebdomadaire</span></li>
                        <li class="list-group-item"><strong>Statut :</strong> <span id="detail-statut" class="badge bg-success">Active</span></li>
                        <li class="list-group-item"><strong>Responsable :</strong> <span id="detail-responsable">Dr. Kouassi</span></li>
                        <li class="list-group-item"><strong>URL :</strong> <span id="detail-url">https://api.hydro.ci</span></li>
                    </ul>

                    <h5>Description</h5>
                    <p id="detail-description">Cette source fournit des données hydrométriques en temps réel pour la région sud.</p>

                    <div class="d-flex justify-content-between mt-3">
                        <button class="btn btn-outline-primary">✏️ Modifier</button>
                        <button class="btn btn-outline-success">🔌 Tester connexion</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    function showDetails(id) {
        // Logique pour afficher les détails de la source sélectionnée
        document.getElementById('sourceDetails').style.display = 'block';
    }

    function hideDetails() {
        document.getElementById('sourceDetails').style.display = 'none';
    }
</script>
@endsection
