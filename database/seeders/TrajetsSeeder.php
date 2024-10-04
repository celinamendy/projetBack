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
                'point_depart' => 'Hann Bel-Air',
                'point_arrivee' => 'Yoff',
                'date_depart' => now()->addDays(1),
                'heure_depart'=> now()->addDays(1),
                'conducteur_id' => 1,
                'statut' => 'en cours',
                'vehicule_id' => 1,
                'prix'=>500,
                'nombre_places'=> 4
            ],
            [
                'point_depart' => 'dakar Centre',
                'point_arrivee' => 'Almadies',
                'date_depart' => now()->addDays(3),
                'heure_depart'=> now()->addDays(3),
                'conducteur_id' => 2,
                'statut' => 'terminer',
                'vehicule_id'=>2,
                'prix'=>500,
                'nombre_places'=> 4
                ],
        ];

        foreach ($trajets as $trajetData) {
            Trajet::create($trajetData);
        }
    }
}
