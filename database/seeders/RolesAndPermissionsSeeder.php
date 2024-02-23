<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

            // Create roles
            $adminRole = Role::create(['name' => 'admin']);
            $userRole = Role::create(['name' => 'user']);

            // Create permissions
            $viewUsersPermission = Permission::create(['name' => 'view users']);
            $manageUsersPermission = Permission::create(['name' => 'manage users']);
            $viewFlightsPermission = Permission::create(['name' => 'view flights']);
            $manageFlightsPermission = Permission::create(['name' => 'manage flights']);

            // Assign permissions to roles
            $adminRole->givePermissionTo($manageUsersPermission, $manageFlightsPermission);
            $userRole->givePermissionTo($viewUsersPermission, $viewFlightsPermission);

        
}
}
