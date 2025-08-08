@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Contrats de bail</h2>
    <a href="{{ route('contrat_de_bails.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Nouveau Contrat
    </a>
</div>

@if(session('success'))
    <div class="mb-4 px-4 py-2 bg-green-200 text-green-800 rounded shadow">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left">Locataire</th>
                <th class="px-4 py-2 text-left">Maison</th>
                <th class="px-4 py-2 text-left">Début</th>
                <th class="px-4 py-2 text-left">Fin</th>
                {{-- <th class="px-4 py-2 text-left">Loyer</th> --}}
                {{-- <th class="px-4 py-2 text-left">Caution</th> --}}
                <th class="px-4 py-2 text-left">Statut</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($contrats as $contrat)
            <tr>
                <td class="px-4 py-2">
                    {{ $contrat->locataire->nom }} {{ $contrat->locataire->prenom ?? '' }}
                </td>
                <td class="px-4 py-2">{{ $contrat->maison->nom ?? '—' }}</td>
                <td class="px-4 py-2">
                    {{ \Carbon\Carbon::parse($contrat->date_debut)->format('d/m/Y') }}
                </td>
                <td class="px-4 py-2">
                    {{ \Carbon\Carbon::parse($contrat->date_fin)->format('d/m/Y') }}
                </td>
                {{-- <td class="px-4 py-2">{{ number_format($contrat->loyer_mensuel ?? 0, 0, ',', ' ') }} FCFA</td> --}}
                {{-- <td class="px-4 py-2">{{ number_format($contrat->caution ?? 0, 0, ',', ' ') }} FCFA</td> --}}
                <td class="px-4 py-2 capitalize">{{ $contrat->statut }}</td>
                <td class="px-4 py-2 space-x-2">
                    <a href="{{ route('contrat_de_bails.show', $contrat) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('contrat_de_bails.edit', $contrat) }}" class="text-yellow-600 hover:underline">Modifier</a>
                    <form action="{{ route('contrat_de_bails.destroy', $contrat) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce contrat ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
