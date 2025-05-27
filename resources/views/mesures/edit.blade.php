@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Modifier la mesure</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mesures.update', $mesure->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="indicateur">Indicateur</label>
            <input type="text" class="form-control" id="indicateur" name="indicateur" value="{{ $mesure->indicateur }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="zone">Zone</label>
            <input type="text" class="form-control" id="zone" name="zone" value="{{ $mesure->zone }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="valeur">Valeur</label>
            <input type="text" class="form-control" id="valeur" name="valeur" value="{{ $mesure->valeur }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="date_releve">Date relevé</label>
            <input type="date" class="form-control" id="date_releve" name="date_releve" value="{{ $mesure->date_releve }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('mesures.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
