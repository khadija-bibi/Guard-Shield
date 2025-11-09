<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Incident;
use App\Models\User;
use App\Models\Company;

class IncidentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Agar tumhare paas users aur companies pehle se hain
        $users = User::pluck('id')->toArray();
        $companies = Company::pluck('id')->toArray();

        // Check to avoid error if tables are empty
        if (empty($users) || empty($companies)) {
            $this->command->warn('⚠️ Please seed Users and Companies first!');
            return;
        }

        // 10 fake incidents create karo
        for ($i = 0; $i < 10; $i++) {
            Incident::create([
                'user_id' => $users[array_rand($users)],
                'company_id' => $companies[array_rand($companies)],
                'description' => fake()->sentence(10),
            ]);
        }

        $this->command->info('✅ 10 incidents added successfully!');
    }
}
