<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleandPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //Create role
        $adminRole = Role::create(['name' => 'admin']);
        $writerRole = Role::create(['name' => 'writer']);
        $viewerRole = Role::create(['name' => 'viewer']);

        //Create Permission
        Permission::create(['name'=>'delete user',]);
        Permission::create(['name'=>'publish article',]);
        Permission::create(['name'=>'unpublish article',]);
        Permission::create(['name'=>'view article']);

        //Assign Role to Permission
        $adminPermissions = Permission::pluck('name');
        $adminRole->syncPermissions($adminPermissions);

        $writerRole->givePermissionTo('publish article');
        $writerRole->givePermissionTo('unpublish article');

        $viewerRole->givePermissionTo('view article');

    }
}
