@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Détails du Contrat</h2>

    <ul class="space-y-2">
        <li><strong>Locataire :</strong> {{ $contratDeBail->locataire->nom }} {{ $contratDeBail->locataire->prenom }}</li>
        <li><strong>Maison :</strong> {{ $contratDeBail->maison->nom }}</li>
        <li><strong>Chambre :</strong> {{ $contratDeBail->chambre->code_chambre ?? '-' }}</li>
        <li><strong>Date début :</strong> {{ $contratDeBail->date_debut }}</li>
        <li><strong>Date fin :</strong> {{ $contratDeBail->date_fin }}</li>
        <li><strong>Loyer :</strong> {{ number_format($contratDeBail->loyer_mensuel, 0, ',', ' ') }} FCFA</li>
        <li><strong>Caution :</strong> {{ number_format($contratDeBail->caution, 0, ',', ' ') }} FCFA</li>
        <li><strong>Statut :</strong> {{ ucfirst($contratDeBail->statut) }}</li>
        @if($contratDeBail->pdf)
            <li><strong>PDF :</strong> <a href="{{ asset('storage/' . $contratDeBail->pdf) }}" target="_blank" class="text-blue-500 underline">Voir le fichier</a></li>
        @endif
    </ul>

    <div class="mt-6 flex space-x-4">
        <a href="{{ route('contrat_de_bails.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Retour</a>
        <a href="{{ route('contrat_de_bails.edit', $contratDeBail) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Modifier</a>
    </div>
</div>
@endsection
