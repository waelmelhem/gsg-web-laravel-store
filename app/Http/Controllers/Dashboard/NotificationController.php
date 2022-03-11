<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function read($id)
    {
        $user=Auth::user();
        // dd($id);
        $notification=$user->notifications()->findOrFail($id);
        // dd($notification);
        if($notification->unread())
        $notification->markAsRead();
        return redirect()->to($notification->data['url']);
    }
}
