<?php
namespace App\Http\Controllers;

use App\Models\Notification; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    // public function index()
    // {
    //     $userId = Auth::id();
    //     $notifications = Notification::where('user_id', $userId)->get();

    //     return response()->json([
    //         'status' => true,
    //         'data' => $notifications,
    //     ], 200);
    // }
    public function index()
{
    return $this->getAllNotifications(); 
}

    public function getAllNotifications()
    {
        // récuperer toutes les notifications
        $notifications = Notification:: all();

        // Retourner les notifications
        return response()->json([
            'status' => true,
            'data' => $notifications
        ], 200);
    }

    public function markAsRead($id)
    {
        $notification = Notification::find($id);

       // if ($notification && $notification->user_id == auth()->id()) 
        if ($notification && $notification->user_id == Auth::id()) {

            $notification->statut = 'lue';
            $notification->save();

            return response()->json(['message' => 'Notification marquée comme lue'], 200);
        }

        return response()->json(['message' => 'Notification non trouvée ou accès refusé'], 404);
    }
}
