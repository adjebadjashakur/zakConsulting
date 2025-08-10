@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold">Chambre {{ $chambre->code_chambre }}</h2>
        <div class="space-x-3">
            <a href="{{ route('chambres.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Retour</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Infos chambre --}}
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-semibold mb-4">Infos chambre</h3>
            <p><strong>Code :</strong> {{ $chambre->code_chambre }}</p>
            <p><strong>Type :</strong> {{ $chambre->type ?? 'Non renseigné' }}</p>
            <p><strong>Loyer :</strong> {{ $chambre->loyer_individuel }} FCFA</p>
            <p><strong>Caution :</strong> {{ $chambre->caution ?? $chambre->loyer_individuel * 3 * 0.10 }} FCFA</p>
            <p><strong>Statut :</strong> 
                <span class="px-2 py-1 rounded text-sm
                    {{ $chambre->statut === 'libre' ? 'bg-green-100 text-green-800' : ($chambre->statut === 'occupé' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                    {{ ucfirst($chambre->statut) }}
                </span>
            </p>
            <p><strong>Maison :</strong> {{ $chambre->maison->nom ?? 'Non renseigné' }}</p>
        </div>

        {{-- Infos locataire --}}
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-semibold mb-4">Locataire</h3>
            @if($chambre->locataire)
                <p><strong>Nom :</strong> {{ $chambre->locataire->nom }}</p>
                <p><strong>Prénom :</strong> {{ $chambre->locataire->prenom }}</p>
                <p><strong>Téléphone :</strong> {{ $chambre->locataire->telephone ?? 'Non renseigné' }}</p>
                <p><strong>Email :</strong> {{ $chambre->locataire->email ?? 'Non renseigné' }}</p>
                <a href="{{ route('locataires.show', $chambre->locataire) }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Voir profil</a>
            @else
                <p class="italic text-gray-500">Aucun locataire pour cette chambre.</p>
            @endif
        </div>

        {{-- Actions & résumé financier --}}
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-semibold mb-4">Actions rapides</h3>
            <a href="{{ route('chambres.edit', $chambre) }}" class="block mb-3 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 text-center">Modifier la chambre</a>
            @if($chambre->locataire)
                <a href="{{ route('locataires.edit', $chambre->locataire) }}" class="block mb-3 bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600 text-center">Modifier le locataire</a>
            @endif
            <a href="{{ route('maisons.show', $chambre->maison) }}" class="block mb-6 bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600 text-center">Voir la maison</a>

            <h3 class="font-semibold mb-4">Résumé financier</h3>
            <p><strong>Loyer mensuel :</strong> {{ $chambre->loyer_individuel }} FCFA</p>
            <p><strong>Caution requise :</strong> {{ $chambre->caution ?? $chambre->loyer_individuel * 3 * 0.10 }} FCFA</p>
            <p><strong>Revenus annuels :</strong> {{ $chambre->loyer_individuel * 12 }} FCFA</p>
        </div>
    </div>
</div>
@endsection
