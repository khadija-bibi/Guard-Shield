<?php

namespace Database\Seeders;

use App\Models\AreaZone;
use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example Locations
        $karachi = Location::create(['name' => 'Karachi']);
        $lahore  = Location::create(['name' => 'Lahore']);
        $islamabad = Location::create(['name' => 'Islamabad']);

        // Karachi Zones
        AreaZone::create(['name' => 'Defence', 'location_id' => $karachi->id]);
        AreaZone::create(['name' => 'Gulshan-e-Iqbal', 'location_id' => $karachi->id]);

        // Lahore Zones
        AreaZone::create(['name' => 'Model Town', 'location_id' => $lahore->id]);
        AreaZone::create(['name' => 'Johar Town', 'location_id' => $lahore->id]);

        // Islamabad Zones
        AreaZone::create(['name' => 'Blue Area', 'location_id' => $islamabad->id]);
        AreaZone::create(['name' => 'F-7 Sector', 'location_id' => $islamabad->id]);
    }
}
