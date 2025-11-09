<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ServiceRequestStatusNotification extends Notification
{
    use Queueable;

    protected $serviceRequest;
    protected $message;

    public function __construct($serviceRequest, $message)
    {
        $this->serviceRequest = $serviceRequest;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'request_id' => $this->serviceRequest->id,
            'company_id' => $this->serviceRequest->company_id,
            'status' => $this->serviceRequest->status,
        ];
    }
}
