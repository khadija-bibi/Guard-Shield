<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        $this->call(PermissionsSeeder::class);
        $user = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superAdmin@gmail.com',
            'password' => Hash::make('12345678'),
            'user_type' => 'superAdmin',
            'created_by'=> 1
        ]);

        $role = Role::create([
            'name' => 'superAdmin',
            'role_name' => 'Super Admin',
            'guard_name' => 'web',
            'created_by'=>1
        ]);
        $permissions = Permission::whereBetween('id', [1, 17])->get();
        $role->syncPermissions($permissions);

        $user->assignRole($role);

        
    }
}
