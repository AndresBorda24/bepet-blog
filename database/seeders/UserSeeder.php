<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Andres Borda',
            'email' => 'anjart24@gmail.com',
            'password' => bcrypt('andres123'),
            'role_id' => \App\Models\Role::IS_ADMIN,
            'avatar_id' => 1,
        ]);

        \App\Models\User::create([
            'name' => 'Elizanbeth Oslen',
            'email' => 'oslen24@gmail.com',
            'password' => bcrypt('andres123'),
            'role_id' => \App\Models\Role::IS_MANAGER,
            'avatar_id' => 2,
        ]);

        \App\Models\User::create([
            'name' => 'Lina Holmes',
            'email' => 'holmes24@gmail.com',
            'password' => bcrypt('andres123'),
            'role_id' => \App\Models\Role::IS_USER,
            'avatar_id' => 3,
        ]);
        \App\Models\User::factory(10)->create();
    }
}
