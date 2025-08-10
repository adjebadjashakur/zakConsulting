@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Liste des Contrats de Bail</h2>
        <a href="{{ route('contrat_de_bails.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Nouveau Contrat
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-800 p-4 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Locataire</th>
                    <th class="px-4 py-2">Maison</th>
                    <th class="px-4 py-2">Chambre</th>
                    <th class="px-4 py-2 text-left">Début</th>
                    <th class="px-4 py-2 text-left">Fin</th>
                    <th class="px-4 py-2">Loyer</th>
                    <th class="px-4 py-2">Statut</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contrats as $contrat)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $contrat->locataire->nom }} {{ $contrat->locataire->prenom }}</td>
                        <td class="px-4 py-2">{{ $contrat->maison->nom }}</td>
                        <td class="px-4 py-2">{{ $contrat->chambre->code_chambre ?? '-' }}</td>
                        <td class="px-4 py-2">
                            {{ \Carbon\Carbon::parse($contrat->date_debut)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-2">
                            {{ \Carbon\Carbon::parse($contrat->date_fin)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-2">{{ $contrat->chambre->loyer_individuel }} FCFA</td>
                        <td class="px-4 py-2 capitalize">{{ $contrat->statut }}</td> 
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('contrat_de_bails.show', $contrat) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Voir</a>
                            <a href="{{ route('contrat_de_bails.edit', $contrat) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Modifier</a>
                            <form action="{{ route('contrat_de_bails.destroy', $contrat) }}" method="POST" onsubmit="return confirm('Supprimer ce contrat ?');">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-2 text-center text-gray-500">Aucun contrat trouvé</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
