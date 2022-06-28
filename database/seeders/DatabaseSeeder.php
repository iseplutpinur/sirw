<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Isep Lutpi Nur',
            'email' => 'administrator@gmail.com',
            'password' => bcrypt('123456'),
            'role' => User::ROLE_ADMINISTRATOR,
            'active' => '1'
        ]);

        // data master
        // php artisan iseed agamas,pekerjaans,pendidikans,status_kawins,status_penduduks,status_tamus,status_tinggals,hubungan_dengan_k_k_s,rukun_tetanggas --force

        // penduduk
        // php artisan iseed penduduks,kartu_keluargas,kartu_keluarga_lists  --force
        $this->call(AgamasTableSeeder::class);
        $this->call(PekerjaansTableSeeder::class);
        $this->call(PendidikansTableSeeder::class);
        $this->call(StatusKawinsTableSeeder::class);
        $this->call(StatusPenduduksTableSeeder::class);
        $this->call(StatusTamusTableSeeder::class);
        $this->call(StatusTinggalsTableSeeder::class);
        $this->call(HubunganDenganKKSTableSeeder::class);
        $this->call(RukunTetanggasTableSeeder::class);
        $this->call(PenduduksTableSeeder::class);
        $this->call(KartuKeluargasTableSeeder::class);
        $this->call(KartuKeluargaListsTableSeeder::class);
    }
}
