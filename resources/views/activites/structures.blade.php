@extends('layouts.layout')

@section('title', 'Structures')

@section('content')
<div class="container-fluid p-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Gestion des structures</h4>
    <a href="#" class="btn btn-success">Nouvelle Structure</a>
  </div>

  <!-- FILTRES -->
  <form class="row g-3 mb-3">
    <div class="col-md-4">
      <label for="typeFilter" class="form-label">Type de structure</label>
      <select class="form-select" id="typeFilter">
        <option selected>Tous les types</option>
        <option>Direction</option>
        <option>Département</option>
        <option>Service</option>
      </select>
    </div>
    <div class="col-md-4">
      <label for="regionFilter" class="form-label">Région</label>
      <select class="form-select" id="regionFilter">
        <option selected>Toutes les régions</option>
        <option>Abidjan</option>
        <option>Yamoussoukro</option>
        <option>Korhogo</option>
      </select>
    </div>
    <div class="col-md-4 d-flex align-items-end">
      <button type="submit" class="btn btn-primary me-2">Filtrer</button>
      <button type="reset" class="btn btn-secondary">Réinitialiser</button>
    </div>
  </form>

  <div class="row">
    <div class="col-lg-8">
      <!-- TABLE DES STRUCTURES -->
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
          <thead class="table-success">
            <tr>
              <th>Nom</th>
              <th>Type</th>
              <th>Région</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Direction Générale</td>
              <td>Direction</td>
              <td>Abidjan</td>
              <td class="text-center">
                <a href="#" class="btn btn-success btn-sm">Voir</a>
                <a href="#" class="btn btn-warning btn-sm">Modifier</a>
                <a href="#" class="btn btn-danger btn-sm">Supprimer</a>
              </td>
            </tr>
            <tr>
              <td>Service Hydraulique</td>
              <td>Service</td>
              <td>Korhogo</td>
              <td class="text-center">
                <a href="#" class="btn btn-success btn-sm">Voir</a>
                <a href="#" class="btn btn-warning btn-sm">Modifier</a>
                <a href="#" class="btn btn-danger btn-sm">Supprimer</a>
              </td>
            </tr>
            <!-- Ajoute d'autres structures ici -->
          </tbody>
        </table>
      </div>
    </div>

    <!-- ZONE D'INFOS -->
    <div class="col-lg-4 mt-4 mt-lg-0">
      <div class="card border-success">
        <div class="card-header bg-success text-white">
          Détails de la structure sélectionnée
        </div>
        <div class="card-body">
          <h5 class="card-title">Service Hydraulique</h5>
          <p><strong>Type :</strong> Service</p>
          <p><strong>Région :</strong> Korhogo</p>
          <p><strong>Description :</strong> Ce service est chargé de la gestion des ressources en eau de la région nord.</p>
          <div class="d-flex justify-content-between">
            <a href="#" class="btn btn-warning btn-sm">Modifier</a>
            <a href="#" class="btn btn-primary btn-sm">Voir les indicateurs</a>
          </div>
        </div>
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