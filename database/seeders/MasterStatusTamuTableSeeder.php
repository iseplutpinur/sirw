<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterStatusTamuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('master_status_tamu')->delete();
        
        \DB::table('master_status_tamu')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Ngekost',
                'singkatan' => 'Kost',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 04:01:35',
                'updated_at' => '2022-06-06 04:01:35',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Tamu',
                'singkatan' => 'Tamu',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 04:01:46',
                'updated_at' => '2022-06-06 04:01:46',
            ),
        ));
        
        
    }
}