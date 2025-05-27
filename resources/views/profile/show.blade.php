@extends('layouts.app')

@section('title', 'Profil utilisateur')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>👤 Profil de {{ $user->name }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Nom :</strong> {{ $user->name }}</p>
            <p><strong>Email :</strong> {{ $user->email }}</p>
            <p><strong>Rôle :</strong> {{ ucfirst($user->role) }}</p>
            <p><strong>Statut :</strong> 
                @if ($user->status === 'actif')
                    <span class="badge bg-success">Actif</span>
                @else
                    <span class="badge bg-secondary">Inactif</span>
                @endif
            </p>
            <p><strong>Inscrit le :</strong> {{ $user->created_at->format('d/m/Y') }}</p>

            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary mt-3">
                ✏️ Modifier cet utilisateur
            </a>
        </div>
    </div>
</div>
@endsection
