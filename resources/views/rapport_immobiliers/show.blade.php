@extends('layouts.app')

@section('title', 'Détails du Rapport Immobilier')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Détails du Rapport Immobilier</h2>

    <p><strong>Locataire :</strong> {{ $rapportImmobilier->locataire->nom ?? '-' }}</p>
    <p><strong>Propriétaire :</strong> {{ $rapportImmobilier->proprietaire->nom ?? '-' }}</p>
    <p><strong>Total :</strong> {{ number_format($rapportImmobilier->total, 2) }}</p>
    <p><strong>Commission :</strong> {{ number_format($rapportImmobilier->commission, 2) }}</p>
    <p><strong>Total Net :</strong> {{ number_format($rapportImmobilier->total_net, 2) }}</p>
    <p><strong>Mois/Année :</strong> {{ $rapportImmobilier->mois_annee }}</p>
    <p><strong>Date Rapport :</strong> {{ \Carbon\Carbon::parse($rapportImmobilier->date_rapport)->format('d/m/Y') }}</p>

    <div class="mt-6 flex justify-end">
        <a href="{{ route('rapport_immobiliers.index') }}" class="bg-gray-300 px-4 py-2 rounded mr-2">Retour</a>
        <a href="{{ route('rapport_immobiliers.edit', $rapportImmobilier) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Modifier</a>
    </div>
</div>
@endsection
