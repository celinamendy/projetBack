<?php

namespace Database\Seeders;
use App\Models\Reservation;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservations = [
            [
                'passager_id' => 1, // Assurez-vous que ces IDs existent
                'trajet_id' => 1,
                'date_heure_reservation' => now(),
                'statut' => 'confirmer'         

            ],
            [
                'passager_id' => 2,
                'trajet_id' => 2,
                'date_heure_reservation' => now(),
                'statut' => 'annuler'        

            ],
        ];

        foreach ($reservations as $reservationData) {
            Reservation::create($reservationData);
        }
    }
}
