<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KartuKeluargaTransaksiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('kartu_keluarga_transaksi')->delete();
        
        
        
    }
}