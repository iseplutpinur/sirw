<?php

namespace App\Repository\Admin\Kependudukan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Config\Exception\ValidationException;
use Yajra\Datatables\Datatables;

use App\Helpers\AppHelper;
use App\Helpers\ResponseFormatter;

use App\Models\DataMaster\Agama;
use App\Models\DataMaster\HubunganDenganKK;
use App\Models\DataMaster\Pekerjaan;
use App\Models\DataMaster\Pendidikan;
use App\Models\DataMaster\StatusKawin;
use App\Models\DataMaster\StatusPenduduk;
use App\Models\DataMaster\RukunTetangga;
use App\Models\Import\Excel;
use App\Models\Import\ExcelDetail;
use App\Models\Import\ExcelPendudukList;
use App\Models\Kependudukan\KartuKeluarga;
use App\Models\Kependudukan\KartuKeluarga\Rt as KartuKeluargaRt;
use App\Models\Kependudukan\KartuKeluarga\Data as KartuKeluargaData;
use App\Models\Kependudukan\KartuKeluarga\Negara as KartuKeluargaNegara;
use App\Models\Kependudukan\Penduduk;
use App\Models\Kependudukan\Penduduk\Agama as PendudukAgama;
use App\Models\Kependudukan\Penduduk\Akte as PendudukAkte;
use App\Models\Kependudukan\Penduduk\Ktp as PendudukKtp;
use App\Models\Kependudukan\Penduduk\Negara as PendudukNegara;
use App\Models\Kependudukan\Penduduk\Rt as PendudukRt;
use App\Models\Kependudukan\Penduduk\Transaksi as PendudukTransaksi;
use App\Models\Kependudukan\Penduduk\Pendidikan as PendudukPendidikan;
use App\Models\Kependudukan\Penduduk\Pekerjaan as PendudukPekerjaan;
use App\Models\Kependudukan\Penduduk\StatusKawin as PendudukStatusKawin;
use App\Models\Kependudukan\Penduduk\Status as PendudukStatus;



class PendudukRepository
{
    private $folder_akte = PendudukAkte::image_folder;
    private $folder_ktp = PendudukKtp::image_folder;

    private $validate_model = [
        'nama' => ['required', 'string', 'max:255'],
        'nik' => ['nullable', 'string', 'max:16'],
        'kota_lahir' => ['required', 'string', 'max:255'],
        'jenis_kelamin' => ['required', 'string', 'max:255'],
        'no_hp' => ['nullable', 'string', 'max:255'],
        'alamat_lengkap' => ['required', 'string'],
        'tanggal_lahir' => ['required', 'date'],
        'tanggal_mati' => ['nullable', 'date'],
        'asal_data' => ['required', 'int'],
        'tinggal_dari_tanggal' => ['nullable', 'date'],

        // validasi rt
        'rt_id' => ['required', 'int'],

        // validasi ktp
        'ktp_status' => ['required', 'int'],
        'ktp_dari' => ['nullable', 'date'],

        // validasi akte
        'akte_status' => ['required', 'int'],
        'akte_dari' => ['nullable', 'date'],

        // validasi agama
        'agama_id' => ['required', 'int'],
        'agama_dari' => ['nullable', 'date'],

        // validasi pendidikan
        'pendidikan_id' => ['required', 'int'],
        'pendidikan_dari' => ['nullable', 'date'],

        // validasi pekerjaan
        'pekerjaan_id' => ['required', 'int'],
        'pekerjaan_dari' => ['nullable', 'date'],

        // validasi status_kawin
        'status_kawin_id' => ['required', 'int'],
        'status_kawin_dari' => ['nullable', 'date'],

        // validasi negara
        'negara' => ['required', 'int'],
        'negara_nama' => ['nullable', 'string'],
        'negara_dari' => ['nullable', 'date'],

        // validasi status_penduduk
        'status_penduduk_id' => ['required', 'int'],
        'status_penduduk_dari' => ['nullable', 'date'],
    ];
    private $query = [];

    public function insert(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate($this->validate_model);

            // insert data model penduduk =============================================================================
            $model = new Penduduk();
            $model->nama = $request->nama;
            $model->nik = $request->nik;
            $model->kota_lahir = $request->kota_lahir;
            $model->jenis_kelamin = $request->jenis_kelamin;
            $model->no_hp = $request->no_hp;
            $model->alamat_lengkap = $request->alamat_lengkap;
            $model->tanggal_lahir = $request->tanggal_lahir;
            $model->tanggal_mati = $request->tanggal_mati;

            // 0 kelahiran, 1 kedatangan
            $model->asal_data = $request->asal_data;

            // get id
            $model->save();

            // insert data master =====================================================================================
            // rt
            // jika kedatangan 1 maka tambahkan kedalam tabel penduudk rt transaksi
            if ($model->asal_data == 1) {
                $transaksi = new PendudukTransaksi();
                $transaksi->penduduk_id = $model->id;
                $transaksi->rt_id = $request->datang_rt_id;
                $transaksi->keterangan = $request->datang_keterangan;
                $transaksi->tanggal = $request->tinggal_dari_tanggal ?? $request->tanggal_lahir;
                $transaksi->jenis = 2;
                $transaksi->save();
            }

            // simpan ke tanggal di rt sekarang
            $rt = new PendudukRt();
            $rt->penduduk_id = $model->id;
            $rt->rt_id = $request->rt_id;
            $rt_dari = $request->rt_dari;
            $rt_dari = $rt_dari ?? $request->tinggal_dari_tanggal;
            $rt_dari = $rt_dari ?? $request->negara_dari;
            $rt_dari = $rt_dari ?? $request->tanggal_lahir;
            $rt->dari = $rt_dari;
            $rt->save();

            // simpan ktp
            $ktp = new PendudukKtp();
            $ktp->penduduk_id = $model->id;
            $ktp->status = $request->ktp_status;
            $ktp->dari = $request->ktp_dari ?? (date('Y-m-d', strtotime($request->tanggal_lahir . ' + 17 years')));
            // simpan ktp foto
            $foto_ktp = '';
            if ($image = $request->file('ktp_file')) {
                $foto_ktp = $request->nik . AppHelper::slugify($request->nama)  .  '.' .  $image->getClientOriginalExtension();
                $image->move('./' . $this->folder_ktp, $foto_ktp);
                $ktp->foto = $foto_ktp;
            }

            // simpan akte
            $akte = new PendudukAkte();
            $akte->penduduk_id = $model->id;
            $akte->status = $request->akte_status;
            $akte->dari = $request->akte_dari ?? (date('Y-m-d', strtotime($request->tanggal_lahir . ' + 17 years')));
            // simpan akte foto
            $foto_akte = '';
            if ($image = $request->file('akte_file')) {
                $foto_akte = $request->nik . AppHelper::slugify($request->nama)  .  '.' .  $image->getClientOriginalExtension();
                $image->move('./' . $this->folder_akte, $foto_akte);
                $akte->foto = $foto_akte;
            }

            $akte->save();

            // agama
            $agama = new PendudukAgama();
            $agama->penduduk_id = $model->id;
            $agama->agama_id = $request->agama_id;
            $agama->dari = $request->agama_dari ?? $request->tanggal_lahir;
            $agama->save();

            // pendidikan
            $pendidikan = new PendudukPendidikan();
            $pendidikan->penduduk_id = $model->id;
            $pendidikan->pendidikan_id = $request->pendidikan_id;
            $pendidikan->dari = $request->pendidikan_dari ?? $request->tanggal_lahir;
            $pendidikan->save();

            // pekerjaan
            $pekerjaan = new PendudukPekerjaan();
            $pekerjaan->penduduk_id = $model->id;
            $pekerjaan->pekerjaan_id = $request->pekerjaan_id;
            $pekerjaan->dari = $request->pekerjaan_dari ?? $request->tanggal_lahir;
            $pekerjaan->save();

            // status_kawin
            $status_kawin = new PendudukStatusKawin();
            $status_kawin->penduduk_id = $model->id;
            $status_kawin->status_kawin_id = $request->status_kawin_id;
            $status_kawin->dari = $request->status_kawin_dari ?? $request->tanggal_lahir;
            $status_kawin->save();

            // negara 0 wna, 1 wni
            $negara = new PendudukNegara();
            $negara->penduduk_id = $model->id;
            $negara->negara = $request->negara;
            $negara->negara_nama = $request->negara_nama;
            $negara->dari = $request->negara_dari ?? $request->tanggal_lahir;
            $negara->save();

            // status
            $status = new PendudukStatus();
            $status->penduduk_id = $model->id;
            $status->status_penduduk_id = $request->status_penduduk_id;
            $status->dari = $request->status_dari ?? $request->tanggal_lahir;
            $status->save();

            DB::commit();
            return response()->json([
                'data' => $model,
            ], 200);
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }

    public function import_excel(Request $request)
    {
        // catatan belum]
        // - import kk rt masih ngikut dari rt penduduk
        // - asal data jika dari luar

        $folder = Excel::folder;
        $excel = null;
        $error = null;
        try {
            if ($file = $request->file('file')) {
                $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $excel = date('Y-m-d-h-i-s-') . AppHelper::slugify($name)  .  '.' .  $file->getClientOriginalExtension();
                $file->move("./$folder/penduduk", $excel);
                $file_excel = "./$folder/penduduk/$excel";

                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_excel);
                $array_from_excel = $spreadsheet->getActiveSheet()->toArray();
                $start = 5;
            }
        } catch (\Throwable $th) {
            $error = $th;
        }
        if (is_null($excel)) {
            return ResponseFormatter::error($error, 'File Not found');
        }

        // agama
        $agama_map = ['id', 'singkatan', 'nama'];
        $agama_list = Agama::get($agama_map)->toArray();
        $rt_map = ['id', 'nomor', 'nama'];
        $rt_list = RukunTetangga::get($rt_map)->toArray();
        $pendidikan_map = ['id', 'singkatan', 'nama'];
        $pendidikan_list = Pendidikan::get($pendidikan_map)->toArray();
        $pekerjaan_map = ['id', 'singkatan', 'nama'];
        $pekerjaan_list = Pekerjaan::get($pekerjaan_map)->toArray();
        $status_kawin_map = ['id', 'singkatan', 'nama'];
        $status_kawin_list = StatusKawin::get($status_kawin_map)->toArray();
        $status_penduduk_map = ['id', 'singkatan', 'nama'];
        $status_penduduk_list = StatusPenduduk::get($status_penduduk_map)->toArray();
        $hub_dgn_kk_map = ['id', 'singkatan', 'nama'];
        $hub_dgn_kk_list = HubunganDenganKK::get($hub_dgn_kk_map)->toArray();

        $hub_ktp_akte_map = ['id', 'a', 'b', 'c', 'd'];
        $hub_ktp_akte_list = [
            ['id' => 0, 'a' => 'tidak ada', 'b' => 'tidak', 'c' => '0', 'd' => 't'],
            ['id' => 1, 'a' => 'ada', 'b' => 'ya', 'c' => '1', 'd' => 'y'],
        ];

        $jenis_kelamin_map = ['id', 'a', 'b'];
        $jenis_kelamin_list = [
            ['id' => 'laki-laki', 'a' => '0', 'b' => 'L'],
            ['id' => 'perempuan', 'a' => '1', 'b' => 'P'],
        ];

        DB::beginTransaction();
        $db_excel = new Excel();
        $db_excel->file = $file_excel;
        $db_excel->nama = $request->nama;
        $db_excel->keterangan = $request->keterangan;
        $db_excel->kode = 'penduduk';
        $db_excel->save();

        $map = ['nama' => '2', 'no_kk' => '3', 'nik' => '4', 'hub_kk' => '5', 'hub_kk_dari' => '6', 'jenis_kelamin' => '7', 'kota_lahir' => '8', 'tanggal_lahir' => '9', 'no_hp' => '10', 'rt_id' => '11', 'agama_id' => '12', 'agama_dari' => '13', 'status_kawin_id' => '14', 'status_kawin_dari' => '15', 'pendidikan_id' => '16', 'pendidikan_dari' => '17', 'pekerjaan_id' => '18', 'pekerjaan_dari' => '19', 'status_penduduk' => '20', 'status_penduduk_dari' => '21', 'ktp_status' => '22', 'ktp_dari' => '23', 'akte_status' => '24', 'akte_dari' => '25', 'alamat_lengkap' => '26', 'tinggal_dari_tanggal' => '27', 'tanggal_mati' => '28', 'asal_data' => '29', 'negara' => '30', 'negara_nama' => '31', 'negara_dari' => '32'];
        $count = 0;
        $count_success = 0;
        $count_failed = 0;

        // kartu keluarga
        $recent_kk_no = '';
        $recent_kk_id = '';
        foreach ($array_from_excel as $i => $v) {
            if ($i < $start) continue;
            $excel_penduduk_list = new ExcelPendudukList();
            $excel_penduduk_list->excel_id = $db_excel->id;

            $excel_details = new ExcelDetail();
            $excel_details->excel_id = $db_excel->id;

            // data master
            $model = new Penduduk();
            $transaksi = new PendudukTransaksi();
            $rt = new PendudukRt();
            $ktp = new PendudukKtp();
            $akte = new PendudukAkte();
            $agama = new PendudukAgama();
            $pendidikan = new PendudukPendidikan();
            $pekerjaan = new PendudukPekerjaan();
            $status_kawin = new PendudukStatusKawin();
            $negara = new PendudukNegara();
            $status = new PendudukStatus();
            $kk_list = new KartuKeluargaData();

            try {
                $model->nama = $v[$map['nama']];
                $model->nik = $v[$map['nik']];
                $model->kota_lahir = $v[$map['kota_lahir']];
                $model->jenis_kelamin = $this->master_check($jenis_kelamin_map, $jenis_kelamin_list, $v[$map['jenis_kelamin']]);
                $model->no_hp = $v[$map['no_hp']];
                $model->alamat_lengkap = $v[$map['alamat_lengkap']];
                $model->tanggal_lahir = $v[$map['tanggal_lahir']];
                $model->tanggal_mati = $v[$map['tanggal_mati']];
                // 0 kelahiran, 1 kedatangan
                $model->asal_data = $v[$map['asal_data']];
                // get id
                $excel_details->status = 1;
                $checkpoint = "Insert Penduduk";
                $model->save();
                $excel_penduduk_list->penduduk_id = $model->id;

                // insert data master =====================================================================================
                // extract data from db
                $agama_id = $this->master_check($agama_map, $agama_list, $v[$map['agama_id']]);
                $rt_id = $this->master_check($rt_map, $rt_list, $v[$map['rt_id']]);
                $pendidikan_id = $this->master_check($pendidikan_map, $pendidikan_list, $v[$map['pendidikan_id']]);
                $pekerjaan_id = $this->master_check($pekerjaan_map, $pekerjaan_list, $v[$map['pekerjaan_id']]);
                $status_kawin_id = $this->master_check($status_kawin_map, $status_kawin_list, $v[$map['status_kawin_id']]);
                $status_penduduk_id = $this->master_check($status_penduduk_map, $status_penduduk_list, $v[$map['status_penduduk']]);
                $hub_dgn_kk_id = $this->master_check($hub_dgn_kk_map, $hub_dgn_kk_list, $v[$map['hub_kk']]);
                $ktp_status = $this->master_check($hub_ktp_akte_map, $hub_ktp_akte_list, $v[$map['ktp_status']]);
                $akte_status = $this->master_check($hub_ktp_akte_map, $hub_ktp_akte_list, $v[$map['akte_status']]);

                // insert kk
                if ($v[$map['no_kk']]) {
                    $recent_kk_no = $v[$map['no_kk']];
                    $kk = new KartuKeluarga();
                    $kk->no = $recent_kk_no;
                    $kk->alamat_lengkap = $model->alamat_lengkap;
                    $kk->asal_data = $model->asal_data;
                    $kk->tanggal_dibuat = $v[$map['tinggal_dari_tanggal']] ?? date('Y-m-d');
                    $checkpoint = "Insert Kartu Keluarga";
                    $kk->save();
                    $recent_kk_id = $kk->id;

                    $kk_rt = new KartuKeluargaRt();
                    $kk_rt->kartu_keluarga_id = $recent_kk_id;
                    $kk_rt->rt_id = $rt_id;
                    $kk_rt->dari = $v[$map['tinggal_dari_tanggal']] ?? date('Y-m-d');
                    $checkpoint = "Insert Kartu Keluarga RT";
                    $kk_rt->save();

                    $kk_negara = new KartuKeluargaNegara();
                    $kk_negara->kartu_keluarga_id = $recent_kk_id;
                    $kk_negara->negara = $v[$map['negara']];
                    $kk_negara->negara_nama = $v[$map['negara_nama']];
                    $kk_negara->dari = $v[$map['tinggal_dari_tanggal']] ?? date('Y-m-d');
                    $kk_negara->save();
                }

                // insert penduduk ke kartu keluarga
                $kk_list->penduduk_id = $model->id;
                $kk_list->kartu_keluarga_id = $recent_kk_id;
                $kk_list->hubungan_dengan_kk_id = $hub_dgn_kk_id;
                $kk_list->dari = $v[$map['hub_kk_dari']] ?? date('Y-m-d');
                $checkpoint = "Insert Kartu Keluarga List Penduduk";
                $kk_list->save();

                // rt
                // jika kedatangan 1 maka tambahkan kedalam tabel penduudk rt transaksi
                if ($model->asal_data == 1) {
                    // $transaksi->penduduk_id = $model->id;
                    // $transaksi->rt_id = $rt_id;
                    // $transaksi->keterangan = $v[$map['datang_keterangan']];
                    // $transaksi->tanggal = $v[$map['tinggal_dari_tanggal']] ?? date('Y-m-d');
                    // $transaksi->jenis = 2;
                    // $checkpoint = "Insert Penduduk Asal data";
                    // $transaksi->save();
                }

                // penduduk data master
                // rt
                $rt->penduduk_id = $model->id;
                $rt->rt_id = $rt_id;
                $rt->dari = $v[$map['tinggal_dari_tanggal']] ?? date('Y-m-d');
                $checkpoint = "Insert Penduduk RT";
                $rt->save();

                // ktp
                $ktp->penduduk_id = $model->id;
                $ktp->status = $ktp_status;
                $ktp->dari = $v[$map['ktp_dari']] ?? (date('Y-m-d', strtotime($v[$map['tanggal_lahir']] . ' + 17 years')));
                $checkpoint = "Insert Penduduk KTP";
                $ktp->save();

                // akte
                $akte->penduduk_id = $model->id;
                $akte->status = $akte_status;
                $akte->dari = $v[$map['akte_dari']] ?? (date('Y-m-d', strtotime($v[$map['tanggal_lahir']] . ' + 17 years')));
                $checkpoint = "Insert Penduduk Akte";
                $akte->save();

                // agama
                $agama->penduduk_id = $model->id;
                $agama->agama_id = $agama_id;
                $agama->dari = $v[$map['agama_dari']] ?? $v[$map['tanggal_lahir']];
                $checkpoint = "Insert Penduduk Agama";
                $agama->save();

                // pendidikan
                $pendidikan->penduduk_id = $model->id;
                $pendidikan->pendidikan_id = $pendidikan_id;
                $pendidikan->dari = $v[$map['pendidikan_dari']] ?? $v[$map['tanggal_lahir']];
                $checkpoint = "Insert Penduduk Pendidikan";
                $pendidikan->save();

                // pekerjaan
                $pekerjaan->penduduk_id = $model->id;
                $pekerjaan->pekerjaan_id = $pekerjaan_id;
                $pekerjaan->dari = $v[$map['pekerjaan_dari']] ?? $v[$map['tanggal_lahir']];
                $checkpoint = "Insert Penduduk Pekerjaan";
                $pekerjaan->save();

                // status_kawin
                $status_kawin->penduduk_id = $model->id;
                $status_kawin->status_kawin_id = $status_kawin_id;
                $status_kawin->dari = $v[$map['status_kawin_dari']] ?? $v[$map['tanggal_lahir']];
                $checkpoint = "Insert Penduduk Status Kawin";
                $status_kawin->save();

                // negara
                $negara->penduduk_id = $model->id;
                $negara->negara = $v[$map['negara']];
                $negara->negara_nama = $v[$map['negara_nama']];
                $negara->dari = $v[$map['negara_dari']] ?? $v[$map['tanggal_lahir']];
                $checkpoint = "Insert Penduduk Status Negara";
                $negara->save();

                // status penduduk
                $status->penduduk_id = $model->id;
                $status->status_penduduk_id = $status_penduduk_id;
                $status->dari = $v[$map['status_penduduk_dari']] ?? $v[$map['tanggal_lahir']];
                $checkpoint = "Insert Penduduk Status Status Penduduk";
                $status->save();
                $checkpoint = "Success";
            } catch (\Throwable $th) {
                $excel_details->status = 0;
            }

            $excel_details->data = json_encode([
                'penduduk' => $model->toJson(),
                'transaksi' => $transaksi->toJson(),
                'rt' => $rt->toJson(),
                'ktp' => $ktp->toJson(),
                'akte' => $akte->toJson(),
                'agama' => $agama->toJson(),
                'pendidikan' => $pendidikan->toJson(),
                'pekerjaan' => $pekerjaan->toJson(),
                'status_kawin' => $status_kawin->toJson(),
                'negara' => $negara->toJson(),
                'status' => $status->toJson(),
                'map' => json_encode($map),
                'v' => json_encode($v),
            ]);
            $excel_details->catatan = $checkpoint;
            $excel_details->save();

            $excel_penduduk_list->excel_detail_id = $excel_details->id;
            $excel_penduduk_list->status = $excel_details->status;
            $excel_penduduk_list->save();
            $count++;
            if ($excel_details->status == 0) {
                $count_failed++;
            } else {
                $count_success++;
            }
        }

        DB::commit();

        return ResponseFormatter::success(
            ['total' => $count, 'success' => $count_success, 'failed' => $count_failed],
            'Penduduk imported'
        );
    }

    private function master_check(?array $map, ?array $items, ?string $search)
    {
        $result = null;
        foreach ($items as $v) {
            foreach ($map as $m) {
                if (strtolower($v[$m]) == strtolower($search)) {
                    return $v['id'];
                }
            }
        }
        return $result;
    }

    public function datatable(Request $request)
    {
        $filter = $request->filter;
        // list table
        $table_penduduk = Penduduk::tableName;

        // data master ============================================================================================
        // rt
        $table_penduduk_rt = PendudukRt::tableName;
        $table_rt = RukunTetangga::tableName;
        $table_penduduk_ktp = PendudukKtp::tableName;
        $table_penduduk_akte = PendudukAkte::tableName;
        $table_penduduk_agama = PendudukAgama::tableName;
        $table_agama = Agama::tableName;
        $table_penduduk_pendidikan = PendudukPendidikan::tableName;
        $table_pendidikan = Pendidikan::tableName;
        $table_penduduk_pekerjaan = PendudukPekerjaan::tableName;
        $table_pekerjaan = Pekerjaan::tableName;
        $table_penduduk_status_kawin = PendudukStatusKawin::tableName;
        $table_status_kawin = StatusKawin::tableName;
        $table_penduduk_status_penduduk = PendudukStatus::tableName;
        $table_status_penduduk = StatusPenduduk::tableName;
        $table_penduduk_negara = PendudukNegara::tableName;


        // cusotm query ========================================================================================================
        // rt
        $rt_fun = function (string $select, string $alias) use ($table_rt, $table_penduduk_rt, $table_penduduk): array {
            $str = <<<SQL
                (select $table_rt.$select from $table_rt
                    join $table_penduduk_rt on
                        $table_rt.id = $table_penduduk_rt.rt_id
                    where $table_penduduk_rt.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_rt.dari desc limit 1)
            SQL;
            return [$alias => $str, ($alias . '_alias') => $alias];
        };
        $c_rt = 'rt';
        $c_rt_nama = 'rt_nama';
        $c_rt_id = 'rt_id';
        $this->query = array_merge($this->query, $rt_fun('nomor', $c_rt));
        $this->query = array_merge($this->query, $rt_fun('nama', $c_rt_nama));
        $this->query = array_merge($this->query, $rt_fun('id', $c_rt_id));

        // ktp
        $c_ktp_ada = 'ktp_ada';
        $this->query[$c_ktp_ada] = <<<SQL
                            (select `status` from $table_penduduk_ktp where $table_penduduk_ktp.penduduk_id = $table_penduduk.id
                                order by $table_penduduk_ktp.dari desc limit 1)
                        SQL;
        $this->query["{$c_ktp_ada}_alias"] = $c_ktp_ada;

        // akte
        $c_akte_ada = 'akte_ada';
        $this->query[$c_akte_ada] = <<<SQL
                            (select `status` from $table_penduduk_akte where $table_penduduk_akte.penduduk_id = $table_penduduk.id
                                order by $table_penduduk_akte.dari desc limit 1)
                        SQL;
        $this->query["{$c_akte_ada}_alias"] = $c_akte_ada;

        // agama
        $agama_fun = function (string $select, string $alias) use ($table_agama, $table_penduduk_agama, $table_penduduk): array {
            $str = <<<SQL
                (select $table_agama.$select from $table_agama
                    join $table_penduduk_agama on
                        $table_agama.id = $table_penduduk_agama.agama_id
                    where $table_penduduk_agama.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_agama.dari desc limit 1)
            SQL;
            return [$alias => $str, ($alias . '_alias') => $alias];
        };
        $c_agama = 'agama';
        $c_agama_nama = 'agama_nama';
        $c_agama_id = 'agama_id';
        $this->query = array_merge($this->query, $agama_fun('singkatan', $c_agama));
        $this->query = array_merge($this->query, $agama_fun('nama', $c_agama_nama));
        $this->query = array_merge($this->query, $agama_fun('id', $c_agama_id));

        // pendidikan
        $pendidikan_fun = function (string $select, string $alias) use ($table_pendidikan, $table_penduduk_pendidikan, $table_penduduk): array {
            $str = <<<SQL
                (select $table_pendidikan.$select from $table_pendidikan
                    join $table_penduduk_pendidikan on
                        $table_pendidikan.id = $table_penduduk_pendidikan.pendidikan_id
                    where $table_penduduk_pendidikan.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_pendidikan.dari desc limit 1)
            SQL;
            return [$alias => $str, ($alias . '_alias') => $alias];
        };
        $c_pendidikan = 'pendidikan';
        $c_pendidikan_nama = 'pendidikan_nama';
        $c_pendidikan_id = 'pendidikan_id';
        $this->query = array_merge($this->query, $pendidikan_fun('singkatan', $c_pendidikan));
        $this->query = array_merge($this->query, $pendidikan_fun('nama', $c_pendidikan_nama));
        $this->query = array_merge($this->query, $pendidikan_fun('id', $c_pendidikan_id));

        // pekerjaan
        $pekerjaan_fun = function (string $select, string $alias) use ($table_pekerjaan, $table_penduduk_pekerjaan, $table_penduduk): array {
            $str = <<<SQL
                (select $table_pekerjaan.$select from $table_pekerjaan
                    join $table_penduduk_pekerjaan on
                        $table_pekerjaan.id = $table_penduduk_pekerjaan.pekerjaan_id
                    where $table_penduduk_pekerjaan.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_pekerjaan.dari desc limit 1)
            SQL;
            return [$alias => $str, ($alias . '_alias') => $alias];
        };
        $c_pekerjaan = 'pekerjaan';
        $c_pekerjaan_nama = 'pekerjaan_nama';
        $c_pekerjaan_id = 'pekerjaan_id';
        $this->query = array_merge($this->query, $pekerjaan_fun('singkatan', $c_pekerjaan));
        $this->query = array_merge($this->query, $pekerjaan_fun('nama', $c_pekerjaan_nama));
        $this->query = array_merge($this->query, $pekerjaan_fun('id', $c_pekerjaan_id));

        // status_kawin
        $status_kawin_fun = function (string $select, string $alias) use ($table_status_kawin, $table_penduduk_status_kawin, $table_penduduk): array {
            $str = <<<SQL
                (select $table_status_kawin.$select from $table_status_kawin
                    join $table_penduduk_status_kawin on
                        $table_status_kawin.id = $table_penduduk_status_kawin.status_kawin_id
                    where $table_penduduk_status_kawin.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_status_kawin.dari desc limit 1)
            SQL;
            return [$alias => $str, ($alias . '_alias') => $alias];
        };
        $c_status_kawin = 'status_kawin';
        $c_status_kawin_nama = 'status_kawin_nama';
        $c_status_kawin_id = 'status_kawin_id';
        $this->query = array_merge($this->query, $status_kawin_fun('singkatan', $c_status_kawin));
        $this->query = array_merge($this->query, $status_kawin_fun('nama', $c_status_kawin_nama));
        $this->query = array_merge($this->query, $status_kawin_fun('id', $c_status_kawin_id));

        // status_penduduk
        $status_penduduk_fun = function (string $select, string $alias) use ($table_status_penduduk, $table_penduduk_status_penduduk, $table_penduduk): array {
            $str = <<<SQL
                (select $table_status_penduduk.$select from $table_status_penduduk
                    join $table_penduduk_status_penduduk on
                        $table_status_penduduk.id = $table_penduduk_status_penduduk.status_penduduk_id
                    where $table_penduduk_status_penduduk.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_status_penduduk.dari desc limit 1)
            SQL;
            return [$alias => $str, ($alias . '_alias') => $alias];
        };
        $c_status_penduduk = 'status_penduduk';
        $c_status_penduduk_nama = 'status_penduduk_nama';
        $c_status_penduduk_id = 'status_penduduk_id';
        $this->query = array_merge($this->query, $status_penduduk_fun('singkatan', $c_status_penduduk));
        $this->query = array_merge($this->query, $status_penduduk_fun('nama', $c_status_penduduk_nama));
        $this->query = array_merge($this->query, $status_penduduk_fun('id', $c_status_penduduk_id));

        // tanggal lahir
        $c_tanggal_lahir_str = 'tanggal_lahir_str';
        $this->query[$c_tanggal_lahir_str] = <<<SQL
                (DATE_FORMAT($table_penduduk.tanggal_lahir, '%d-%b-%Y'))
        SQL;
        $this->query["{$c_tanggal_lahir_str}_alias"] = $c_tanggal_lahir_str;

        $c_tanggal_mati_str = 'tanggal_mati_str';
        $this->query[$c_tanggal_mati_str] = <<<SQL
                (DATE_FORMAT($table_penduduk.tanggal_mati, '%d-%b-%Y'))
        SQL;
        $this->query["{$c_tanggal_mati_str}_alias"] = $c_tanggal_mati_str;

        // umur
        $umur_fun = function (string $select, string $alias = '') use ($table_penduduk): array {
            $str = <<<SQL
                (SELECT TIMESTAMPDIFF($select, $table_penduduk.tanggal_lahir, (ifnull( $table_penduduk.tanggal_mati , CURDATE()))))
            SQL;
            return [$alias => $str, ($alias . '_alias') => $alias];
        };
        $c_umur = 'umur';
        $c_umur_bulan = 'umur_bulan';
        $c_umur_hari = 'umur_hari';
        $this->query = array_merge($this->query, $umur_fun('YEAR', $c_umur));
        $this->query = array_merge($this->query, $umur_fun('MONTH', $c_umur_bulan));
        $this->query = array_merge($this->query, $umur_fun('DAY', $c_umur_hari));

        // negara
        $c_negara = 'negara';
        $this->query[$c_negara] = <<<SQL
                (select negara from $table_penduduk_negara where $table_penduduk_negara.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_negara.dari desc limit 1)
        SQL;
        $this->query["{$c_negara}_alias"] = $c_negara;

        $c_negara_nama = 'negara_nama';
        $this->query[$c_negara_nama] = <<<SQL
                (select nama from $table_penduduk_negara where $table_penduduk_negara.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_negara.dari desc limit 1)
        SQL;
        $this->query["{$c_negara_nama}_alias"] = $c_negara_nama;


        // ========================================================================================================
        // select raw as alias
        $query = $this->query;
        $sraa = function (string $col) use ($query): string {
            return $query[$col] . ' as ' . $query[$col . '_alias'];
        };

        $c_jk = 'jenis_kelamin';

        // register filter search datatable
        $model_filter = [
            $c_rt,
            $c_rt_nama,
            $c_ktp_ada,
            $c_akte_ada,
            $c_agama,
            $c_agama_nama,
            $c_pendidikan,
            $c_pendidikan_nama,
            $c_pekerjaan,
            $c_pekerjaan_nama,
            $c_status_kawin,
            $c_status_kawin_nama,
            $c_status_penduduk,
            $c_status_penduduk_nama,
            $c_tanggal_lahir_str,
            $c_tanggal_mati_str,
            $c_umur,
            $c_umur_bulan,
            $c_umur_hari,
            $c_negara,
            $c_negara_nama,
        ];


        $to_db_raw = array_map(function ($a) use ($sraa) {
            return DB::raw($sraa($a));
        }, $model_filter);

        $model = Penduduk::select(array_merge([
            // penduduk
            "$table_penduduk.id",
            "$table_penduduk.nama",
            "$table_penduduk.nik",
            "$table_penduduk.kota_lahir",
            "$table_penduduk.$c_jk",
            "$table_penduduk.no_hp",
            "$table_penduduk.alamat_lengkap",
            "$table_penduduk.tanggal_lahir",
            "$table_penduduk.tanggal_mati",
            "$table_penduduk.asal_data",
        ], $to_db_raw));

        // filter check
        $f_c = function (string $param) use ($filter): mixed {
            return isset($filter[$param]) ? $filter[$param] : false;
        };

        // register filters
        $f = [
            $c_rt_id,
            $c_agama_id,
            $c_status_kawin_id,
            $c_pendidikan_id,
            $c_pekerjaan_id,
            $c_status_penduduk_id,
            $c_ktp_ada,
            $c_akte_ada
        ];

        // loop filter
        foreach ($f as $v) {
            if ($f_c($v)) {
                $model->whereRaw("{$this->query[$v]}='{$f_c($v)}'");
            }
        }

        // filter other
        $f = $c_jk;
        if ($f_c($f)) {
            $model->whereRaw("$table_penduduk.$f='$f_c($f)}'");
        }

        $datatable = Datatables::of($model)->addIndexColumn();
        foreach ($model_filter as $v) {
            // custom pencarian
            $datatable->filterColumn($this->query["{$v}_alias"], function ($query, $keyword) use ($v) {
                $query->whereRaw("({$this->query[$v]} like '%$keyword%')");
            });
        }

        // create datatable
        return $datatable->make(true);
    }
}
