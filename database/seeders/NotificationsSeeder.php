<?php

namespace Database\Seeders;
use App\Models\Notification;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notifications = [
            [
               'user_id' => 1,
                'message' => 'Votre trajet a été confirmé.',
                'statut' => 'lue'  // Assurez-vous que 'lu' est une valeur valide pour la colonne statut        

            ],
            [
                'user_id' => 2,
                'message' => 'Votre réservation a été effectuée.',
                'statut' => 'non lue'  // Assurez-vous que 'non lu' est une valeur valide pour la colonne statut
            
            ],
        ];

        foreach ($notifications as $notificationData) {
            Notification::create($notificationData);
        }
    }
}
