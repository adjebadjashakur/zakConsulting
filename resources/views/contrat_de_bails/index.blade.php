@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Contrats de Bail</h2>
        <a href="{{ route('contrat_de_bails.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition duration-200">
            Nouveau Contrat
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-800 p-4 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($contrats->count() > 0)
        <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Locataire</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Maison</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Chambre</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Loyer</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Période</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach($contrats as $contrat)
        <tr class="hover:bg-gray-50">
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
        {{ optional($contrat->locataire)->nom ?? 'N/A' }} {{ optional($contrat->locataire)->prenom ?? '' }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        {{ optional($contrat->maison)->nom ?? 'N/A' }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        {{ optional($contrat->chambre)->code_chambre ?? 'N/A' }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
        {{ $contrat->loyer ?? 'N/A' }} FCFA
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        <div>Du {{ $contrat->date_debut ? \Carbon\Carbon::parse($contrat->date_debut)->format('d/m/Y') : 'N/A' }}</div>
        <div>Au {{ $contrat->date_fin ? \Carbon\Carbon::parse($contrat->date_fin)->format('d/m/Y') : 'N/A' }}</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
        @switch($contrat->statut)
        @case('actif')
        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Actif</span>
        @break
        @case('suspendu')
        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Suspendu</span>
        @break
        @case('inactif')
        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Inactif</span>
        @break
                @default
        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">{{ ucfirst($contrat->statut) }}</span>
        @endswitch
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <div class="flex justify-end space-x-2">
        <a href="{{ route('contrat_de_bails.show', $contrat) }}" 
        class="text-blue-600 hover:text-blue-900 px-2 py-1 rounded transition duration-200" title="Voir">
        <!-- Icon œil -->
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
        </path>
        </svg>
        </a>
        <a href="{{ route('contrat_de_bails.edit', $contrat) }}" 
        class="text-green-600 hover:text-green-900 px-2 py-1 rounded transition duration-200" title="Modifier">
        <!-- Icon crayon -->
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 
        112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
        </path>
        </svg>
        </a>
        <form action="{{ route('contrat_de_bails.destroy', $contrat) }}" method="POST" class="inline" 
        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce contrat ?')">
        @csrf
        @method('DELETE')
        <button type="submit" 
        class="text-red-600 hover:text-red-900 px-2 py-1 rounded transition duration-200" title="Supprimer">
        <!-- Icon poubelle -->
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
        </path>
        </svg>
        </button>
        </form>
        </div>
        </td>
        </tr>
        @endforeach
        </tbody>
        </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-3">
        {{ $contrats->links() }}
        </div>
        @else
        <div class="p-6 text-center text-gray-500">
        Aucun contrat trouvé.
        </div>
        @endif
        </div>
        </div>
        @endsection
