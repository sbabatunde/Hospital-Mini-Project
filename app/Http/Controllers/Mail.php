<?php

namespace App\Http\Controllers;

use App\Models\DoctorsMail;
use Illuminate\Http\Request;

class Mail extends Controller
{
    public function sendMail(Request $req)
    {
        $req->validate([
            'receiver_id' => 'required|exists:users,id',
            'subject' => 'required|string',
            'message' => 'required|string'
        ]);

        DoctorsMail::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $req->receiver_id,
            'subject' => $req->subject,
            'message' => $req->message,
        ]);

        // Optional: Send external mail
        \Mail::to(User::find($req->receiver_id)->email)->send(new \App\Mail\GeneralMail($req->subject, $req->message));

        return response()->json(['message' => 'Mail sent']);
    }

    public function inbox()
    {
        return DoctorsMail::where('receiver_id', auth()->id())->get();
    }

    public function sent()
    {
        return DoctorsMail::where('sender_id', auth()->id())->get();
    }
}
