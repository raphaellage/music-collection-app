<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create albums']);
        Permission::create(['name' => 'edit albums']);
        Permission::create(['name' => 'delete albums']);

        $user = Role::create(['name' => 'user']);
        $admin = Role::create(['name' => 'admin']);

        $user->syncPermissions(['create albums', 'edit albums']);
        $admin->syncPermissions(Permission::all());
    }
}
