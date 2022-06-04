<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Isep Lutpi Nur',
            'email' => 'administrator@gmail.com',
            'password' => bcrypt('123456'),
            'role' => User::ROLE_ADMINISTRATOR,
            'active' => '1'
        ]);
    }
}
