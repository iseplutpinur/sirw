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

        // excel
        // php artisan iseed excels,excel_details --force

        // user
        // php artisan iseed users,tamus,sessions --force

        // penduduk
        // php artisan iseed users,master_agama,master_group_umur,master_hub_dgn_kk,master_pekerjaan,master_pendidikan,master_rukun_tetangga,master_status_kawin,master_status_penduduk,master_status_tamu,master_status_tinggal,penduduks,penduduk_agama,penduduk_akte,penduduk_hub_kk,penduduk_ktp,penduduk_negara,penduduk_pekerjaan,penduduk_pendidikan,penduduk_pindah_konfirmasi,penduduk_rt,penduduk_status,penduduk_status_kawin,penduduk_transaksi,rukun_tetangga_ketua,rumahs,rumah_penghunis,tanahs,kartu_keluargas,kartu_keluarga_lists,kartu_keluarga_pindah_konfirmasi,kartu_keluarga_rt,kartu_keluarga_transaksi --force
        $this->call(UsersTableSeeder::class);
        $this->call(TamusTableSeeder::class);
        $this->call(SessionsTableSeeder::class);
        $this->call(MasterAgamaTableSeeder::class);
        $this->call(MasterGroupUmurTableSeeder::class);
        $this->call(MasterHubDgnKkTableSeeder::class);
        $this->call(MasterPekerjaanTableSeeder::class);
        $this->call(MasterPendidikanTableSeeder::class);
        $this->call(MasterRukunTetanggaTableSeeder::class);
        $this->call(MasterStatusKawinTableSeeder::class);
        $this->call(MasterStatusPendudukTableSeeder::class);
        $this->call(MasterStatusTamuTableSeeder::class);
        $this->call(MasterStatusTinggalTableSeeder::class);
        $this->call(PenduduksTableSeeder::class);
        $this->call(PendudukAgamaTableSeeder::class);
        $this->call(PendudukAkteTableSeeder::class);
        $this->call(PendudukHubKkTableSeeder::class);
        $this->call(PendudukKtpTableSeeder::class);
        $this->call(PendudukNegaraTableSeeder::class);
        $this->call(PendudukPekerjaanTableSeeder::class);
        $this->call(PendudukPendidikanTableSeeder::class);
        $this->call(PendudukPindahKonfirmasiTableSeeder::class);
        $this->call(PendudukRtTableSeeder::class);
        $this->call(PendudukStatusTableSeeder::class);
        $this->call(PendudukStatusKawinTableSeeder::class);
        $this->call(PendudukTransaksiTableSeeder::class);
        $this->call(RukunTetanggaKetuaTableSeeder::class);
        $this->call(RumahsTableSeeder::class);
        $this->call(RumahPenghunisTableSeeder::class);
        $this->call(TanahsTableSeeder::class);
        $this->call(KartuKeluargasTableSeeder::class);
        $this->call(KartuKeluargaListsTableSeeder::class);
        $this->call(KartuKeluargaPindahKonfirmasiTableSeeder::class);
        $this->call(KartuKeluargaRtTableSeeder::class);
        $this->call(KartuKeluargaTransaksiTableSeeder::class);
    }
}
