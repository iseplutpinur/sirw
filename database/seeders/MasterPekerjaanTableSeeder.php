<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterPekerjaanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('master_pekerjaan')->delete();
        
        \DB::table('master_pekerjaan')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Tidak Bekerja',
                'singkatan' => 'Tidak Bekerja',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:54:04',
                'updated_at' => '2022-06-06 03:54:04',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Ibu rumah Tangga',
                'singkatan' => 'IRT',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:54:14',
                'updated_at' => '2022-06-06 03:54:14',
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'Buruh',
                'singkatan' => 'Buruh',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:54:22',
                'updated_at' => '2022-06-06 03:54:22',
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'Pegawai Negeri Sipil',
                'singkatan' => 'PNS',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:54:31',
                'updated_at' => '2022-06-06 03:54:31',
            ),
            4 => 
            array (
                'id' => 5,
                'nama' => 'ABRI/POLRI',
                'singkatan' => 'ABRI/POLRI',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:54:41',
                'updated_at' => '2022-06-06 03:54:41',
            ),
            5 => 
            array (
                'id' => 6,
                'nama' => 'Pegawai Swasta',
                'singkatan' => 'PS',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:54:52',
                'updated_at' => '2022-06-06 03:54:52',
            ),
            6 => 
            array (
                'id' => 7,
                'nama' => 'Petani',
                'singkatan' => 'Tani',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:54:58',
                'updated_at' => '2022-06-06 03:54:58',
            ),
            7 => 
            array (
                'id' => 8,
                'nama' => 'Pedagang',
                'singkatan' => 'Dagang',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:55:08',
                'updated_at' => '2022-06-06 03:55:08',
            ),
            8 => 
            array (
                'id' => 9,
                'nama' => 'Pelajar',
                'singkatan' => 'Pelajar',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:55:15',
                'updated_at' => '2022-06-06 03:55:15',
            ),
            9 => 
            array (
                'id' => 10,
                'nama' => 'Mahasiswa',
                'singkatan' => 'Mahasiswa',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:55:20',
                'updated_at' => '2022-06-06 03:55:20',
            ),
            10 => 
            array (
                'id' => 11,
                'nama' => 'Pensiunan',
                'singkatan' => 'Pensiunan',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:55:27',
                'updated_at' => '2022-06-06 03:55:27',
            ),
            11 => 
            array (
                'id' => 12,
                'nama' => 'Pra Sekolah',
                'singkatan' => 'Pra Sekolah',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:55:37',
                'updated_at' => '2022-06-06 03:55:37',
            ),
            12 => 
            array (
                'id' => 13,
                'nama' => 'Lainnya',
                'singkatan' => 'Lainnya',
                'keterangan' => NULL,
                'status' => 1,
                'created_at' => '2022-06-06 03:55:58',
                'updated_at' => '2022-06-06 03:55:58',
            ),
        ));
        
        
    }
}