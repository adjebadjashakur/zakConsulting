@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Liste des Maisons</h2>
    @can('maison-creer')
    <a href="{{ route('maisons.create') }}"  class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Ajouter une maison
    </a>
    @endcan
</div>

@if(session('success'))
    <div class="mb-4 px-4 py-2 bg-green-200 text-green-800 rounded shadow">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full table-auto">
        <thead class="bg-green-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Adresse</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Quartier</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Superficie</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Loyer</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Statut</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Propriétaire</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($maisons as $maison)
            <tr>
                <td class="px-6 py-4">{{ $maison->nom }}</td>
                <td class="px-6 py-4">{{ $maison->adresse }}</td>
                <td class="px-6 py-4">{{ $maison->quartier }}</td>
                <td class="px-6 py-4">{{ $maison->superficie }}</td>
                <td class="px-6 py-4">{{ $maison->description }}</td>
                <td class="px-6 py-4">{{  $maison->loyer_mensuel = $maison->chambres->sum('loyer_individuel');}}</td> 
                <td class="px-6 py-4 capitalize">{{ $maison->statut }}</td>
                <td class="px-6 py-4">{{ $maison->proprietaire->nom  }}</td>
                <td class="px-6 py-4 text-sm space-x-2">
                    <a href="{{ route('maisons.show', $maison) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                    <a href="{{ route('maisons.edit', $maison) }}" class="text-yellow-600 hover:text-yellow-900">Modifier</a>
                    <a href="{{ route('chambres.create') }}" class="text-green-600 hover:text-green-900">Créer une chambre</a> 
                    <form action="{{ route('maisons.destroy', $maison) }}" method="POST" class="inline" onsubmit="return confirm('Confirmer la suppression ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
