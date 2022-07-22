<?php

namespace App\Http\Controllers\API\Admin\Kependudukan;

use App\Helpers\AppHelper;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use League\Config\Exception\ValidationException;
use Yajra\Datatables\Datatables;

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
use App\Models\Kependudukan\KartuKeluarga\Data;
use App\Models\Kependudukan\KartuKeluarga\Rt as KartuKeluargaRt;
use App\Models\Kependudukan\Penduduk;
use App\Models\Kependudukan\Penduduk\Agama as PendudukAgama;
use App\Models\Kependudukan\Penduduk\Akte;
use App\Models\Kependudukan\Penduduk\Ktp;
use App\Models\Kependudukan\Penduduk\Rt;
use App\Models\Kependudukan\Penduduk\Transaksi;
use App\Models\Kependudukan\Penduduk\Pendidikan as PendudukPendidikan;
use App\Models\Kependudukan\Penduduk\Pekerjaan as PendudukPekerjaan;
use App\Models\Kependudukan\Penduduk\StatusKawin as PendudukStatusKawin;
use App\Models\Kependudukan\Penduduk\Negara as PendudukNegara;
use App\Models\Kependudukan\Penduduk\Status as PendudukStatus;


use Illuminate\Support\Facades\DB;

class PendudukController extends Controller
{
    private $folder_akte = Akte::image_folder;
    private $folder_ktp = Ktp::image_folder;

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
        'tinggal_dari_tanggal' => ['required', 'date'],

        // validasi rt
        'rt_id' => ['required', 'int'],

        // validasi ktp
        'ktp_status' => ['required', 'int'],
        'ktp_dari' => ['required', 'date'],

        // validasi akte
        'akte_status' => ['required', 'int'],
        'akte_dari' => ['required', 'date'],

        // validasi agama
        'agama_id' => ['required', 'int'],
        'agama_dari' => ['required', 'date'],

        // validasi pendidikan
        'pendidikan_id' => ['required', 'int'],
        'pendidikan_dari' => ['required', 'date'],

        // validasi pekerjaan
        'pekerjaan_id' => ['required', 'int'],
        'pekerjaan_dari' => ['required', 'date'],

        // validasi status_kawin
        'status_kawin_id' => ['required', 'int'],
        'status_kawin_dari' => ['required', 'date'],

        // validasi negara
        'negara' => ['required', 'int'],
        'negara_nama' => ['nullable', 'string'],
        'negara_dari' => ['required', 'date'],

        // validasi status_penduduk
        'status_penduduk' => ['required', 'int'],
        'status_penduduk_dari' => ['required', 'date'],
    ];

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
                $transaksi = new Transaksi();
                $transaksi->penduduk_id = $model->id;
                $transaksi->rt_id = $request->rt_id;
                $transaksi->keterangan = $request->datang_keterangan;
                $transaksi->tanggal = $request->tinggal_dari_tanggal ?? date('Y-m-d');
                $transaksi->jenis = 2;
                $transaksi->save();
            }

            // simpan ke tanggal di rt sekarang
            $rt = new Rt();
            $rt->penduduk_id = $model->id;
            $rt->rt_id = $request->rt_id;
            $rt->dari = $request->tinggal_dari_tanggal ?? date('Y-m-d');
            $rt->save();

            // simpan ktp
            $ktp = new Ktp();
            $ktp->penduduk_id = $model->id;
            $ktp->status = $request->ktp_status;
            $ktp->dari = $request->ktp_dari ?? (date('Y-m-d', strtotime($request->tanggal_lahir . ' + 17 years')));
            // simpan ktp foto
            $foto_ktp = '';
            if ($image = $request->file('file_ktp')) {
                $foto_ktp = $request->nik . AppHelper::slugify($request->nama)  .  '.' .  $image->getClientOriginalExtension();
                $image->move('./' . $this->folder_ktp, $foto_ktp);
                $ktp->foto = $foto_ktp;
            }

            // simpan akte
            $akte = new Akte();
            $akte->penduduk_id = $model->id;
            $akte->status = $request->akte_status;
            $akte->dari = $request->akte_dari ?? (date('Y-m-d', strtotime($request->tanggal_lahir . ' + 17 years')));
            // simpan akte foto
            $foto_akte = '';
            if ($image = $request->file('file_akte')) {
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
            $status->status = $request->status_penduduk;
            $status->dari = $request->status_dari ?? $request->tanggal_lahir;
            $status->save();

            DB::commit();
            return ResponseFormatter::success(
                $model,
                'Penduduk added'
            );
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
            $transaksi = new Transaksi();
            $rt = new Rt();
            $ktp = new Ktp();
            $akte = new Akte();
            $agama = new PendudukAgama();
            $pendidikan = new PendudukPendidikan();
            $pekerjaan = new PendudukPekerjaan();
            $status_kawin = new PendudukStatusKawin();
            $negara = new PendudukNegara();
            $status = new PendudukStatus();
            $kk_list = new Data();

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
                    $checkpoint = "Insert Kartu Keluarga";
                    $kk->save();
                    $recent_kk_id = $kk->id;

                    $kk_rt = new KartuKeluargaRt();
                    $kk_rt->kartu_keluarga_id = $recent_kk_id;
                    $kk_rt->rt_id = $rt_id;
                    $kk_rt->dari = $v[$map['tinggal_dari_tanggal']] ?? date('Y-m-d');
                    $checkpoint = "Insert Kartu Keluarga RT";
                    $kk_rt->save();
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
        // list table
        $table_penduduk = Penduduk::tableName;

        // data master ============================================================================================
        // rt
        $table_penduduk_rt = Rt::tableName;
        $table_rt = RukunTetangga::tableName;
        $table_penduduk_ktp = Ktp::tableName;
        $table_penduduk_akte = Akte::tableName;
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

        // cusotm query
        // get list anggota kk dengan no urut terendah
        // ========================================================================================================
        // rt
        $this->query['rt'] = <<<SQL
                                (select $table_rt.nomor from $table_rt
                                    join $table_penduduk_rt on
                                        $table_rt.id = $table_penduduk_rt.rt_id
                                    where $table_penduduk_rt.penduduk_id = $table_penduduk.id
                                    order by $table_penduduk_rt.dari desc limit 1)
                        SQL;
        $this->query['rt_alias'] = 'rt';
        $this->query['rt_nama'] = <<<SQL
                                (select $table_rt.nama from $table_rt
                                    join $table_penduduk_rt on
                                        $table_rt.id = $table_penduduk_rt.rt_id
                                    where $table_penduduk_rt.penduduk_id = $table_penduduk.id
                                    order by $table_penduduk_rt.dari desc limit 1)
                        SQL;
        $this->query['rt_nama_alias'] = 'rt_nama';

        // ktp
        $this->query['ktp_ada'] = <<<SQL
                            (select `status` from $table_penduduk_ktp where $table_penduduk_ktp.penduduk_id = $table_penduduk.id
                                order by $table_penduduk_ktp.dari desc limit 1)
                        SQL;
        $this->query['ktp_ada_alias'] = 'ktp_ada';

        // akte
        $this->query['akte_ada'] = <<<SQL
                            (select `status` from $table_penduduk_akte where $table_penduduk_akte.penduduk_id = $table_penduduk.id
                                order by $table_penduduk_akte.dari desc limit 1)
                        SQL;
        $this->query['akte_ada_alias'] = 'akte_ada';

        // agama
        $this->query['agama'] = <<<SQL
                (select $table_agama.singkatan from $table_agama
                    join $table_penduduk_agama on
                        $table_agama.id = $table_penduduk_agama.agama_id
                    where $table_penduduk_agama.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_agama.dari desc limit 1)
        SQL;
        $this->query['agama_alias'] = 'agama';

        $this->query['agama_nama'] = <<<SQL
                (select $table_agama.nama from $table_agama
                    join $table_penduduk_agama on
                        $table_agama.id = $table_penduduk_agama.agama_id
                    where $table_penduduk_agama.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_agama.dari desc limit 1)
        SQL;
        $this->query['agama_nama_alias'] = 'agama_nama';

        // pendidikan
        $this->query['pendidikan'] = <<<SQL
                (select $table_pendidikan.singkatan from $table_pendidikan
                    join $table_penduduk_pendidikan on
                        $table_pendidikan.id = $table_penduduk_pendidikan.pendidikan_id
                    where $table_penduduk_pendidikan.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_pendidikan.dari desc limit 1)
        SQL;
        $this->query['pendidikan_alias'] = 'pendidikan';
        $this->query['pendidikan_nama'] = <<<SQL
                (select $table_pendidikan.nama from $table_pendidikan
                    join $table_penduduk_pendidikan on
                        $table_pendidikan.id = $table_penduduk_pendidikan.pendidikan_id
                    where $table_penduduk_pendidikan.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_pendidikan.dari desc limit 1)
        SQL;
        $this->query['pendidikan_nama_alias'] = 'pendidikan_nama';

        // pekerjaan
        $this->query['pekerjaan'] = <<<SQL
                (select $table_pekerjaan.singkatan from $table_pekerjaan
                    join $table_penduduk_pekerjaan on
                        $table_pekerjaan.id = $table_penduduk_pekerjaan.pekerjaan_id
                    where $table_penduduk_pekerjaan.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_pekerjaan.dari desc limit 1)
        SQL;
        $this->query['pekerjaan_alias'] = 'pekerjaan';
        $this->query['pekerjaan_nama'] = <<<SQL
                (select $table_pekerjaan.nama from $table_pekerjaan
                    join $table_penduduk_pekerjaan on
                        $table_pekerjaan.id = $table_penduduk_pekerjaan.pekerjaan_id
                    where $table_penduduk_pekerjaan.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_pekerjaan.dari desc limit 1)
        SQL;
        $this->query['pekerjaan_nama_alias'] = 'pekerjaan_nama';

        // status_kawin
        $this->query['status_kawin'] = <<<SQL
                (select $table_status_kawin.singkatan from $table_status_kawin
                    join $table_penduduk_status_kawin on
                        $table_status_kawin.id = $table_penduduk_status_kawin.status_kawin_id
                    where $table_penduduk_status_kawin.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_status_kawin.dari desc limit 1)
        SQL;
        $this->query['status_kawin_alias'] = 'status_kawin';
        $this->query['status_kawin_nama'] = <<<SQL
                (select $table_status_kawin.nama from $table_status_kawin
                    join $table_penduduk_status_kawin on
                        $table_status_kawin.id = $table_penduduk_status_kawin.status_kawin_id
                    where $table_penduduk_status_kawin.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_status_kawin.dari desc limit 1)
        SQL;
        $this->query['status_kawin_nama_alias'] = 'status_kawin_nama';

        // status_penduduk
        $this->query['status_penduduk'] = <<<SQL
                (select $table_status_penduduk.singkatan from $table_status_penduduk
                    join $table_penduduk_status_penduduk on
                        $table_status_penduduk.id = $table_penduduk_status_penduduk.status_penduduk_id
                    where $table_penduduk_status_penduduk.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_status_penduduk.dari desc limit 1)
        SQL;
        $this->query['status_penduduk_alias'] = 'status_penduduk';
        $this->query['status_penduduk_nama'] = <<<SQL
                (select $table_status_penduduk.nama from $table_status_penduduk
                    join $table_penduduk_status_penduduk on
                        $table_status_penduduk.id = $table_penduduk_status_penduduk.status_penduduk_id
                    where $table_penduduk_status_penduduk.penduduk_id = $table_penduduk.id
                    order by $table_penduduk_status_penduduk.dari desc limit 1)
        SQL;
        $this->query['status_penduduk_nama_alias'] = 'status_penduduk_nama';

        $this->query['tanggal_lahir_str'] = <<<SQL
                (DATE_FORMAT($table_penduduk.tanggal_lahir, '%d-%b-%Y'))
        SQL;
        $this->query['tanggal_lahir_str_alias'] = 'tanggal_lahir_str';

        $this->query['umur'] = <<<SQL
                (SELECT TIMESTAMPDIFF(YEAR, $table_penduduk.tanggal_lahir, CURDATE()))
        SQL;
        $this->query['umur_alias'] = 'umur';

        // ========================================================================================================
        $model = Penduduk::select([
            // penduduk
            "$table_penduduk.id",
            "$table_penduduk.nama",
            "$table_penduduk.nik",
            "$table_penduduk.kota_lahir",
            "$table_penduduk.jenis_kelamin",
            "$table_penduduk.no_hp",
            "$table_penduduk.alamat_lengkap",
            "$table_penduduk.tanggal_lahir",
            "$table_penduduk.tanggal_mati",
            "$table_penduduk.asal_data",

            // data master
            DB::raw("{$this->query['rt']} as {$this->query['rt_alias']}"),
            DB::raw("{$this->query['rt_nama']} as {$this->query['rt_nama_alias']}"),

            DB::raw("{$this->query['ktp_ada']} as {$this->query['ktp_ada_alias']}"),
            DB::raw("{$this->query['akte_ada']} as {$this->query['akte_ada_alias']}"),

            DB::raw("{$this->query['agama']} as {$this->query['agama_alias']}"),
            DB::raw("{$this->query['agama_nama']} as {$this->query['agama_nama_alias']}"),

            DB::raw("{$this->query['pendidikan']} as {$this->query['pendidikan_alias']}"),
            DB::raw("{$this->query['pendidikan_nama']} as {$this->query['pendidikan_nama_alias']}"),

            DB::raw("{$this->query['pekerjaan']} as {$this->query['pekerjaan_alias']}"),
            DB::raw("{$this->query['pekerjaan_nama']} as {$this->query['pekerjaan_nama_alias']}"),

            DB::raw("{$this->query['status_kawin']} as {$this->query['status_kawin_alias']}"),
            DB::raw("{$this->query['status_kawin_nama']} as {$this->query['status_kawin_nama_alias']}"),

            DB::raw("{$this->query['status_penduduk']} as {$this->query['status_penduduk_alias']}"),
            DB::raw("{$this->query['status_penduduk_nama']} as {$this->query['status_penduduk_nama_alias']}"),

            DB::raw("{$this->query['tanggal_lahir_str']} as {$this->query['tanggal_lahir_str_alias']}"),
            DB::raw("{$this->query['umur']} as {$this->query['umur_alias']}"),
        ]);

        return Datatables::of($model)
            ->addIndexColumn()
            // custom pencarian
            ->filterColumn($this->query['rt_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['rt']} like '%$keyword%'");
            })
            ->filterColumn($this->query['rt_nama_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['rt_nama']} like '%$keyword%'");
            })

            ->filterColumn($this->query['ktp_ada_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['ktp_ada']} like '%$keyword%'");
            })
            ->filterColumn($this->query['akte_ada_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['akte_ada']} like '%$keyword%'");
            })

            ->filterColumn($this->query['agama_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['agama']} like '%$keyword%'");
            })
            ->filterColumn($this->query['agama_nama_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['agama_nama']} like '%$keyword%'");
            })

            ->filterColumn($this->query['pendidikan_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['pendidikan']} like '%$keyword%'");
            })

            ->filterColumn($this->query['pendidikan_nama_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['pendidikan_nama']} like '%$keyword%'");
            })

            ->filterColumn($this->query['pekerjaan_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['pekerjaan']} like '%$keyword%'");
            })
            ->filterColumn($this->query['pekerjaan_nama_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['pekerjaan_nama']} like '%$keyword%'");
            })

            ->filterColumn($this->query['status_kawin_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['status_kawin']} like '%$keyword%'");
            })
            ->filterColumn($this->query['status_kawin_nama_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['status_kawin_nama']} like '%$keyword%'");
            })

            ->filterColumn($this->query['status_penduduk_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['status_penduduk']} like '%$keyword%'");
            })
            ->filterColumn($this->query['status_penduduk_nama_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['status_penduduk_nama']} like '%$keyword%'");
            })

            ->filterColumn($this->query['tanggal_lahir_str_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['tanggal_lahir_str']} like '%$keyword%'");
            })
            ->filterColumn($this->query['umur_alias'], function ($query, $keyword) {
                $query->whereRaw("{$this->query['umur']} like '%$keyword%'");
            })
            ->make(true);
    }
}
