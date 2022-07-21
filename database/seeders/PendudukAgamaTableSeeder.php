<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PendudukAgamaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('penduduk_agama')->delete();
        
        
        
    }
}