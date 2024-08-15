<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['super-admin', 'manager', 'staff', 'user'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role], ['name' => $role]);
        }

        Permission::create(['name' => 'create tasks']);
        Permission::create(['name' => 'read tasks']);
        Permission::create(['name' => 'delete tasks']);
        Permission::create(['name' => 'edit tasks']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'read users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'edit users']);

        $role = Role::where('name', 'super-admin')->first();

        $role->givePermissionTo(['create tasks', 'read tasks', 'delete tasks', 'edit tasks', 'create users', 'read users', 'delete users', 'edit users']);

        $user = User::find(1);
        $user->assignRole($role);

    }
}
