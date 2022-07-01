<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PenduduksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('penduduks')->delete();
        
        \DB::table('penduduks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Ketua Umum',
                'nik' => '211111',
                'asal_data' => 0,
                'agama_id' => 1,
                'pendidikan_id' => 6,
                'pekerjaan_id' => 10,
                'status_kawin_id' => 1,
                'status_penduduk_id' => 1,
                'rt_id' => 1,
                'kota_lahir' => 'cianjur',
                'jenis_kelamin' => 'laki-laki',
                'ada_ktp' => 1,
                'ada_akte' => 1,
                'file_ktp' => 'ketua-umum20220628092352.jpg',
                'file_akte' => 'ketua-umum20220628092352.jpg',
                'alamat_lengkap' => '123',
                'tanggal_lahir' => '2000-08-10',
                'status' => NULL,
                'penduduk_negara' => 1,
                'negara_asal' => NULL,
                'created_at' => '2022-06-28 09:23:52',
                'updated_at' => '2022-07-01 11:27:29',
            ),
            1 => 
            array (
                'id' => 2,
                'nama' => 'Isep Lutpi Nur',
                'nik' => '211111',
                'asal_data' => 0,
                'agama_id' => 1,
                'pendidikan_id' => 1,
                'pekerjaan_id' => 1,
                'status_kawin_id' => 1,
                'status_penduduk_id' => 1,
                'rt_id' => 1,
                'kota_lahir' => 'Cianjur',
                'jenis_kelamin' => 'laki-laki',
                'ada_ktp' => 0,
                'ada_akte' => 0,
                'file_ktp' => NULL,
                'file_akte' => NULL,
                'alamat_lengkap' => 'Bandung',
                'tanggal_lahir' => '2000-08-10',
                'status' => NULL,
                'penduduk_negara' => 1,
                'negara_asal' => NULL,
                'created_at' => '2022-06-28 09:24:28',
                'updated_at' => '2022-07-01 11:35:51',
            ),
            2 => 
            array (
                'id' => 3,
                'nama' => 'Anak',
                'nik' => '211111',
                'asal_data' => 0,
                'agama_id' => 1,
                'pendidikan_id' => 1,
                'pekerjaan_id' => 1,
                'status_kawin_id' => 1,
                'status_penduduk_id' => 1,
                'rt_id' => 1,
                'kota_lahir' => 'cianjur',
                'jenis_kelamin' => 'laki-laki',
                'ada_ktp' => 0,
                'ada_akte' => 0,
                'file_ktp' => NULL,
                'file_akte' => NULL,
                'alamat_lengkap' => 'a',
                'tanggal_lahir' => '2000-08-10',
                'status' => NULL,
                'penduduk_negara' => 1,
                'negara_asal' => NULL,
                'created_at' => '2022-06-28 09:24:45',
                'updated_at' => '2022-07-01 09:35:39',
            ),
            3 => 
            array (
                'id' => 4,
                'nama' => 'Cucu',
                'nik' => '0',
                'asal_data' => 0,
                'agama_id' => 1,
                'pendidikan_id' => 1,
                'pekerjaan_id' => 1,
                'status_kawin_id' => 1,
                'status_penduduk_id' => 1,
                'rt_id' => 1,
                'kota_lahir' => 'cianjur',
                'jenis_kelamin' => 'laki-laki',
                'ada_ktp' => 0,
                'ada_akte' => 0,
                'file_ktp' => NULL,
                'file_akte' => NULL,
                'alamat_lengkap' => 'a',
                'tanggal_lahir' => '2000-08-10',
                'status' => NULL,
                'penduduk_negara' => 1,
                'negara_asal' => NULL,
                'created_at' => '2022-06-28 09:25:10',
                'updated_at' => '2022-07-01 11:35:58',
            ),
            4 => 
            array (
                'id' => 5,
                'nama' => 'Istri',
                'nik' => NULL,
                'asal_data' => 0,
                'agama_id' => 1,
                'pendidikan_id' => 1,
                'pekerjaan_id' => 1,
                'status_kawin_id' => 1,
                'status_penduduk_id' => 1,
                'rt_id' => 1,
                'kota_lahir' => 'cianjur',
                'jenis_kelamin' => 'laki-laki',
                'ada_ktp' => 0,
                'ada_akte' => 0,
                'file_ktp' => NULL,
                'file_akte' => NULL,
                'alamat_lengkap' => 'a',
                'tanggal_lahir' => '2000-08-10',
                'status' => NULL,
                'penduduk_negara' => 1,
                'negara_asal' => NULL,
                'created_at' => '2022-06-28 09:25:56',
                'updated_at' => '2022-07-01 11:36:01',
            ),
            5 => 
            array (
                'id' => 12,
                'nama' => 'Pengaturan',
                'nik' => '211111',
                'asal_data' => 1,
                'agama_id' => 1,
                'pendidikan_id' => 1,
                'pekerjaan_id' => 1,
                'status_kawin_id' => 1,
                'status_penduduk_id' => 1,
                'rt_id' => 1,
                'kota_lahir' => 'cianjur',
                'jenis_kelamin' => 'laki-laki',
                'ada_ktp' => 0,
                'ada_akte' => 0,
                'file_ktp' => NULL,
                'file_akte' => NULL,
                'alamat_lengkap' => '123',
                'tanggal_lahir' => '2000-08-10',
                'status' => NULL,
                'penduduk_negara' => 1,
                'negara_asal' => NULL,
                'created_at' => '2022-07-01 09:01:24',
                'updated_at' => '2022-07-01 11:35:24',
            ),
        ));
        
        
    }
}