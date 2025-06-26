<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Appointments as Appoint;

class AppointmentUpdatedNotification extends Notification
{
    use Queueable;

    public $appointment;
    public $action; // e.g., "approved", "completed", "updated"

    public function __construct(Appoint $appointment, $action = 'updated')
    {
        $this->appointment = $appointment;
        $this->action = $action;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Your schedule request with Dr. {$this->appointment->doctor->name} has been {$this->action}.",
            'sender_id' => auth()->id(),
            'appointment_id' => $this->appointment->id,
            'scheduled_at' => $this->appointment->scheduled_at,
            'status' => $this->appointment->status,
        ];
    }
}
