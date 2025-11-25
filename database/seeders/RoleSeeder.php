<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
// use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create([
            'name' => 'Super Admin',
        ]);
        $admin = Role::create([
            'name' => 'Admin',
        ]);
        
        $superAdmin->givePermissionTo(Permission::all());    
        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'view-user',
        ]);
    }
}
