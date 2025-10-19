<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',

            'view users',
            'create users',
            'edit users',
            'delete users',

            'view companies',
            'view company detail',
            'drop company',
            'freeze/unfreeze company',
            'view company doc',
            
            'view companies request',
            'view company request detail',
            'verify company request',
            'view company request doc',

            'access guard app'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }
}
