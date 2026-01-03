<?php

namespace App\Notifications;

use App\Models\Incident;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NewIncidentReported extends Notification
{
    use Queueable;

    protected $incident;

    /**
     * Create a new notification instance.
     */
    public function __construct(Incident $incident)
    {
        $this->incident = $incident;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // We'll use the 'database' channel as per your database table structure
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        $reporterName = $this->incident->user->name ?? 'A user';
        $message = "{$reporterName} has reported a new incident to your company.";
        return [
            'incident_id' => $this->incident->id,
            'description' => $this->incident->description,
            'submitted_by_user_name' => $reporterName,
            'company_id' => $this->incident->company_id,
            'message' => $message,
        ];
    }
}