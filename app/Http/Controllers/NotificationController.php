<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function markAsRead($id){
        $user = Auth::user();
        $notification = $user->notifications()->find($id);
        if($notification){
            $notification->markAsRead();
        }
        return redirect()->back();
    }
    public function markAllAsRead()
    {
        $user = Auth::user();

        // Mark all unread notifications as read
        $user->unreadNotifications->markAsRead();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Semua notifikasi telah dibaca.');
    }
}
