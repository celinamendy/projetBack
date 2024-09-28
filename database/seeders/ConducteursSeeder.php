<?php

namespace Database\Seeders;
use App\Models\Conducteur;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConducteursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conducteurs = [
            [
               'permis_conduire' => '123456789',
                'CIN' => 'C123456',
                'carte_gris' => 'GR123456',
                'user_id' => 1
            ],
            [ 
                'permis_conduire' => '987654321',
                'CIN' => 'C654321',
                'carte_gris' => 'GR654321',
                'user_id' => 2


            ],
        ];

        foreach ($conducteurs as $conducteurData) {
            $conducteur = Conducteur::create($conducteurData);
        }
    }
}
