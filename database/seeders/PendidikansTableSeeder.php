<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PendidikansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pendidikans')->delete();
        
        \DB::table('pendidikans')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Tidak/Belum Sekolah',
                'singkatan' => 'Tdk Sekolah',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:56:24',
                'updated_at' => '2022-06-06 03:56:24',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Tidak Tamat SD',
                'singkatan' => 'Tdk tmt SD',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:56:48',
                'updated_at' => '2022-06-06 03:56:48',
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'Belum Tamat SD',
                'singkatan' => 'blm tmt SD',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:57:11',
                'updated_at' => '2022-06-06 03:57:11',
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'Tamat SD',
                'singkatan' => 'Tamat SD',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:57:22',
                'updated_at' => '2022-06-06 03:57:22',
            ),
            4 => 
            array (
                'id' => 5,
                'nama' => 'Sekolah Lanjut Pertama',
                'singkatan' => 'SLP',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:57:37',
                'updated_at' => '2022-06-06 03:57:37',
            ),
            5 => 
            array (
                'id' => 6,
                'nama' => 'Sekolah Lanjut Atas',
                'singkatan' => 'SLA',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:57:46',
                'updated_at' => '2022-06-06 03:57:46',
            ),
            6 => 
            array (
                'id' => 7,
                'nama' => 'Akademi/Sarjana Muda',
                'singkatan' => 'AMD',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:58:03',
                'updated_at' => '2022-06-06 03:58:03',
            ),
            7 => 
            array (
                'id' => 8,
                'nama' => 'Sarjana/Pascasarjana',
                'singkatan' => 'Strata',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:58:23',
                'updated_at' => '2022-06-06 03:58:23',
            ),
        ));
        
        
    }
}