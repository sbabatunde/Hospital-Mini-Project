<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Appointments as Appoint;

class AppointmentRequestedNotification extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct(Appoint $appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['database']; // In-app only
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'New schedule request by ' . auth()->user()->name,
            'sender_id' => auth()->id(),
            'scheduled_at' => $this->appointment->scheduled_at->toDateTimeString(),
            'appointment_id' => $this->appointment->id,
        ];
    }
}
