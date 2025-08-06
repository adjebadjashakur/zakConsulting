@extends('layouts.app')

@section('title', 'Détails du Propriétaire')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">{{ $proprietaire->nom }} {{ $proprietaire->prenom }}</h2>
        <div class="space-x-2">
            <a href="{{ route('proprietaires.edit', $proprietaire) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                Modifier
            </a>
            <a href="{{ route('proprietaires.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Retour
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Informations personnelles</h3>
            <div class="space-y-2 text-gray-700">
                <p><strong>Nom :</strong> {{ $proprietaire->nom }}</p>
                <p><strong>Prénom :</strong> {{ $proprietaire->prenom }}</p>
                <p><strong>Téléphone :</strong> {{ $proprietaire->telephone }}</p>
                <p><strong>Email :</strong> {{ $proprietaire->email }}</p>

                <div>
                    <strong>Carte d'identité :</strong>
                    <ul class="list-disc pl-5 text-blue-500">
                        @if ($proprietaire->carte_identite_recto)
                            <li>
                                <a href="{{ asset('storage/' . $proprietaire->carte_identite_recto) }}" target="_blank" class="underline">
                                    Voir le recto
                                </a>
                            </li>
                        @endif

                        @if ($proprietaire->carte_identite_verso)
                            <li>
                                <a href="{{ asset('storage/' . $proprietaire->carte_identite_verso) }}" target="_blank" class="underline">
                                    Voir le verso
                                </a>
                            </li>
                        @endif

                        @if (!$proprietaire->carte_identite_recto && !$proprietaire->carte_identite_verso)
                            <li><span class="text-gray-500">Non renseignée</span></li>
                        @endif
                    </ul>
                </div>

                <p><strong>Adresse :</strong> {{ $proprietaire->adresse ?? 'Non renseignée' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
