@extends('layouts.app')

@section('title', 'Tableau de Bord')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6">Tableau de Bord</h1>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h2 class="text-gray-500">Propriétaires</h2>
            <p class="text-2xl font-bold">{{ $stats['proprietaires'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h2 class="text-gray-500">Locataires</h2>
            <p class="text-2xl font-bold">{{ $stats['locataires'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h2 class="text-gray-500">Maisons</h2>
            <p class="text-2xl font-bold">{{ $stats['maisons'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h2 class="text-gray-500">Chambres disponibles</h2>
            <p class="text-2xl font-bold">{{ $stats['chambres_disponibles'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h2 class="text-gray-500">Contrats actifs</h2>
            <p class="text-2xl font-bold">{{ $stats['contrats_actifs'] }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h2 class="text-gray-500">Revenus totaux</h2>
            <p class="text-2xl font-bold text-green-600">{{ number_format($stats['revenus_totaux'], 0, ',', ' ') }} FCFA</p>
        </div>
    </div>

    <!-- Raccourcis CRUD -->
    <h2 class="text-2xl font-semibold mb-4">Gestion rapide</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <a href="{{ route('proprietaires.index') }}" class="block bg-blue-500 text-white p-6 rounded-lg shadow hover:bg-blue-600">
            Gérer les Propriétaires
        </a>
        <a href="{{ route('locataires.index') }}" class="block bg-blue-500 text-white p-6 rounded-lg shadow hover:bg-blue-600">
            Gérer les Locataires
        </a>
        <a href="{{ route('maisons.index') }}" class="block bg-blue-500 text-white p-6 rounded-lg shadow hover:bg-blue-600">
            Gérer les Maisons
        </a>
        <a href="{{ route('chambres.index') }}" class="block bg-blue-500 text-white p-6 rounded-lg shadow hover:bg-blue-600">
            Gérer les Chambres
        </a>
        <a href="{{ route('contrat_de_bails.index') }}" class="block bg-blue-500 text-white p-6 rounded-lg shadow hover:bg-blue-600">
            Gérer les Contrats de Bail
        </a>
        <a href="{{ route('rapport_immobiliers.index') }}" class="block bg-blue-500 text-white p-6 rounded-lg shadow hover:bg-blue-600">
            Consulter les Rapports
        </a>
    </div>
</div>
@endsection
