<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterAgamaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('master_agama')->delete();
        
        \DB::table('master_agama')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Islam',
                'singkatan' => 'Islam',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:53:06',
                'updated_at' => '2022-06-06 03:53:06',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Kristen',
                'singkatan' => 'Kristen',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:53:12',
                'updated_at' => '2022-06-06 03:53:12',
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'Katholik',
                'singkatan' => 'Katholik',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:53:18',
                'updated_at' => '2022-06-06 03:53:18',
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'Hindu',
                'singkatan' => 'Hindu',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:53:24',
                'updated_at' => '2022-06-06 03:53:24',
            ),
            4 => 
            array (
                'id' => 5,
                'nama' => 'Budha',
                'singkatan' => 'Budha',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:53:35',
                'updated_at' => '2022-06-06 03:53:35',
            ),
            5 => 
            array (
                'id' => 6,
                'nama' => 'Lain-Lain',
                'singkatan' => 'Lain-Lain',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:53:43',
                'updated_at' => '2022-06-06 03:53:43',
            ),
        ));
        
        
    }
}