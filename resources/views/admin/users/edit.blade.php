@extends('layouts.app')

@section('title', 'Modifier l’utilisateur')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>✏️ Modifier l’utilisateur</h3>
        <a href="{{ route('admin.users') }}" class="btn btn-secondary">⬅️ Retour</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erreur(s) :</strong>
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">👤 Nom</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">📧 Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">🎭 Rôle</label>
                    <select name="role" class="form-select" required>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>Utilisateur</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">📌 Statut</label>
                    <select name="status" class="form-select" required>
                        <option value="actif" {{ old('status', $user->status) === 'actif' ? 'selected' : '' }}>Actif</option>
                        <option value="inactif" {{ old('status', $user->status) === 'inactif' ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-primary">💾 Enregistrer</button>
                    <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
