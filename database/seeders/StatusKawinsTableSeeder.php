<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatusKawinsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('status_kawins')->delete();
        
        \DB::table('status_kawins')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Kawin',
                'singkatan' => 'KW',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:58:53',
                'updated_at' => '2022-06-06 03:58:53',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Belum Kawin',
                'singkatan' => 'BK',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:59:04',
                'updated_at' => '2022-06-06 03:59:04',
            ),
        ));
        
        
    }
}