<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatusPenduduksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('status_penduduks')->delete();
        
        \DB::table('status_penduduks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Penduduk Tetap',
                'singkatan' => 'Tetap',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:52:14',
                'updated_at' => '2022-06-06 03:59:22',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Penduduk Tidak Tetap',
                'singkatan' => 'Tdk. Tetap',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:52:27',
                'updated_at' => '2022-06-06 03:59:30',
            ),
        ));
        
        
    }
}