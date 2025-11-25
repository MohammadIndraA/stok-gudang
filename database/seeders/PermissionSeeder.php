<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view-role',
            'create-role',
            'edit-role',
            'delete-role',
            'view-user',
            'create-user',
            'edit-user',
            'delete-user',
            'view-aplikator',
            'create-aplikator',
            'edit-aplikator',
            'delete-aplikator',

         ];
          // Looping and Inserting Array's Permissions into Permission Table
          foreach ($permissions as $permission) {
            Permission::create([
              'name' => $permission]
            );
          }
    }
}
