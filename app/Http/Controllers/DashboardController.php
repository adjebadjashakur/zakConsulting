<?php

namespace App\Http\Controllers;
use App\Models\Chambre;
use App\Models\ContratDeBail;
use App\Models\Locataire;
use App\Models\Maison;
use App\Models\Proprietaire;
use App\Models\RapportImmobilier;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function menu()
    {
        $stats = [
        'proprietaires' => Proprietaire::count(),
        'locataires' => Locataire::count(),
        'maisons' => Maison::count(),
        'chambres_disponibles' => Chambre::where('statut', 'libre')->count(),
        'contrats_actifs' => ContratDeBail::count(),
        'revenus_totaux' => RapportImmobilier::sum('total_net'),
    ];
    return view('dashboard', compact('stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}