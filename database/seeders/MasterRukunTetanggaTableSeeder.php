<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterRukunTetanggaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('master_rukun_tetangga')->delete();
        
        \DB::table('master_rukun_tetangga')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Rt 01',
                'nomor' => 1,
                'telepon' => '-',
                'whatsapp' => '-',
                'created_at' => '2022-06-06 06:35:15',
                'updated_at' => '2022-07-21 17:49:37',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Rt 02',
                'nomor' => 2,
                'telepon' => '-',
                'whatsapp' => '-',
                'created_at' => '2022-06-06 06:35:15',
                'updated_at' => '2022-07-21 17:49:37',
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'Rt 03',
                'nomor' => 3,
                'telepon' => '-',
                'whatsapp' => '-',
                'created_at' => '2022-06-06 06:35:15',
                'updated_at' => '2022-07-21 17:49:37',
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'Rt 04',
                'nomor' => 4,
                'telepon' => '-',
                'whatsapp' => '-',
                'created_at' => '2022-06-06 06:35:15',
                'updated_at' => '2022-07-21 17:49:37',
            ),
            4 => 
            array (
                'id' => 5,
                'nama' => 'Rt 05',
                'nomor' => 5,
                'telepon' => '-',
                'whatsapp' => '-',
                'created_at' => '2022-06-06 06:35:15',
                'updated_at' => '2022-07-21 17:49:37',
            ),
            5 => 
            array (
                'id' => 6,
                'nama' => 'Rt 06',
                'nomor' => 6,
                'telepon' => '-',
                'whatsapp' => '-',
                'created_at' => '2022-06-06 06:35:15',
                'updated_at' => '2022-07-21 17:49:37',
            ),
            6 => 
            array (
                'id' => 7,
                'nama' => 'Rt 07',
                'nomor' => 7,
                'telepon' => '-',
                'whatsapp' => '-',
                'created_at' => '2022-06-06 06:35:15',
                'updated_at' => '2022-07-21 17:49:37',
            ),
            7 => 
            array (
                'id' => 8,
                'nama' => 'Rt 08',
                'nomor' => 8,
                'telepon' => '-',
                'whatsapp' => '-',
                'created_at' => '2022-06-06 06:35:15',
                'updated_at' => '2022-07-21 17:49:37',
            ),
            8 => 
            array (
                'id' => 9,
                'nama' => 'Rt 09',
                'nomor' => 9,
                'telepon' => '-',
                'whatsapp' => '-',
                'created_at' => '2022-06-06 06:35:15',
                'updated_at' => '2022-07-21 17:49:37',
            ),
            9 => 
            array (
                'id' => 10,
                'nama' => 'Rt 10',
                'nomor' => 10,
                'telepon' => '-',
                'whatsapp' => '-',
                'created_at' => '2022-06-06 06:35:15',
                'updated_at' => '2022-07-21 17:49:37',
            ),
        ));
        
        
    }
}