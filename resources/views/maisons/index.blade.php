@extends('layouts.app')

@section('title', 'Liste des Maisons')

@section('content')
<div class="flex justify-between items-center  mb-6 ">
    <h2 class="text-2xl font-bold">Liste des Maisons</h2>
    <a href="{{ route('maisons.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Nouvelle Maison
    </a>
</div>

@if(session('success'))
    <div class="mb-6 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif

@if($maisons->count() > 0)
    <!-- Statistiques simples -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <div class="text-xl font-bold text-blue-600">{{ $maisons->count() }}</div>
            <div class="text-sm text-gray-600">Total</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <div class="text-xl font-bold text-green-600">{{ $maisons->where('statut', 'libre')->count() }}</div>
            <div class="text-sm text-gray-600">Libres</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <div class="text-xl font-bold text-red-600">{{ $maisons->where('statut', 'occupé')->count() }}</div>
            <div class="text-sm text-gray-600">Occupées</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <div class="text-xl font-bold text-purple-600">
                {{ $maisons->sum(fn($m) => $m->chambres?->count() ?? 0) }}
            </div>
            <div class="text-sm text-gray-600">Chambres</div>
        </div>
    </div>
@endif

<!-- Conteneur avec défilement horizontal pour les petits écrans -->
<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50 whitespace-nowrap">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Propriétaire
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nom
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Adresse
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Quartier
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Chambres
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Statut
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($maisons as $maison)
                @php
                    $nbChambres = $maison->chambres?->count() ?? 0;
                    $nbChambresOccupees = $maison->chambres?->where('statut', 'occupé')->count() ?? 0;
                @endphp
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        {{ $maison->proprietaire?->nom ?? '-' }} {{ $maison->proprietaire?->prenom ?? '' }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-sm">{{ $maison->nom }}</div>
                        @if($maison->description)
                            <div class="text-sm text-gray-500 truncate max-w-xs" title="{{ $maison->description }}">
                                {{ Str::limit($maison->description, 50) }}
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span class="truncate block max-w-xs" title="{{ $maison->adresse }}">
                            {{ Str::limit($maison->adresse, 30) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        {{ $maison->quartier ?? '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        {{ $nbChambres }} chambre(s)
                        @if($nbChambres > 0)
                            <div class="text-gray-500 text-xs">
                                ({{ $nbChambresOccupees }} occupée)
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($maison->statut === 'libre')
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Libre</span>
                        @elseif($maison->statut === 'occupé')
                            <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">Occupé</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">
                                {{ ucfirst($maison->statut) }}
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-y-1">
                        <a href="{{ route('maisons.show', $maison) }}" class="text-blue-600 hover:text-blue-900 block">Voir</a>
                        <a href="{{ route('maisons.edit', $maison) }}" class="text-yellow-600 hover:text-yellow-900 block">Modifier</a>
                        <a href="{{ route('chambres.create', ['maison_id' => $maison->id]) }}" class="text-green-600 hover:text-green-900 block">Ajouter chambre</a>
                        <form action="{{ route('maisons.destroy', $maison) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 block" onclick="return confirm('Êtes-vous sûr de vouloir supprimer {{ addslashes($maison->nom) }} ?')">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    @if($maisons->hasPages())
        <div class="px-6 py-3 border-t border-gray-200 bg-gray-50">
            {{ $maisons->links() }}
        </div>
    @endif
</div>
@endsection