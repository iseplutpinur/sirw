<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PenduduksPeristiwaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('penduduks_peristiwa')->delete();
        
        \DB::table('penduduks_peristiwa')->insert(array (
            0 => 
            array (
                'id' => 1,
                'penduduk_id' => 12,
                'tanggal' => '2000-08-10',
                'keterangan' => NULL,
                'peristiwa' => 1,
                'created_at' => '2022-07-01 09:01:24',
                'updated_at' => '2022-07-01 09:01:24',
            ),
            1 => 
            array (
                'id' => 7,
                'penduduk_id' => 12,
                'tanggal' => '2000-10-08',
                'keterangan' => NULL,
                'peristiwa' => 4,
                'created_at' => '2022-07-01 11:35:24',
                'updated_at' => '2022-07-01 11:35:24',
            ),
            2 => 
            array (
                'id' => 8,
                'penduduk_id' => 1,
                'tanggal' => '2000-08-10',
                'keterangan' => NULL,
                'peristiwa' => 1,
                'created_at' => '2022-07-01 11:35:47',
                'updated_at' => '2022-07-01 11:35:47',
            ),
            3 => 
            array (
                'id' => 9,
                'penduduk_id' => 2,
                'tanggal' => '2000-08-10',
                'keterangan' => NULL,
                'peristiwa' => 1,
                'created_at' => '2022-07-01 11:35:51',
                'updated_at' => '2022-07-01 11:35:51',
            ),
            4 => 
            array (
                'id' => 10,
                'penduduk_id' => 3,
                'tanggal' => '2000-08-10',
                'keterangan' => NULL,
                'peristiwa' => 1,
                'created_at' => '2022-07-01 11:35:54',
                'updated_at' => '2022-07-01 11:35:54',
            ),
            5 => 
            array (
                'id' => 11,
                'penduduk_id' => 4,
                'tanggal' => '2000-08-10',
                'keterangan' => NULL,
                'peristiwa' => 1,
                'created_at' => '2022-07-01 11:35:58',
                'updated_at' => '2022-07-01 11:35:58',
            ),
            6 => 
            array (
                'id' => 12,
                'penduduk_id' => 5,
                'tanggal' => '2000-08-10',
                'keterangan' => NULL,
                'peristiwa' => 1,
                'created_at' => '2022-07-01 11:36:01',
                'updated_at' => '2022-07-01 11:36:01',
            ),
        ));
        
        
    }
}