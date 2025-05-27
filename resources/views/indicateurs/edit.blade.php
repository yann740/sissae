@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Modifier l’indicateur</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('indicateurs.update', $indicateur->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ $indicateur->nom }}" required>
        </div>

        <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" name="code" class="form-control" value="{{ $indicateur->code }}">
        </div>

        <div class="mb-3">
            <label for="categorie" class="form-label">Catégorie</label>
            <input type="text" name="categorie" class="form-control" value="{{ $indicateur->categorie }}">
        </div>

        <div class="mb-3">
            <label for="unite" class="form-label">Unité</label>
            <input type="text" name="unite" class="form-control" value="{{ $indicateur->unite }}">
        </div>

        <div class="mb-3">
            <label for="seuil_critique" class="form-label">Seuil critique</label>
            <input type="number" name="seuil_critique" class="form-control" value="{{ $indicateur->seuil_critique }}">
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
