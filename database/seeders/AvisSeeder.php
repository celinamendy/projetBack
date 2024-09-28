<?php

namespace Database\Seeders;
use App\Models\Avis;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AvisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $avis = [
            [
                'user_id' => 1, // Assurez-vous que ces IDs existent
                'trajet_id' => 1,
                'commentaire' => 'Très bon trajet, conducteur agréable.',
                'note' => 5,
                'date' => '2024-09-20',
            ],
            [
                'user_id' => 2,
                'trajet_id' => 2,
                'commentaire' => 'Voyage correct mais peut être amélioré.',
                'note' => 3,
                'date' => '2024-09-21',
            ],
        ];

        foreach ($avis as $avisData) {
            Avis::create($avisData);
        }

    }
}
