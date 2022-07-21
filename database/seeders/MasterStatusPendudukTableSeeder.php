<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterStatusPendudukTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('master_status_penduduk')->delete();
        
        \DB::table('master_status_penduduk')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Penduduk Tetap',
                'singkatan' => 'Tetap',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-07-21 20:41:18',
                'updated_at' => '2022-07-21 20:41:18',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Penduduk Tidak Tetap',
                'singkatan' => 'Tdk.tetap',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-07-21 20:41:32',
                'updated_at' => '2022-07-21 20:41:32',
            ),
        ));
        
        
    }
}