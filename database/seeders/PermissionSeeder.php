<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view trajets',
            'edit trajets',
            'delete trajets',
            'create trajets',

            'view utilisateurs',
            'edit utilisateurs',
            'delete utilisateurs',
            'create utilisateurs',

            'view vehicules',
            'edit vehicules',
            'delete vehicules',
            'create vehicules',

            'view reservations',
            'edit reservations',
            'delete reservations',
            'create reservations',

            'view paiements',
            'edit paiements',
            'delete paiements',
            'create paiements',

            'view avis',
            'edit avis',
            'delete avis',
            'create avis',

            'view notifications',
            'edit notifications',
            'delete notifications',
            'create notifications',
        ];

        foreach ($permissions as $permissionName) {
            // Vérifiez si la permission existe déjà
            if (!Permission::where('name', $permissionName)->exists()) {
                Permission::create(['name' => $permissionName]);
            }
        }
    }
}
