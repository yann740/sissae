@extends('layouts.app')

@section('title', 'Indicateurs')

@section('content')
<h2 class="mb-4" data-aos="fade-up">Gestion des indicateurs environnementaux</h2>

<!-- Bouton pour afficher le formulaire d'import -->
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
        <form action="{{ route('indicateurs.import') }}" method="POST" enctype="multipart/form-data">
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

<div id="formAjoutIndicateur" class="card mb-4 d-none" data-aos="fade-down">
    <div class="card-body">
        <h5 class="card-title">Ajouter un nouvel indicateur</h5>
        <form action="{{ route('indicateurs.store') }}" method="POST">
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

<!-- Filtres -->
<div class="row mb-3">
    <div class="col-md-4" data-aos="fade-right">
        <input type="text" class="form-control" placeholder="🔍 Rechercher un indicateur...">
    </div>
    <div class="col-md-3" data-aos="fade-right" data-aos-delay="100">
        <select class="form-select">
            <option selected>📂 Filtrer par catégorie</option>
            <option>Qualité de l’air</option>
            <option>Qualité de l’eau</option>
            <option>Biodiversité</option>
            <option>Déchets</option>
            <option>Climat</option>
        </select>
    </div>
    <div class="col-md-3" data-aos="fade-right" data-aos-delay="200">
        <select class="form-select">
            <option selected>📁 Filtrer par source</option>
            <option>Agence Eau</option>
            <option>Agence Forêt</option>
            <option>Ministère Climat</option>
        </select>
    </div>
  
</div>

@if(session('success'))
    <div class="alert alert-success" data-aos="fade-down">
        {{ session('success') }}
    </div>
@endif


<table class="table table-bordered table-striped">
    <thead class="table-success">
        <tr>
            <th>Code</th>
            <th>Nom</th>
            <th>Catégorie</th>
            <th>Unité</th>
            <th>Seuil critique</th>
            @if(auth()->user()->name === 'distat')
                <th>Actions</th>
            @else
                <th>Actions</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($indicateurs as $indicateur)
            <tr>
                <td>{{ $indicateur->code ?? '-' }}</td>
                <td>{{ $indicateur->nom }}</td>
                <td>{{ $indicateur->categorie ?? '-' }}</td>
                <td>{{ $indicateur->unite ?? '-' }}</td>
                <td>{{ $indicateur->seuil_critique ?? '-' }}</td>
                <td>
                    @if(auth()->user()->name === 'distat')
                        <a href="{{ route('indicateurs.edit', $indicateur->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form method="POST" action="{{ route('indicateurs.valider', $indicateur->id) }}" style="display:inline;">
                            @csrf
                            <button class="btn btn-sm btn-success">Valider</button>
                        </form>
                    @else
                        <button class="btn btn-sm btn-primary">Voir</button>
                        <button class="btn btn-sm btn-warning">Modifier</button>
                        <button class="btn btn-sm btn-danger">Supprimer</button>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination Laravel -->
<div class="d-flex justify-content-center">
    {{ $indicateurs->links() }}
</div>
@endsection
