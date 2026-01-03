<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Incident;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IncidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Check for prerequisite data to avoid foreign key errors
        // We'll use the user and company IDs specified in your request.
        $submittingUser = User::find(9); // Assuming User ID 1 exists and is the submitter
        $targetCompanyId = 1;          // The company the incident belongs to

        if (!$submittingUser) {
            // This is a safety check. You might need to create a user here
            echo "Warning: User with ID 9 not found. Please run UserSeeder first or adjust the ID.\n";
            return;
        }

        // 2. Create the Incident
        // This creation will automatically trigger the 'created' event,
        // which runs the IncidentObserver and sends the notification.
        Incident::create([
            // This incident is submitted by the user with ID 1 (instead of 0, which is uncommon for IDs)
            'user_id' => $submittingUser->id,
            'company_id' => $targetCompanyId,
            'description' => 'Test Incident: Urgent security breach reported in the main office.',
        ]);

        echo "Incident created successfully! Notifications should now be logged for all users in Company ID: {$targetCompanyId}.\n";
    }
}