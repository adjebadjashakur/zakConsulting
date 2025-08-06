<?php

namespace Database\Seeders;

use App\Models\Proprietaire;
use Illuminate\Database\Seeder;

class ProprietaireSeeder extends Seeder
{
    public function run(): void
    {
        Proprietaire::create([
            'nom' => 'AGBESSI',
            'prenom' => 'Koffi',
            'telephone' => '90123456',
            'email' => 'koffi.agbessi@gmail.com',
            'carte_identite_recto' => '0439-135-501',
            'carte_identite_verso' => '0439-135-502',
            'adresse' => 'Agoe Adjougba',
            
        ]);

        Proprietaire::create([
            'nom' => 'HINDOU',
            'prenom' => 'Fatima',
            'telephone' => '91234567',
            'email' => 'fatima.hindou@yahoo.com',
            'carte_identite_recto' => '0439-135-502',
            'carte_identite_verso' => '0439-135-503',
            'adresse' => 'Bè Kpota',
            
        ]);

        Proprietaire::create([
            'nom' => 'DOSSOU',
            'prenom' => 'Emmanuel',
            'telephone' => '92345678',
            'email' => 'emmanuel.dossou@gmail.com',
            'carte_identite_recto' => '0439-135-503',
            'carte_identite_verso' => '0439-135-504',
            'adresse' => 'Nyékonakpoè',
            
        ]);
    }
}