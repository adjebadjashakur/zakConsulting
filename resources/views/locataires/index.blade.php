@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Liste des Locataires</h2>
    <a href="{{ route('locataires.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Nouveau Locataire
    </a>
</div>

@if(session('success'))
    <div class="mb-4 px-4 py-2 bg-green-200 text-green-800 rounded shadow">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prénom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Téléphone</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bails actifs</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($locataires as $locataire)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $locataire->nom }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $locataire->prenom }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $locataire->telephone }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $locataire->email ?? 'N/A' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $locataire->contratDeBails->count() }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                    <a href="{{ route('locataires.show', $locataire) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                    <a href="{{ route('locataires.edit', $locataire) }}" class="text-yellow-600 hover:text-yellow-900">Modifier</a>
                    <form action="{{ route('locataires.destroy', $locataire) }}" method="POST" class="inline" onsubmit="return confirm('Confirmer la suppression ?')">
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
