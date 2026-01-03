<?php
namespace App\Notifications;

use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ServiceRequestStatusNotification extends Notification
{
    use Queueable;

    protected Request $request;
    protected string $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(Request $request, string $message)
    {
        $this->request = $request;
        $this->message = $message;
    }

    /**
     * Delivery channels (we are using database)
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Data stored in notifications table
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'request_id'   => $this->request->id,
            'requester_id' => $this->request->user_id,
            'company_id'   => $this->request->company_id,
            'status'       => $this->request->status,
            'message'      => $this->message,
        ];
    }
}
