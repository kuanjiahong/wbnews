<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name'=>'delete user',]);

        Permission::create(['name'=>'publish article',]);
        Permission::create(['name'=>'unpublish article',]);

        Permission::create(['name'=>'view article']);
    }
}
