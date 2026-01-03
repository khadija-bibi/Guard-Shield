<?php

namespace App\Notifications;

use App\Models\User; // Assuming Employee is represented by the User model
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class GeofenceViolation extends Notification
{
    use Queueable;

    protected $employee;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        // Get the employee's name for the message
        $employeeName = $this->employee->name ?? 'An employee';

        return [
            'employee_id' => $this->employee->id,
            'company_id' => $this->employee->company_id,
            'message' => "Employee {$employeeName} is outside the geofence area.",
        ];
    }
}