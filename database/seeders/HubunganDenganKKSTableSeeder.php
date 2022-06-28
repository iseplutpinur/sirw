<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HubunganDenganKKSTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('hubungan_dengan_k_k_s')->delete();
        
        \DB::table('hubungan_dengan_k_k_s')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Kepala Keluarga',
                'singkatan' => 'KK',
                'keterangan' => NULL,
                'urut' => 1,
                'status' => 1,
                'created_at' => '2022-06-06 03:59:48',
                'updated_at' => '2022-06-28 09:05:21',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Anak',
                'singkatan' => 'Anak',
                'keterangan' => NULL,
                'urut' => 4,
                'status' => 1,
                'created_at' => '2022-06-06 03:59:57',
                'updated_at' => '2022-06-28 09:05:51',
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'Istri',
                'singkatan' => 'Istri',
                'keterangan' => NULL,
                'urut' => 3,
                'status' => 1,
                'created_at' => '2022-06-06 04:00:10',
                'updated_at' => '2022-06-28 09:05:45',
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'Cucu',
                'singkatan' => 'Cucu',
                'keterangan' => NULL,
                'urut' => 5,
                'status' => 1,
                'created_at' => '2022-06-06 04:00:28',
                'updated_at' => '2022-06-28 09:05:57',
            ),
            4 => 
            array (
                'id' => 5,
                'nama' => 'Suami',
                'singkatan' => 'Suami',
                'keterangan' => NULL,
                'urut' => 2,
                'status' => 1,
                'created_at' => '2022-06-06 04:00:46',
                'updated_at' => '2022-06-28 09:05:38',
            ),
        ));
        
        
    }
}