@extends('layouts.app')

@section('title', 'Ajouter un utilisateur')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">➕ Ajouter un nouvel utilisateur</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nom complet</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select name="role" id="role" class="form-select" required>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Utilisateur</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
            </select>
        </div>
        
        <div class="mb-3">
             <label for="status" class="form-label">Statut</label>
             <select name="status" class="form-select" required>
                <option value="actif" {{ old('status', $user->status ?? '') == 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="inactif" {{ old('status', $user->status ?? '') == 'inactif' ? 'selected' : '' }}>Inactif</option>
             </select>
       </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.users') }}" class="btn btn-secondary">Retour</a>
            <button type="submit" class="btn btn-primary">Créer l'utilisateur</button>
        </div>
    </form>
</div>
@endsection
