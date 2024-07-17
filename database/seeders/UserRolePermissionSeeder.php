<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Permissions
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'update role']);
        Permission::create(['name' => 'delete role']);

        Permission::create(['name' => 'view permission']);
        Permission::create(['name' => 'create permission']);
        Permission::create(['name' => 'update permission']);
        Permission::create(['name' => 'delete permission']);

        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'view trainer']);
        Permission::create(['name' => 'create trainer']);
        Permission::create(['name' => 'update trainer']);
        Permission::create(['name' => 'delete trainer']);

        Permission::create(['name' => 'view admin']);
        Permission::create(['name' => 'create admin']);
        Permission::create(['name' => 'update admin']);
        Permission::create(['name' => 'delete admin']);


        Permission::create(['name' => 'view pos number']);
        Permission::create(['name' => 'create pos number']);
        Permission::create(['name' => 'update pos number']);
        Permission::create(['name' => 'delete pos number']);

        Permission::create(['name' => 'view service note']);

        Permission::create(['name' => 'view monthly attendance']);

        // Create Roles
        $superAdminRole = Role::create(['name' => 'super-admin']); //as super-admin
        $adminRole = Role::create(['name' => 'admin']);

        // Lets give all permission to super-admin role.
        $allPermissionNames = Permission::pluck('name')->toArray();

        $superAdminRole->givePermissionTo($allPermissionNames);

        // Let's give few permissions to admin role.
        $adminRole->givePermissionTo(['create user', 'view user', 'update user']);
        $adminRole->givePermissionTo(['create trainer', 'view trainer', 'update trainer', 'view service note']);


        // Let's Create User and assign Role to it.

        $superAdminUser = User::where([
                    'role' => 'superadmin'
                ])->first();

        $superAdminUser->assignRole($superAdminRole);



    }
}
