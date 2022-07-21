<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Isep Lutpi Nur',
                'whatsapp' => NULL,
                'telepon' => NULL,
                'foto' => NULL,
                'profesi' => NULL,
                'bio' => NULL,
                'role' => 'admin',
                'angkatan' => NULL,
                'date_of_birth' => NULL,
                'email' => 'administrator@gmail.com',
                'gender' => NULL,
                'username' => NULL,
                'email_verified_at' => NULL,
                'password' => '$2y$10$tNi0lfqyf.ri9elaAFGIDeFLmEbX3ZiyqRZdYdmMNDjCrX8PVqK1u',
                'active' => 1,
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => NULL,
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'created_at' => '2022-07-21 17:33:08',
                'updated_at' => '2022-07-21 17:33:08',
            ),
        ));
        
        
    }
}