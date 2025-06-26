<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\GeneralMessageNotification;
use Illuminate\Notifications\DatabaseNotification;

class Notfications extends Controller
{
    // public function index()
    // {
    //     // Inbox: Laravel stores received notifications automatically
    //     // $inbox = auth()->user()->unreadNotifications;
    //     $user = auth()->user();
    //     // All inbox messages (read + unread)
    //     $inboxNotifications = DatabaseNotification::where('notifiable_id', $user->id)
    //         ->latest()->get();
    //     // Sent: You must track it separately
    //     $sentNotifications = DatabaseNotification::whereJsonContains('data->sender_id', auth()->id())->latest()->get();

    //     return view('notifications.index', compact('inboxNotifications', 'sentNotifications'));
    // }

    public function index()
    {
        $user = auth()->user();

        return view('notifications.index', [
            'inboxNotifications' => $user->notifications()->latest()->paginate(5),
            'sentNotifications' => DatabaseNotification::where('data->sender_id', $user->id)->latest()->paginate(5),
        ]);
    }

    public function show($id)
    {
        $notification = DatabaseNotification::findOrFail($id);

        $senderId = $notification->data['sender_id'] ?? null;
        $sender = $senderId ? User::find($senderId) : null;

        $recipient = User::find($notification->notifiable_id);

        $isAuthorized = auth()->id() === ($sender?->id) || auth()->id() === ($recipient?->id);

        if (! $isAuthorized) {
            abort(403, 'Unauthorized');
        }

        return view('notifications.show', compact('notification', 'sender', 'recipient'));
    }

    public function create()
    {
        $users = User::where('id', '!=', auth()->id())->get(); // All other users
        return view('notifications.compose', compact('users'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        $recipient = User::findOrFail($request->recipient_id);

        // Send notification
        $recipient->notify(new GeneralMessageNotification(
            auth()->user()->id, // sender_id
            $request->message
        ));

        return redirect()->route('notifications.index')->with('success', 'Message sent successfully!');
    }

    public function markAllAsRead(Request $request)
    {
        $user = auth()->user();

        $user->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'All notifications marked as read!');
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);

        if ($notification->read_at === null) {
            $notification->markAsRead();
        }

        return back()->with('success', 'Notification marked as read.');
    }
}
