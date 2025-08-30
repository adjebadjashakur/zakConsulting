@extends('layouts.app')
@section('title', 'Détails du Rapport')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Détails du Rapport</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
        <p><span class="font-medium">Locataire :</span> {{ $rapport->locataire->nom }}</p>
        <p><span class="font-medium">Propriétaire :</span> {{ $rapport->proprietaire->nom }}</p>
        <p><span class="font-medium">Maison :</span> {{ $rapport->maison->nom ?? '-' }}</p>
        <p><span class="font-medium">Montant :</span> {{ number_format($rapport->total,0,',',' ') }}</p>
        <p><span class="font-medium">Commission :</span> {{ number_format($rapport->commission,0,',',' ') }}</p>
        <p><span class="font-medium">Total Net :</span> {{ number_format($rapport->total_net,0,',',' ') }}</p>
        <p><span class="font-medium">Mois/Année :</span> {{ $rapport->mois_annee }}</p>
        <p><span class="font-medium">Date :</span> {{ \Carbon\Carbon::parse($rapport->date_rapport)->format('d/m/Y') }}</p>
        <p><span class="font-medium">Mode Paiement :</span> {{ $rapport->mode_paiement ?? '-' }}</p>
    </div>

    <div class="mt-6 flex justify-end space-x-4">
        <a href="{{ route('rapports_mensuels.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Retour</a>
        <a href="{{ route('rapports_mensuels.edit', $rapport) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</a>
    </div>
</div>
@endsection
