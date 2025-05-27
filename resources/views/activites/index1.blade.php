@extends('layouts.layout')

@section('title', 'Activités')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Interface de gestion des activités</h4>
  <a href="#" class="btn btn-success">Nouvelle Activité</a>
</div>

<!-- FILTRES -->
<form class="row g-3 mb-3">
  <div class="col-md-3">
    <label for="statusFilter" class="form-label">Statut</label>
    <select class="form-select" id="statusFilter">
      <option selected>Tous les statuts</option>
      <option>À venir</option>
      <option>En cours</option>
      <option>Terminé</option>
      <option>En retard</option>
    </select>
  </div>
  <div class="col-md-3">
    <label for="priorityFilter" class="form-label">Priorité</label>
    <select class="form-select" id="priorityFilter">
      <option selected>Toutes les priorités</option>
      <option>Haute</option>
      <option>Moyenne</option>
      <option>Basse</option>
    </select>
  </div>
  <div class="col-md-3">
    <label for="responsibleFilter" class="form-label">Responsable</label>
    <select class="form-select" id="responsibleFilter">
      <option selected>Tous les responsables</option>
      <option>Marie Kouamé</option>
      <option>Jean Dupont</option>
      <option>Samir Rachid</option>
    </select>
  </div>
  <div class="col-md-3 d-flex align-items-end">
    <button type="submit" class="btn btn-primary me-2">Filtrer</button>
    <button type="reset" class="btn btn-secondary">Réinitialiser</button>
  </div>
</form>

<!-- TABLE DES ACTIVITÉS -->
<div class="table-responsive">
  <table class="table table-bordered table-striped table-hover">
    <thead class="table-success">
      <tr>
        <th>Projet/Programme</th>
        <th>Structure</th>
        <th>Date début</th>
        <th>Date fin prévue</th>
        <th>Priorité</th>
        <th>Statut</th>
        <th class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><span class="badge bg-info text-dark">ACT001</span> Reboisement</td>
        <td>DFPE</td>
        <td>15/04/2025</td>
        <td>20/04/2025</td>
        <td>Haute</td>
        <td><span class="badge bg-warning text-dark badge-status">À venir</span></td>
        <td class="text-center">
          <a href="#" class="btn btn-success btn-sm">Voir</a>
          <a href="#" class="btn btn-warning btn-sm">Modifier</a>
          <a href="#" class="btn btn-danger btn-sm">Supprimer</a>
        </td>
      </tr>
      <tr>
        <td><span class="badge bg-info text-dark">ACT002</span> Surveillance de l'eau</td>
        <td>COECI</td>
        <td>10/05/2025</td>
        <td>15/05/2025</td>
        <td>Moyenne</td>
        <td><span class="badge bg-success badge-status">Terminé</span></td>
        <td class="text-center">
          <a href="#" class="btn btn-success btn-sm">Voir</a>
          <a href="#" class="btn btn-warning btn-sm">Modifier</a>
          <a href="#" class="btn btn-danger btn-sm">Supprimer</a>
        </td>
      </tr>
    </tbody>
  </table>
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
@endsection
