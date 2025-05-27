@extends('layouts.layout')

@section('title', 'Rapports')

@section('content')
<div class="container-fluid p-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Liste des rapports</h4>
    <a href="#" class="btn btn-success">Nouveau Rapport</a>
  </div>

  <!-- FILTRES -->
  <form class="row g-3 mb-4">
    <div class="col-md-4">
      <label for="periode" class="form-label">Période</label>
      <input type="month" id="periode" class="form-control">
    </div>
    <div class="col-md-4">
      <label for="typeRapport" class="form-label">Type de rapport</label>
      <select class="form-select" id="typeRapport">
        <option selected>Tous</option>
        <option>Rapport Mensuel</option>
        <option>Rapport Trimestriel</option>
        <option>Rapport Annuel</option>
      </select>
    </div>
    <div class="col-md-4 d-flex align-items-end">
      <button type="submit" class="btn btn-primary me-2">Filtrer</button>
      <button type="reset" class="btn btn-secondary">Réinitialiser</button>
    </div>
  </form>

  <!-- TABLEAU -->
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover align-middle">
      <thead class="table-success">
        <tr>
          <th>Titre</th>
          <th>Période</th>
          <th>Type</th>
          <th>Structure</th>
          <th>Statut</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Suivi trimestriel Q1</td>
          <td>Jan-Mars 2025</td>
          <td>Rapport Trimestriel</td>
          <td>Service Planification</td>
          <td><span class="badge bg-success">Validé</span></td>
          <td class="text-center">
            <a href="#" class="btn btn-success btn-sm">Voir</a>
            <a href="#" class="btn btn-info btn-sm">Télécharger</a>
            <a href="#" class="btn btn-danger btn-sm">Supprimer</a>
          </td>
        </tr>
        <tr>
          <td>Rapport annuel 2024</td>
          <td>Jan-Déc 2024</td>
          <td>Rapport Annuel</td>
          <td>Direction Générale</td>
          <td><span class="badge bg-warning text-dark">En attente</span></td>
          <td class="text-center">
            <a href="#" class="btn btn-success btn-sm">Voir</a>
            <a href="#" class="btn btn-info btn-sm">Télécharger</a>
            <a href="#" class="btn btn-danger btn-sm">Supprimer</a>
          </td>
        </tr>
        <!-- Autres rapports -->
      </tbody>
    </table>
  </div>

  <!-- PAGINATION -->
  <nav aria-label="Pagination">
    <ul class="pagination justify-content-center mt-4">
      <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
      <li class="page-item active"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">»</a></li>
    </ul>
  </nav>
</div>
@endsection