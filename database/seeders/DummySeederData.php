<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DummySeederData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'users']);
        Permission::create(['name' => 'lists']);

        $user = Role::create(['name' => 'Super-Admin']);
        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo('lists');

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('lists');
        $admin->givePermissionTo('users');
    }
}
