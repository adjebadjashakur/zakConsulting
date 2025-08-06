@extends('layouts.app')
{{-- 
@section('title', 'Détails de la Maison') --}}

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">{{ $maison->nom }}</h2>
        <div class="space-x-2">
            <a href="{{ route('maisons.edit', $maison) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                Modifier
            </a>
            <a href="{{ route('maisons.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Retour
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Informations de la maison</h3>
            <div class="space-y-2">
                <p><strong>Nom:</strong> {{ $maison->nom }}</p>
                <p><strong>Adresse:</strong> {{ $maison->adresse }}</p>
                <p><strong>Quartier:</strong> {{ $maison->quartier ?? 'Non renseigné' }}</p>
                <p><strong>Superficie:</strong> {{ $maison->superficie ?? 'Non renseigné' }}</p>
                <p><strong>Description:</strong> {{ $maison->description ?? 'Non renseigné' }}</p>
                <p><strong>Loyer mensuel:</strong> {{ number_format($maison->loyer_mensuel) }} FCFA</p>
                <p><strong>Statut:</strong> 
                    <span class="inline-block px-2 py-1 text-xs rounded 
                        @if($maison->statut == 'libre') bg-green-100 text-green-800
                        @elseif($maison->statut == 'occupé') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                        {{ ucfirst($maison->statut) }}
                    </span>
                </p>
                <p><strong>Propriétaire:</strong> {{ $maison->proprietaire->nom }} {{ $maison->proprietaire->prenom }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Contrats de bail ({{ $maison->contratDeBails->count() }})</h3>
            @if($maison->contratDeBails->count() > 0)
                <div class="space-y-2">
                    @foreach($maison->contratDeBails as $contrat)
                        <div class="border-l-4 border-blue-500 pl-4">
                            <p class="font-medium">{{ $contrat->locataire->nom }} {{ $contrat->locataire->prenom }}</p>
                            <p class="text-sm text-gray-600">Du {{ $contrat->date_debut->format('d/m/Y') }} au {{ $contrat->date_fin->format('d/m/Y') }}</p>
                            <p class="text-sm text-gray-600">Loyer: {{ number_format($contrat->loyer_mensuel) }} FCFA</p>
                            <span class="inline-block px-2 py-1 text-xs rounded 
                                @if($contrat->statut == 'actif') bg-green-100 text-green-800
                                @elseif($contrat->statut == 'expire') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ ucfirst($contrat->statut) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Aucun contrat enregistré</p>
            @endif
        </div>
    </div>
</div>
@endsection
