@extends('layouts.app')
{{-- 
@section('title', 'Liste des Propriétaires') --}}

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Liste des Propriétaires</h2>
    <a href="{{ route('proprietaires.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Nouveau Propriétaire
    </a>
</div>

<div class="bg-white  rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prénom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Téléphone</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Maisons</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($proprietaires as $proprietaire)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $proprietaire->nom }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $proprietaire->prenom }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $proprietaire->telephone }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $proprietaire->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $proprietaire->maisons->count() }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                    <a href="{{ route('proprietaires.show', $proprietaire) }}" class="text-blue-600 hover:text-blue-900">Voir</a>
                    <a href="{{ route('proprietaires.edit', $proprietaire) }}" class="text-yellow-600 hover:text-yellow-900">Modifier</a>
                    <a href="{{ route('proprietaires.details', $proprietaire->id) }}" class="text-blue-600 hover:text-blue-900">Détails</a>

                    <form action="{{ route('proprietaires.destroy', $proprietaire) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
