<?php

namespace Database\Seeders;
use App\Models\Trajet;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TrajetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trajets = [
            [
                'conducteur_id' => 1, // Ajoute ici un conducteur valide
        'point_depart' => 'dakar Centre',
        'point_arrivee' => 'Almadies',
        'date_depart' => '2024-10-08',
        'heure_depart' => '09:56:27',
        'statut' => 'terminer',
        'vehicule_id' => 2,
        'prix' => 500,
        'nombre_places' => 4,
        'created_at' => now(),
        'updated_at' => now(),
            ],

            [
                'conducteur_id' => 1, // Ajoute ici un conducteur valide
        'point_depart' => 'dakar Centre',
        'point_arrivee' => 'Almadies',
        'date_depart' => '2024-10-08',
        'heure_depart' => '09:56:27',
        'statut' => 'terminer',
        'vehicule_id' => 2,
        'prix' => 500,
        'nombre_places' => 4,
        'created_at' => now(),
        'updated_at' => now(),
                ],
        ];

        foreach ($trajets as $trajetData) {
            Trajet::create($trajetData);
        }
    }
}
