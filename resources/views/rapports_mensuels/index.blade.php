@extends('layouts.app')
@section('title', 'Rapports Mensuels')

@section('content')
<div class="max-w-6xl mx-auto p-4">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Rapports Mensuels</h2>
        <a href="{{ route('rapports_mensuels.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">Nouveau Rapport</a>
    </div>

    @if(session('success'))
        <div class="mb-4 px-4 py-2 bg-green-200 text-green-800 rounded shadow">{{ session('success') }}</div>
    @endif

    @forelse($rapports as $proprietaire => $listeRapports)
        <div class="bg-white p-4 rounded shadow mb-6">
            <h3 class="text-xl font-semibold text-gray-700 mb-3">{{ $proprietaire }}</h3>
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 py-2 text-left">Locataire</th>
                            <th class="px-3 py-2 text-left">Maison</th>
                            <th class="px-3 py-2 text-left">Montant</th>
                            <th class="px-3 py-2 text-left">Commission</th>
                            <th class="px-3 py-2 text-left">Total Net</th>
                            <th class="px-3 py-2 text-left">Date</th>
                            <th class="px-3 py-2 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listeRapports as $rapport)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-3 py-2">{{ $rapport->locataire->nom }}</td>
                            <td class="px-3 py-2">{{ $rapport->maison->nom ?? '-' }}</td>
                            <td class="px-3 py-2">{{ number_format($rapport->total, 0, ',', ' ') }}</td>
                            <td class="px-3 py-2">{{ number_format($rapport->commission, 0, ',', ' ') }}</td>
                            <td class="px-3 py-2">{{ number_format($rapport->total_net, 0, ',', ' ') }}</td>
                            <td class="px-3 py-2">{{ \Carbon\Carbon::parse($rapport->date_rapport)->format('d/m/Y') }}</td>
                            <td class="px-3 py-2 text-right space-x-2">
                                <a href="{{ route('rapports_mensuels.show', $rapport) }}" class="text-blue-600 hover:text-blue-800">Voir</a>
                                <a href="{{ route('rapports_mensuels.edit', $rapport) }}" class="text-yellow-600 hover:text-yellow-800">Modifier</a>
                                <form action="{{ route('rapports_mensuels.destroy', $rapport) }}" method="POST" class="inline" onsubmit="return confirm('Confirmer la suppression ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p class="text-right font-semibold mt-2">Total propriétaire : {{ number_format($listeRapports->sum('total'),0,',',' ') }}</p>
        </div>
    @empty
        <div class="p-4 text-gray-500 text-center bg-white rounded shadow">Aucun rapport pour ce mois.</div>
    @endforelse
</div>
@endsection
