@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6">
        Détails du Propriétaire : {{ $proprietaire->nom }} {{ $proprietaire->prenom }}
    </h2>

    <p><strong>Téléphone :</strong> {{ $proprietaire->telephone }}</p>
    <p><strong>Email :</strong> {{ $proprietaire->email }}</p>
    <p><strong>Adresse :</strong> {{ $proprietaire->adresse }}</p>

    <h4 class="mt-4 font-bold">Maisons :</h4>
    @forelse ($proprietaire->maisons as $maison)
        <div class="ml-4 mt-2 border-b pb-2">
            <p class="font-semibold">{{ $maison->nom }} ({{ $maison->quartier ?? 'Quartier inconnu' }})</p>
            <p><strong>Adresse :</strong> {{ $maison->adresse }}</p>
            <p><strong>Loyer :</strong> {{ $maison->loyer_mensuel }} FCFA</p>

            <h5 class="mt-2 font-bold">Locataires :</h5>
            @forelse ($maison->contratDeBails as $contrat)
                <div class="ml-4">
                    <p><strong>{{ $contrat->locataire->nom }} {{ $contrat->locataire->prenom }}</strong></p>
                    <p>Contrat : {{ $contrat->date_debut }}  : {{ $contrat->date_fin }}</p>
                </div>
            @empty
                <p class="ml-4 text-gray-600">Aucun locataire.</p>
            @endforelse
        </div>
    @empty
        <p>Aucune maison enregistrée.</p>
    @endforelse
</div>
@endsection
