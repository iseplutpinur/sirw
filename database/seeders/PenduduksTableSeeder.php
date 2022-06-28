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
                'nik' => '211111',
                'agama_id' => 1,
                'pendidikan_id' => 6,
                'pekerjaan_id' => 10,
                'status_kawin_id' => 1,
                'status_penduduk_id' => 1,
                'rt_id' => 1,
                'nama' => 'Ketua Umum',
                'kota_lahir' => 'cianjur',
                'jenis_kelamin' => 'laki-laki',
                'ada_ktp' => 1,
                'ada_akte' => 1,
                'file_ktp' => 'ketua-umum20220628092352.jpg',
                'file_akte' => 'ketua-umum20220628092352.jpg',
                'alamat_lengkap' => '123',
                'tanggal_lahir' => '2000-08-10',
                'tanggal_mati' => NULL,
                'tanggal_pindah' => NULL,
                'tanggal_datang' => NULL,
                'status_tinggal' => 1,
                'status' => 1,
                'penduduk_negara' => 1,
                'negara_asal' => NULL,
                'created_at' => '2022-06-28 09:23:52',
                'updated_at' => '2022-06-28 09:23:52',
            ),
            1 => 
            array (
                'id' => 2,
                'nik' => '211111',
                'agama_id' => 1,
                'pendidikan_id' => 1,
                'pekerjaan_id' => 1,
                'status_kawin_id' => 1,
                'status_penduduk_id' => 1,
                'rt_id' => 1,
                'nama' => 'Isep Lutpi Nur',
                'kota_lahir' => 'Cianjur',
                'jenis_kelamin' => 'laki-laki',
                'ada_ktp' => 0,
                'ada_akte' => 0,
                'file_ktp' => NULL,
                'file_akte' => NULL,
                'alamat_lengkap' => 'Bandung',
                'tanggal_lahir' => '2000-08-10',
                'tanggal_mati' => NULL,
                'tanggal_pindah' => NULL,
                'tanggal_datang' => NULL,
                'status_tinggal' => 1,
                'status' => 1,
                'penduduk_negara' => 1,
                'negara_asal' => NULL,
                'created_at' => '2022-06-28 09:24:28',
                'updated_at' => '2022-06-28 09:24:28',
            ),
            2 => 
            array (
                'id' => 3,
                'nik' => '211111',
                'agama_id' => 1,
                'pendidikan_id' => 1,
                'pekerjaan_id' => 1,
                'status_kawin_id' => 1,
                'status_penduduk_id' => 1,
                'rt_id' => 1,
                'nama' => 'Anak',
                'kota_lahir' => 'cianjur',
                'jenis_kelamin' => 'laki-laki',
                'ada_ktp' => 0,
                'ada_akte' => 0,
                'file_ktp' => NULL,
                'file_akte' => NULL,
                'alamat_lengkap' => 'a',
                'tanggal_lahir' => '2000-08-10',
                'tanggal_mati' => NULL,
                'tanggal_pindah' => NULL,
                'tanggal_datang' => NULL,
                'status_tinggal' => 1,
                'status' => 1,
                'penduduk_negara' => 1,
                'negara_asal' => NULL,
                'created_at' => '2022-06-28 09:24:45',
                'updated_at' => '2022-06-28 09:24:45',
            ),
            3 => 
            array (
                'id' => 4,
                'nik' => '0',
                'agama_id' => 1,
                'pendidikan_id' => 1,
                'pekerjaan_id' => 1,
                'status_kawin_id' => 1,
                'status_penduduk_id' => 1,
                'rt_id' => 1,
                'nama' => 'Cucu',
                'kota_lahir' => 'cianjur',
                'jenis_kelamin' => 'laki-laki',
                'ada_ktp' => 0,
                'ada_akte' => 0,
                'file_ktp' => NULL,
                'file_akte' => NULL,
                'alamat_lengkap' => 'a',
                'tanggal_lahir' => '2000-08-10',
                'tanggal_mati' => NULL,
                'tanggal_pindah' => NULL,
                'tanggal_datang' => NULL,
                'status_tinggal' => 1,
                'status' => 1,
                'penduduk_negara' => 1,
                'negara_asal' => NULL,
                'created_at' => '2022-06-28 09:25:10',
                'updated_at' => '2022-06-28 09:25:10',
            ),
            4 => 
            array (
                'id' => 5,
                'nik' => NULL,
                'agama_id' => 1,
                'pendidikan_id' => 1,
                'pekerjaan_id' => 1,
                'status_kawin_id' => 1,
                'status_penduduk_id' => 1,
                'rt_id' => 1,
                'nama' => 'Istri',
                'kota_lahir' => 'cianjur',
                'jenis_kelamin' => 'laki-laki',
                'ada_ktp' => 0,
                'ada_akte' => 0,
                'file_ktp' => NULL,
                'file_akte' => NULL,
                'alamat_lengkap' => 'a',
                'tanggal_lahir' => '2000-08-10',
                'tanggal_mati' => NULL,
                'tanggal_pindah' => NULL,
                'tanggal_datang' => NULL,
                'status_tinggal' => 1,
                'status' => 1,
                'penduduk_negara' => 1,
                'negara_asal' => NULL,
                'created_at' => '2022-06-28 09:25:56',
                'updated_at' => '2022-06-28 09:25:56',
            ),
        ));
        
        
    }
}