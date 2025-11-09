<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewCompanyRequestNotification extends Notification
{
    use Queueable;

    protected $company;
    protected $user;

    public function __construct($company, $user)
    {
        $this->company = $company;
        $this->user = $user;
    }

    // Only database channel
    public function via($notifiable)
    {
        return ['database'];
    }

    // Data stored in notifications table
    public function toDatabase($notifiable)
    {
        return [
            'message' => "{$this->user->name} has submitted a new company request: {$this->company->name}",
            'company_id' => $this->company->id,
            'user_id' => $this->user->id,
        ];
    }
}
