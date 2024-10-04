<?php

namespace App\Trait;

use App\Models\Notification;

trait AvisNotification
{
     /**
     * Créer une notification lors de la création d'un avis.
     *
     * @param  \App\Models\Avis  $avis
     * @return void
     */
    public function createAvisNotification($avis)
    {
        // Créer et sauvegarder une notification
        $notification = new Notification();
        $notification->user_id = $avis->user_id;
        $notification->avis_id = $avis->id;
        $notification->commentaire = $avis->commentaire;
        $notification->note = $avis->note;
        $notification->created_at = now();
        $notification->save();
    }
}
