<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KartuKeluargaListsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('kartu_keluarga_lists')->delete();
        
        \DB::table('kartu_keluarga_lists')->insert(array (
            0 => 
            array (
                'id' => 8,
                'penduduk_id' => 1,
                'kartu_keluarga_id' => 3,
                'hubungan_dengan_kk_id' => 1,
                'created_at' => '2022-06-28 14:53:27',
                'updated_at' => '2022-06-28 14:53:27',
            ),
            1 => 
            array (
                'id' => 9,
                'penduduk_id' => 2,
                'kartu_keluarga_id' => 3,
                'hubungan_dengan_kk_id' => 2,
                'created_at' => '2022-06-28 14:53:34',
                'updated_at' => '2022-06-28 14:53:34',
            ),
            2 => 
            array (
                'id' => 10,
                'penduduk_id' => 4,
                'kartu_keluarga_id' => 3,
                'hubungan_dengan_kk_id' => 3,
                'created_at' => '2022-06-28 14:53:39',
                'updated_at' => '2022-06-28 14:53:39',
            ),
        ));
        
        
    }
}