@extends('layouts.app')

{{-- @section('title', 'Liste des Locataires') --}}

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Liste des Locataires</h2>
    <a href="{{ route('locataires.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Nouveau Locataire
    </a>
</div>

<!-- Message de succès -->
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<!-- Barre de recherche simple -->
<div class="bg-white p-4 rounded-lg shadow mb-6">
    <form method="GET" action="{{ route('locataires.index') }}">
        <div class="flex gap-4">
            <div class="flex-1">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Rechercher un locataire..."
                       class="w-full border rounded px-3 py-2">
            </div>
            <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Rechercher
            </button>
            @if(request('search'))
                <a href="{{ route('locataires.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                    Effacer
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Statistiques simples -->
@if($locataires->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <div class="text-xl font-bold text-blue-600">{{ $locataires->count() }}</div>
            <div class="text-sm text-gray-600">Total</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <div class="text-xl font-bold text-green-600">
                {{ $locataires->filter(function($l) { return $l->contratDeBails->where('statut', 'actif')->count() > 0; })->count() }}
            </div>
            <div class="text-sm text-gray-600">Actifs</div>
        </div>
    </div>
@endif

<div class="bg-white rounded-lg shadow overflow-hidden">
    @if($locataires->count() > 0)
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prénom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Téléphone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Âge</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($locataires as $locataire)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $locataire->nom }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $locataire->prenom }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $locataire->telephone ?? '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $locataire->email ?? '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($locataire->date_naissance)
                            {{ \Carbon\Carbon::parse($locataire->date_naissance)->age }} ans
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($locataire->contratDeBails->where('statut', 'actif')->count() > 0)
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Actif</span>
                        @else
                            <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-sm">Inactif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('locataires.show', $locataire) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                        <a href="{{ route('locataires.edit', $locataire) }}" class="text-yellow-600 hover:text-yellow-900">Modifier</a>
                        
                        <form action="{{ route('locataires.destroy', $locataire) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer {{ $locataire->nom }} {{ $locataire->prenom }} ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <!-- Aucun locataire -->
        <div class="text-center py-12">
            <h3 class="text-lg font-medium mb-2">Aucun locataire</h3>
            <p class="text-gray-500 mb-4">Commencez par ajouter votre premier locataire.</p>
            <a href="{{ route('locataires.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Ajouter un locataire
            </a>
        </div>
    @endif
</div>

<!-- Pagination -->
@if(method_exists($locataires, 'hasPages') && $locataires->hasPages())
    <div class="mt-4">
        {{ $locataires->links() }}
    </div>
@endif

@endsection