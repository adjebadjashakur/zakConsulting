<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Gestion des maisons
            'maison-creer',
            'maison-consulter',
            'maison-modifier',
            'maison-supprimer',

            // Gestion des propriétaires
            'proprietaire-creer',
            'proprietaire-consulter',
            'proprietaire-modifier',
            'proprietaire-supprimer',

            // Gestion des locataires
            'locataire-creer',
            'locataire-consulter',
            'locataire-modifier',
            'locataire-supprimer',
            
            // Gestion des contrats de bail
            'bail-creer',
            'bail-consulter',
            'bail-modifier',
            'bail-supprimer',

            // Rapport
            'rapport-generer',
            'rapport-consulter_services',

            // Statistiques
            'statistique-consulter',

            // Gestion des utilisateurs
            'utilisateur-creer',
            'utilisateur-consulter',
            'utilisateur-modifier',
            'utilisateur-supprimer',

            // Attribution
            'attribuer-proprietaire_maison',
            'attribuer-locataire_maison',

            // Authentification (symbolique ici)
            'se_connecter',
        ];

        // Créer toutes les permissions
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Créer les rôles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $secretaire = Role::firstOrCreate(['name' => 'secretaire']);

        // Attribution des permissions au rôle admin (toutes)
        $admin->syncPermissions($permissions);

        // Attribution des permissions au rôle secrétaire (restreint)
        $secretaire->syncPermissions([
            'maison-creer', 'maison-consulter', 'maison-modifier',
            'proprietaire-consulter',
            'locataire-creer', 'locataire-consulter', 'locataire-modifier',
            'bail-creer', 'bail-consulter',
            'rapport-generer',
            'attribuer-locataire_maison',
            'se_connecter'
        ]);

        // Assigner les rôles aux utilisateurs existants
        $adminUser = User::where('email', 'admin@zakconsulting.com')->first();
        if ($adminUser) {
            $adminUser->assignRole('admin');
        }

        $secretaireUser = User::where('email', 'secretaire@zakconsulting.com')->first();
        if ($secretaireUser) {
            $secretaireUser->assignRole('secretaire');
        }
    }
}