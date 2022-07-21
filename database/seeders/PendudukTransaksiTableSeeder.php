<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PendudukTransaksiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('penduduk_transaksi')->delete();
        
        
        
    }
}