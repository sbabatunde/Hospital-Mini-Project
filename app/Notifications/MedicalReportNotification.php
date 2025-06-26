<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\MedicalHistory;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MedicalReportNotification extends Notification
{
    use Queueable;

    public $report;

    public function __construct(MedicalHistory $report)
    {
        $this->report = $report;
    }

    public function via($notifiable)
    {
        return ['database']; // In-app only
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'A new medical report has been added by Dr. ' . optional($this->report->doctor)->name,
            'title' => $this->report->title,
            'report_id' => $this->report->id,
            'added_at' => now()->toDateTimeString(),
            'sender_id' => auth()->id(),
        ];
    }
}
