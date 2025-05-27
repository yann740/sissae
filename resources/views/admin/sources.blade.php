@extends('layouts.app')

@section('title', 'Sources de données')

@section('content')
<div class="container">
    <h1>📚 Sources de données (Admin uniquement)</h1>
    <p>Bienvenue, {{ auth()->user()->name }} !</p>
</div>
@endsection
