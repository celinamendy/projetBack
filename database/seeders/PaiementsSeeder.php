<?php

namespace Database\Seeders;
use App\Models\Paiement;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaiementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paiements = [
            [
                'reservation_id' => 1, // Assurez-vous que ces IDs existent
                'montant' => 500,
                'date_paiement' => now(),
            ],
            [
                'reservation_id' => 2,
                'montant' => 500,
                'date_paiement' => now(),
            ],
        ];

        foreach ($paiements as $paiementData) {
            Paiement::create($paiementData);
        }
    }
}
