<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::query()->where(['user_id' => Auth::id()])->latest('created_at')->get();
        //Notification::query()->where(['user_id' => Auth::id(), 'is_read' => false])->update(['is_read' => true]);
        if (Notification::query()->where(['user_id' => Auth::id(), 'is_read' => false])->update(['is_read' => true])) {
            Cache::forget('total_unread_notification' . Auth::id());
        }

        return view('core.notification', compact('notifications'));
    }
}
