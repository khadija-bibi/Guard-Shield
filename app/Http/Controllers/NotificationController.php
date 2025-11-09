<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    // Fetch unread notifications
    public function fetch()
    {
        $notifications = auth()->user()->notifications()->latest()->take(5)->get();
       Log::info($notifications);
        return response()->json([
            'notifications' => $notifications
        ]);
    }

    public function markAsRead()
    {
        auth()->user()->unreadNotifications()->update(['read_at' => now()]);
        return response()->json(['success' => true]);
    }

}
