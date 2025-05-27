@extends('layouts.app')

@section('title', 'Mesures')

@section('content')
<h2 data-aos="fade-up">Gestion des mesures environnementales</h2>

<div class="mb-3 d-flex justify-content-between" data-aos="fade-up">
    <div>
        <input type="text" class="form-control d-inline w-auto" placeholder="🔍 Rechercher une mesure">
    </div>
    <div>
        <select class="form-select d-inline w-auto" data-aos="zoom-in" data-aos-delay="100">
            <option>🧪 Indicateur</option>
            <option>Qualité de l’air</option>
            <option>CO2</option>
        </select>
        <select class="form-select d-inline w-auto mx-2" data-aos="zoom-in" data-aos-delay="200">
            <option>📍 Zone</option>
            <option>Abidjan</option>
            <option>Bouaké</option>
        </select>
        <input type="date" class="form-control d-inline w-auto" data-aos="zoom-in" data-aos-delay="300">
    </div>
    <div>
        <button class="btn btn-success" data-aos="fade-up" data-aos-delay="400"><strong>＋</strong> Nouvelle mesure</button>
    </div>
</div>

<div class="row">
    <div class="col-md-8" data-aos="fade-right">

        <!-- Boutons Import / Ajout Indicateur -->
        <div class="mb-3 text-start" data-aos="fade-right">
            <button class="btn btn-outline-primary" onclick="document.getElementById('formImportExcel').classList.toggle('d-none')">
                📥 Importer un fichier Excel
            </button>

            <button class="btn btn-outline-success ms-2" onclick="document.getElementById('formAjoutIndicateur').classList.toggle('d-none')">
                ➕ Ajouter un indicateur
            </button>
        </div>

        

        <!-- Formulaire masqué d'import Excel -->
        <div id="formImportExcel" class="card mb-4 d-none" data-aos="fade-down">
            <div class="card-body">
                <h5 class="card-title">Importer des données depuis un fichier Excel</h5>
                <form action="{{ route('mesures.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-2 align-items-end">
                        <div class="col-md-5">
                            <label for="fichier_excel" class="form-label">Fichier Excel <span class="text-danger">*</span></label>
                            <input type="file" name="fichier_excel" id="fichier_excel" class="form-control" required>
                        </div>
                        <div class="col-md-5">
                            <label for="description" class="form-label">Description (facultatif)</label>
                            <input type="text" name="description" id="description" class="form-control" placeholder="Ex. Données Q2 2025">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">📤 Importer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Formulaire masqué d'ajout indicateur -->
        <div id="formAjoutIndicateur" class="card mb-4 d-none" data-aos="fade-down">
            <div class="card-body">
                <h5 class="card-title">Ajouter un nouvel indicateur</h5>
                <form action="{{ route('mesures.indicateurs.store') }}" method="POST">
                    @csrf
                    <div class="row g-2">
                        <div class="col-md-3">
                            <label class="form-label">Code</label>
                            <input type="text" name="code" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Catégorie</label>
                            <input type="text" name="categorie" class="form-control" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Unité</label>
                            <input type="text" name="unite" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Seuil critique</label>
                            <input type="number" name="seuil_critique" class="form-control">
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-success mt-2">💾 Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tableau des mesures -->
    <table class="table table-bordered table-success">
    <thead class="table-success">
        <tr>
            <th>ID</th>
            <th>Indicateur</th>
            <th>Zone</th>
            <th>Valeur</th>
            <th>Date relevé</th>
            <th>Statut</th>
            @if(auth()->user()->name === 'distat')
                <th>Actions</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($mesures as $mesure)
        <tr>
            <td>{{ $mesure->id }}</td>
            <td>{{ $mesure->indicateur }}</td>
            <td>{{ $mesure->zone }}</td>
            <td>{{ $mesure->valeur }}</td>
            <td>{{ \Carbon\Carbon::parse($mesure->date_releve)->format('d/m/Y') }}</td>
            <td>{{ $mesure->statut }}</td>
            @if(auth()->user()->name === 'distat')
            <td>
                <a href="{{ route('mesures.edit', $mesure->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                <form action="{{ route('mesures.valider', $mesure->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">Valider</button>
                </form>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>

        <!-- Pagination (si nécessaire) -->
        <nav>
            <ul class="pagination justify-content-center" data-aos="fade-up">
                {{-- Pagination Laravel par exemple --}}
                {{ $mesures->links() }}
            </ul>
        </nav>
    </div>

    <!-- Colonne droite : Carte + détails, inchangée -->
    <div class="col-md-4" data-aos="fade-left">
        <!-- ... carte + détails ... -->
    </div>
</div>

    <div class="col-md-4" data-aos="fade-left">
        <!-- Carte des mesures -->
        <div class="card mb-3">
            <div class="card-header bg-success text-white">
                📌 Carte des mesures
            </div>
            <div class="card-body p-0">
                <div id="map-measure" style="height: 300px;"></div> <!-- ID corrigé -->
            </div>
            <div class="card-footer bg-light">
                <small><strong>Légende :</strong></small><br>
                <span class="badge bg-success">🟢 Normal</span>
                <span class="badge bg-warning text-dark">🟠 Alerte</span>
                <span class="badge bg-danger">🔴 Critique</span>
            </div>
        </div>

        <!-- Détails mesure -->
        <div class="card" data-aos="zoom-in" data-aos-delay="500">
            <div class="card-header bg-secondary text-white">
                📝 Détails de la mesure
            </div>
            <div class="card-body">
                <p><strong>Date :</strong> 2025-04-15</p>
                <p><strong>Indicateur :</strong> Indice de qualité de l’air</p>
                <p><strong>Valeur :</strong> 75</p>
                <p><strong>Zone :</strong> Abidjan</p>
                <p><strong>Commentaires :</strong> Valeur normale</p>
                <div class="mt-3">
                    <button class="btn btn-sm btn-primary">Modifier</button>
                    <button class="btn btn-sm btn-danger">Supprimer</button>
                    <button class="btn btn-sm btn-warning">Alerter</button>
                </div>
            </div>
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
    document.addEventListener("DOMContentLoaded", function () {
        const mapMeasure = L.map('map-measure').setView([7.54, -5.55], 6); // ID unique ici

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(mapMeasure);

        // Forcer le redimensionnement si nécessaire
        setTimeout(() => {
            mapMeasure.invalidateSize();
        }, 300);

        // Marqueurs pour la mesure
        L.circle([5.3476, -4.0078], {
            color: 'green',
            fillColor: 'green',
            fillOpacity: 0.5,
            radius: 5000
        }).addTo(mapMeasure).bindPopup("Abidjan : Qualité de l'air - 75");

        L.circle([7.6833, -5.0167], {
            color: 'orange',
            fillColor: 'orange',
            fillOpacity: 0.5,
            radius: 5000
        }).addTo(mapMeasure).bindPopup("Bouaké : Émissions CO2 - 9800 kt");

        L.circle([7.4128, -7.5538], {
            color: 'red',
            fillColor: 'red',
            fillOpacity: 0.5,
            radius: 5000
        }).addTo(mapMeasure).bindPopup("Man : Pollution critique");
    });
</script>
@endpush
