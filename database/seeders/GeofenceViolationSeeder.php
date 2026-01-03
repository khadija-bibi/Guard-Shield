<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Notifications\GeofenceViolation;
use Illuminate\Support\Facades\Notification;

class GeofenceViolationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Identify the employee who triggered the violation
        $violatingEmployeeId = 9; 
        $violatingEmployee = User::find($violatingEmployeeId);

        if (!$violatingEmployee) {
            echo "Error: Employee with ID {$violatingEmployeeId} not found. Cannot proceed with geofence alert seeding.\n";
            return;
        }

        $companyId = $violatingEmployee->company_id;

        // 2. Find all notifiable users (all users in the same company, excluding the violator)
        $notifiableUsers = User::where('company_id', $companyId)
                            ->where('id', '!=', $violatingEmployeeId) 
                            ->get();

        if ($notifiableUsers->isEmpty()) {
            echo "Warning: No other users found in Company ID {$companyId} to notify about the geofence violation.\n";
            return;
        }

        // 3. Send the notification to the target users
        Notification::send($notifiableUsers, new GeofenceViolation($violatingEmployee));

        echo "Geofence violation alert successfully seeded for employee {$violatingEmployee->name} (ID: {$violatingEmployeeId}). Notifications sent to " . $notifiableUsers->count() . " users in Company ID {$companyId}.\n";
    }
}