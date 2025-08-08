@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Liste des Chambres</h2>
    <a href="{{ route('chambres.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Ajouter une chambre
    </a>
</div>

@if(session('success'))
    <div class="mb-4 px-4 py-2 bg-green-200 text-green-800 rounded shadow">
        {{ session('success') }}
    </div>
@endif

<table class="min-w-full table-auto bg-white rounded shadow overflow-hidden">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Code</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Type</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Loyer individuel</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Statut</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Maison</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @foreach($chambres as $chambre)
        <tr>
            <td class="px-6 py-4">{{ $chambre->code_chambre }}</td>
            <td class="px-6 py-4">{{ $chambre->type ?? '-' }}</td>
            <td class="px-6 py-4">{{ number_format($chambre->loyer_individuel, 0, ',', ' ') }} FCFA</td>
            <td class="px-6 py-4 capitalize">{{ $chambre->statut }}</td>
            <td class="px-6 py-4">{{ $chambre->maison->nom ?? '-' }}</td>
            <td class="px-6 py-4 space-x-2 text-sm">
                <a href="{{ route('chambres.show', $chambre) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                <a href="{{ route('chambres.edit', $chambre) }}" class="text-yellow-600 hover:text-yellow-900">Modifier</a>
                <form action="{{ route('chambres.destroy', $chambre) }}" method="POST" class="inline" onsubmit="return confirm('Confirmer la suppression ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
