<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KartuKeluargasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('kartu_keluargas')->delete();
        
        \DB::table('kartu_keluargas')->insert(array (
            0 => 
            array (
                'id' => 3,
                'no' => '1111111111111111',
                'alamat' => '1',
                'rt_id' => 1,
                'foto' => '111111111111111120220628145419.png',
                'created_at' => '2022-06-28 13:37:20',
                'updated_at' => '2022-06-28 14:54:19',
            ),
        ));
        
        
    }
}