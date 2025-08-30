<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProprietaireController;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\MaisonController;
use App\Http\Controllers\LocataireController;
use App\Http\Controllers\ContratDeBailController;
use App\Http\Controllers\RapportImmobilierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RapportMensuelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class,'menu'])->name('dashboard');

Route::get('/proprietaires/{id}/details', [ProprietaireController::class, 'indexWithDetails'])->name('proprietaires.details');

// Authentification
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Routes protégées
Route::middleware(['auth'])->group(function () {
    
// Routes Chambres
Route::get('/chambres', [ChambreController::class, 'index'])->name('chambres.index');
Route::get('/chambres/create', [ChambreController::class, 'create'])->name('chambres.create');
Route::post('/chambres', [ChambreController::class, 'store'])->name('chambres.store');
Route::get('/chambres/{chambre}', [ChambreController::class, 'show'])->name('chambres.show');
Route::get('/chambres/{chambre}/edit', [ChambreController::class, 'edit'])->name('chambres.edit');
Route::put('/chambres/{chambre}', [ChambreController::class, 'update'])->name('chambres.update');
Route::delete('/chambres/{chambre}', [ChambreController::class, 'destroy'])->name('chambres.destroy');

// Routes Propriétaires
Route::get('/proprietaires', [ProprietaireController::class, 'index'])->name('proprietaires.index');
Route::get('/proprietaires/create', [ProprietaireController::class, 'create'])->name('proprietaires.create');
Route::post('/proprietaires', [ProprietaireController::class, 'store'])->name('proprietaires.store');
Route::get('/proprietaires/{proprietaire}', [ProprietaireController::class, 'show'])->name('proprietaires.show');
Route::get('/proprietaires/{proprietaire}/edit', [ProprietaireController::class, 'edit'])->name('proprietaires.edit');
Route::put('/proprietaires/{proprietaire}', [ProprietaireController::class, 'update'])->name('proprietaires.update');
Route::delete('/proprietaires/{proprietaire}', [ProprietaireController::class, 'destroy'])->name('proprietaires.destroy');

// Routes Maisons
Route::get('/maisons', [MaisonController::class, 'index'])->name('maisons.index');
Route::get('/maisons/create', [MaisonController::class, 'create'])->name('maisons.create');
Route::post('/maisons', [MaisonController::class, 'store'])->name('maisons.store');
Route::get('/maisons/{maison}', [MaisonController::class, 'show'])->name('maisons.show');
Route::get('/maisons/{maison}/edit', [MaisonController::class, 'edit'])->name('maisons.edit');
Route::put('/maisons/{maison}', [MaisonController::class, 'update'])->name('maisons.update');
Route::delete('/maisons/{maison}', [MaisonController::class, 'destroy'])->name('maisons.destroy');

// Routes Locataires
Route::get('/locataires', [LocataireController::class, 'index'])->name('locataires.index');
Route::get('/locataires/create', [LocataireController::class, 'create'])->name('locataires.create');
Route::post('/locataires', [LocataireController::class, 'store'])->name('locataires.store');
Route::get('/locataires/{locataire}', [LocataireController::class, 'show'])->name('locataires.show');
Route::get('/locataires/{locataire}/edit', [LocataireController::class, 'edit'])->name('locataires.edit');
Route::put('/locataires/{locataire}', [LocataireController::class, 'update'])->name('locataires.update');
Route::delete('/locataires/{locataire}', [LocataireController::class, 'destroy'])->name('locataires.destroy');

// Routes Contrats de Bail
Route::get('/contrat-de-bails', [ContratDeBailController::class, 'index'])->name('contrat_de_bails.index');
Route::get('/contrat-de-bails/create', [ContratDeBailController::class, 'create'])->name('contrat_de_bails.create');
Route::post('/contrat-de-bails', [ContratDeBailController::class, 'store'])->name('contrat_de_bails.store');
Route::get('/contrat-de-bails/{contratDeBail}', [ContratDeBailController::class, 'show'])->name('contrat_de_bails.show');
Route::get('/contrat-de-bails/{contratDeBail}/edit', [ContratDeBailController::class, 'edit'])->name('contrat_de_bails.edit');
Route::put('/contrat-de-bails/{contratDeBail}', [ContratDeBailController::class, 'update'])->name('contrat_de_bails.update');
Route::delete('/contrat-de-bails/{contratDeBail}', [ContratDeBailController::class, 'destroy'])->name('contrat_de_bails.destroy');




// Routes Rapports Mensuels
Route::get('/rapports-mensuels', [RapportMensuelController::class, 'index'])->name('rapports_mensuels.index');
Route::get('/rapports-mensuels/create', [RapportMensuelController::class, 'create'])->name('rapports_mensuels.create');
Route::post('/rapports-mensuels', [RapportMensuelController::class, 'store'])->name('rapports_mensuels.store');
Route::get('/rapports-mensuels/{rapportMensuel}', [RapportMensuelController::class, 'show'])->name('rapports_mensuels.show');
Route::get('/rapports-mensuels/{rapportMensuel}/edit', [RapportMensuelController::class, 'edit'])->name('rapports_mensuels.edit');
Route::put('/rapports-mensuels/{rapportMensuel}', [RapportMensuelController::class, 'update'])->name('rapports_mensuels.update');
Route::delete('/rapports-mensuels/{rapportMensuel}', [RapportMensuelController::class, 'destroy'])->name('rapports_mensuels.destroy');


// Routes Rapports Immobiliers
Route::get('/rapport-immobiliers', [RapportImmobilierController::class, 'index'])->name('rapport_immobiliers.index');
Route::get('/rapport-immobiliers/create', [RapportImmobilierController::class, 'create'])->name('rapport_immobiliers.create');
Route::post('/rapport-immobiliers', [RapportImmobilierController::class, 'store'])->name('rapport_immobiliers.store');
Route::get('/rapport-immobiliers/{rapportImmobilier}', [RapportImmobilierController::class, 'show'])->name('rapport_immobiliers.show');
Route::get('/rapport-immobiliers/{rapportImmobilier}/edit', [RapportImmobilierController::class, 'edit'])->name('rapport_immobiliers.edit');
Route::put('/rapport-immobiliers/{rapportImmobilier}', [RapportImmobilierController::class, 'update'])->name('rapport_immobiliers.update');
Route::delete('/rapport-immobiliers/{rapportImmobilier}', [RapportImmobilierController::class, 'destroy'])->name('rapport_immobiliers.destroy');

});