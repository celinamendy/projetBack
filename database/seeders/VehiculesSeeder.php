<?php

namespace Database\Seeders;
use App\Models\Vehicule;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VehiculesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicules = [
            [
                'marque' => 'Toyota',
                'modele' => 'Corolla',
                'couleur' => 'blanc',
                'immatriculation' => 'ABC1234',
                'conducteur_id' => 1,
                'nombre_place'=> 4,
                'Assurance_vehicule'=> 'Assurance A',
                'photo' => 'path_to_photo_file'
            ],
            [
                'marque' => 'Peugeot',
                'modele' => '208',
                'couleur' => 'blanc',
                'immatriculation' => 'XYZ5678',
                'conducteur_id' => 2,
                'nombre_place' => 7,
                'assurance_vehicule' => 'Assurance B',
                'photo' => 'path_to_photo_file'
            ],
        ];

        foreach ($vehicules as $vehiculeData) {
            Vehicule::create($vehiculeData);
        }
    }
}
