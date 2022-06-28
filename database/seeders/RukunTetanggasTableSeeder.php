<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RukunTetanggasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rukun_tetanggas')->delete();
        
        \DB::table('rukun_tetanggas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Rt 03',
                'nomor' => 3,
                'telepon' => '-',
                'whatsapp' => '-',
                'created_at' => '2022-06-06 06:35:15',
                'updated_at' => '2022-06-06 06:35:15',
            ),
        ));
        
        
    }
}