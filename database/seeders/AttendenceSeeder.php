<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('attendence')->insert([
            'employee_id' => 1,
            'clock_in' => Carbon::parse('2025-12-08 09:00:00'),
            'clock_out' => Carbon::parse('2025-12-08 17:00:00'),
            'working_hours' => 8.00,
            'overtime_hours' => 0.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
