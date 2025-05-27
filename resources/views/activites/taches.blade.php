@extends('layouts.layout')

@section('title', 'Tâches')

@section('content')
<div class="container-fluid p-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Suivi des tâches</h4>
    <a href="#" class="btn btn-success">Nouvelle Tâche</a>
  </div>

  <!-- FILTRES -->
  <form class="row g-3 mb-4">
    <div class="col-md-4">
      <label for="statutFilter" class="form-label">Statut</label>
      <select class="form-select" id="statutFilter">
        <option selected>Tous</option>
        <option>En cours</option>
        <option>Terminée</option>
        <option>En attente</option>
      </select>
    </div>
    <div class="col-md-4">
      <label for="structureFilter" class="form-label">Structure</label>
      <select class="form-select" id="structureFilter">
        <option selected>Toutes les structures</option>
        <option>Direction Générale</option>
        <option>Service Hydraulique</option>
      </select>
    </div>
    <div class="col-md-4 d-flex align-items-end">
      <button type="submit" class="btn btn-primary me-2">Filtrer</button>
      <button type="reset" class="btn btn-secondary">Réinitialiser</button>
    </div>
  </form>

  <div class="row">
    <div class="col-lg-12">
      <!-- TABLEAU DES TÂCHES -->
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
          <thead class="table-success">
            <tr>
              <th>Titre</th>
              <th>Responsable</th>
              <th>Date début</th>
              <th>Date fin</th>
              <th>Structure</th>
              <th>Statut</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Installation des compteurs</td>
              <td>Ouattara Mariam</td>
              <td>2024-05-10</td>
              <td>2024-06-15</td>
              <td>Service Hydraulique</td>
              <td><span class="badge bg-warning text-dark">En cours</span></td>
              <td class="text-center">
                <a href="#" class="btn btn-success btn-sm">Voir</a>
                <a href="#" class="btn btn-warning btn-sm">Modifier</a>
                <a href="#" class="btn btn-danger btn-sm">Supprimer</a>
              </td>
            </tr>
            <tr>
              <td>Audit interne Q2</td>
              <td>Koné Ismael</td>
              <td>2024-06-01</td>
              <td>2024-06-30</td>
              <td>Direction Générale</td>
              <td><span class="badge bg-secondary">En attente</span></td>
              <td class="text-center">
                <a href="#" class="btn btn-success btn-sm">Voir</a>
                <a href="#" class="btn btn-warning btn-sm">Modifier</a>
                <a href="#" class="btn btn-danger btn-sm">Supprimer</a>
              </td>
            </tr>
            <!-- Autres tâches -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- PAGINATION -->
  <nav aria-label="Pagination">
    <ul class="pagination justify-content-center mt-4">
      <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
      <li class="page-item active"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">»</a></li>
    </ul>
  </nav>
</div>
@endsection