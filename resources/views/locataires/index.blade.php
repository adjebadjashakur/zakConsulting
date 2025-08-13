@extends('layouts.app')

@section('title', 'Liste des Locataires') 

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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nationalité</th>
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
                        {{ $locataire->nationalite ?? '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($locataire->contratDeBails->where('statut', 'actif')->count() > 0)
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Actif</span>
                        @else
                            <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-sm">Inactif</span>
                        @endif
                    </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('locataires.show', $locataire) }}" 
                                           class="text-blue-600 hover:text-blue-900 px-2 py-1 rounded transition duration-200"
                                           title="Voir">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('locataires.edit', $locataire) }}" 
                                           class="text-green-600 hover:text-green-900 px-2 py-1 rounded transition duration-200"
                                           title="Modifier">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('locataires.destroy', $locataire) }}" method="POST" class="inline" 
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce locataire ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900 px-2 py-1 rounded transition duration-200"
                                                    title="Supprimer">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
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