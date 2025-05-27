@extends('layouts.app')

@section('title', 'Utilisateurs')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>👥 Gestion des utilisateurs</h3>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">➕ Ajouter</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.users') }}" class="row g-2 align-items-center">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="🔍 Nom ou email" value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="role" class="form-select">
                        <option value="">🎭 Tous les rôles</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Utilisateur</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">📌 Tous statuts</option>
                        <option value="actif" {{ request('status') == 'actif' ? 'selected' : '' }}>Actif</option>
                        <option value="inactif" {{ request('status') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.users.export') }}" class="btn btn-outline-success w-100">📤 Exporter</a>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-striped table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Date d’inscription</th>
            <th>Statut</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ ucfirst($user->role) }}</td>
            <td>{{ $user->created_at->format('d/m/Y') }}</td>
            <td>
                @if ($user->status === 'actif')
                    <span class="badge bg-success">Actif</span>
                @else
                    <span class="badge bg-secondary">Inactif</span>
                @endif
            </td>
            <td class="text-center">
                <!-- 👤 Bouton Profil -->
                <button class="btn btn-sm btn-info" data-bs-toggle="offcanvas" data-bs-target="#userProfile" data-user='@json($user)'>
                         <i class="fas fa-user"></i> Profil
                </button>
                <!-- ✏️ Bouton Modifier -->
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i> Modifier
                </a>

                <!-- 🗑️ Formulaire de suppression -->
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Confirmer la suppression de cet utilisateur ?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i> Supprimer
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">Aucun utilisateur trouvé.</td>
        </tr>
        @endforelse
    </tbody>

</table>
<!-- Modal Profil Utilisateur -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="userProfile" aria-labelledby="userProfileLabel">
    <div class="offcanvas-header bg-primary text-white">
        <h5 class="offcanvas-title" id="userProfileLabel">👤 Profil utilisateur</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Fermer"></button>
    </div>
    <div class="offcanvas-body">
        <!-- Affichage des informations de l'utilisateur -->
        <div id="profile-view">
            <div class="text-center mb-3">
                <i class="fas fa-user-circle fa-5x text-secondary mb-2"></i>
             
                <span id="view-role" class="badge bg-info text-dark"></span>
                <span id="view-status" class="badge"></span>
            </div>
          <h4 id="view-name"></h4>
                 <p><strong>Email :</strong> <span id="view-email"></span></p>
                 <p><strong>Rôle :</strong> <span id="view-role-name" class="badge bg-info text-dark"></span></p>
                 <p><strong>Statut :</strong> <span id="view-status-name" class="badge"></span></p>
                 <p><strong>Date d’inscription :</strong> <span id="view-date"></span></p>

            <div class="mt-4 d-flex gap-2">
                <button class="btn btn-secondary w-100" data-bs-dismiss="offcanvas">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script>
   document.getElementById('userProfile').addEventListener('show.bs.offcanvas', function () {
    const button = document.activeElement;
    const userData = button.getAttribute('data-user');
    if (!userData) return;

    const user = JSON.parse(userData);

    // Injecter dans le modal
    document.getElementById('view-name').textContent = user.name ?? '—';
    document.getElementById('view-email').textContent = user.email ?? '—';
    document.getElementById('view-role-name').textContent = user.role?.charAt(0).toUpperCase() + user.role?.slice(1) ?? '—';
    document.getElementById('view-status-name').textContent = user.status === 'actif' ? 'Actif' : 'Inactif';
    document.getElementById('view-status-name').className = user.status === 'actif' ? 'badge bg-success' : 'badge bg-secondary';
    document.getElementById('view-date').textContent = new Date(user.created_at).toLocaleDateString('fr-FR');
});
</script>


</div>
@endsection
