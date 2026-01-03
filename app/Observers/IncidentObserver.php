<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Incident;
use App\Notifications\NewIncidentReported;
use Illuminate\Support\Facades\Notification;

class IncidentObserver
{
    /**
     * Handle the Incident "created" event.
     */
    public function created(Incident $incident): void
    {
        // 1. Get the company ID of the newly created incident
        $companyId = $incident->company_id;

        // 2. Find all users belonging to this company
        // We assume your User model has a 'company_id' column
        $notifiableUsers = User::where('company_id', $companyId)->get();

        // 3. Send the notification to all found users
        Notification::send($notifiableUsers, new NewIncidentReported($incident));
    }

    // You can remove or leave other placeholder methods like updated, deleted, etc.
}