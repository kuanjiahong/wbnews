<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = User::factory()->create([
            'name'=> 'Admin',
            'email'=> 'admin@example.com',
        ]);
        //Assign User to Role
        $admin->assignRole('admin');
    }
}
