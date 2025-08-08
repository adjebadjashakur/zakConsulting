@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Détails de la chambre {{ $chambre->code_chambre }}</h2>
        <div class="space-x-2">
            <a href="{{ route('chambres.edit', $chambre) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                Modifier
            </a>
            <form action="{{ route('chambres.destroy', $chambre) }}" method="POST" class="inline" onsubmit="return confirm('Confirmer la suppression ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    Supprimer
                </button>
            </form>
            <a href="{{ route('chambres.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Retour à la liste
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Infos chambre --}}
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Informations de la chambre</h3>
            <div class="space-y-2">
                <p><strong>Code chambre :</strong> {{ $chambre->code_chambre }}</p>
                <p><strong>Type :</strong> {{ $chambre->type ?? 'Non renseigné' }}</p>
                <p><strong>Loyer individuel :</strong> {{ number_format($chambre->loyer_individuel, 0, ',', ' ') }} FCFA</p>
                <p><strong>Statut :</strong>
                    <span class="inline-block px-2 py-1 text-xs rounded
                        @if($chambre->statut == 'libre') bg-green-100 text-green-800
                        @elseif($chambre->statut == 'occupé') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                        {{ ucfirst($chambre->statut) }}
                    </span>
                </p>
                <p><strong>Maison :</strong> {{ $chambre->maison->nom ?? 'Non renseigné' }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Informations du locataire</h3>
            @if($chambre->locataire)
                <div class="space-y-2">
                    <p><strong>Nom :</strong> {{ $chambre->locataire->nom }}</p>
                    <p><strong>Prénom :</strong> {{ $chambre->locataire->prenom }}</p>
                    <p><strong>Téléphone :</strong> {{ $chambre->locataire->telephone ?? 'Non renseigné' }}</p>
                    <p><strong>Email :</strong> {{ $chambre->locataire->email ?? 'Non renseigné' }}</p>
                    {{-- Ajoute d’autres infos si besoin --}}
                </div>
            @else
                <p class="text-gray-500 italic">Aucun locataire assigné à cette chambre</p>
            @endif
        </div>
    </div>
</div>
@endsection
