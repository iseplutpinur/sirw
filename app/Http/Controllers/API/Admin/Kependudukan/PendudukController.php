<?php

namespace App\Http\Controllers\API\Admin\Kependudukan;

use App\Helpers\AppHelper;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use League\Config\Exception\ValidationException;
use Yajra\Datatables\Datatables;

use App\Models\DataMaster\Agama;
use App\Models\DataMaster\Pekerjaan;
use App\Models\DataMaster\Pendidikan;
use App\Models\DataMaster\StatusKawin;
use App\Models\DataMaster\StatusPenduduk;
use App\Models\DataMaster\RukunTetangga;
use App\Models\Import\Excel;
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
        $folder = Excel::folder;
        $excel = null;
        if ($file = $request->file('file')) {
            $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $excel = date('Y-m-d-h-i-s-') . AppHelper::slugify($name)  .  '.' .  $file->getClientOriginalExtension();
            $file->move("./$folder/penduduk", $excel);
        }


        /** Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("./$folder/penduduk/$excel");
        $array_from_excel = $spreadsheet->getActiveSheet()->toArray();
        $start = 6;
        foreach ($array_from_excel as $i => $v) {
        }
        die;

        $map = [
            'nama' => '2',
            'no_kk' => '3',
            'nik' => '4',
            'hub_kk' => '5',
            'jenis_kelamin' => '6',
            'kota_lahir' => '7',
            'tanggal_lahir' => '8',
            'no_hp' => '9',
            'rt_id' => '10',
            'agama_id' => '11',
            'agama_dari' => '12',
            'status_kawin_id' => '13',
            'status_kawin_dari' => '14',
            'pendidikan_id' => '15',
            'pendidikan_dari' => '16',
            'pekerjaan_id' => '17',
            'pekerjaan_dari' => '18',
            'status_penduduk' => '19',
            'status_penduduk_dari' => '20',
            'ktp_status' => '21',
            'ktp_dari' => '22',
            'akte_status' => '23',
            'akte_dari' => '24',
            'alamat_lengkap' => '25',
            'tinggal_dari_tanggal' => '26',
            'tanggal_mati' => '27',
            'asal_data' => '28',
            'negara' => '29',
            'negara_nama' => '30',
            'negara_dari' => '31',
        ];
    }
}
