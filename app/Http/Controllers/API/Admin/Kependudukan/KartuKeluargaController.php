<?php

namespace App\Http\Controllers\API\Admin\Kependudukan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Config\Exception\ValidationException;

use App\Http\Controllers\Controller;
use App\Helpers\AppHelper;
use App\Models\Kependudukan\KartuKeluarga;
use App\Models\Kependudukan\KartuKeluarga\Rt as KartuKeluargaRt;
use App\Models\Kependudukan\KartuKeluarga\Transaksi as KartuKeluargaTransaksi;
use App\Models\Kependudukan\KartuKeluarga\Negara as KartuKeluargaNegara;

class KartuKeluargaController extends Controller
{
    private $image_folder = KartuKeluarga::image_folder;
    private $validate_model = [
        'no' => ['nullable', 'string', 'max:16'],
        'alamat_lengkap' => ['required', 'string'],
        'tanggal_dibuat' => ['required', 'date'],
        'asal_data' => ['required', 'int'],
        // validasi rt
        'rt_id' => ['required', 'int'],
        // validasi negara
        'negara' => ['required', 'int'],
        'negara_nama' => ['nullable', 'string'],
        'negara_dari' => ['nullable', 'date'],
    ];

    public function insert(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate($this->validate_model);

            // kartu keluarga
            $model = new KartuKeluarga();
            $model->no = $request->no;
            $model->alamat_lengkap = $request->alamat_lengkap;
            // tanggal masuk ke lingkungan rw

            $model->tanggal_dibuat = $request->tanggal_dibuat;

            if ($image = $request->file('foto')) {
                $foto_kk = AppHelper::slugify($request->no) . substr($request->slug, 0, 10) . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($this->image_folder, $foto_kk);
                $model->foto = $foto_kk;
            }

            $model->save();

            // kartu keluarga rt
            $rt = new KartuKeluargaRt();
            $rt->kartu_keluarga_id = $model->id;
            $rt->rt_id = $request->rt_id;
            $rt_dari = $request->rt_dari;
            $rt_dari = $rt_dari ?? $request->tanggal_dibuat;
            $rt->dari = $rt_dari;
            $rt->save();

            // kartu keluarga transaksi
            // asal data 0 dibuat di rt stempat. 1 pendatang
            if ($model->asal_data == 1) {
                $transaksi = new KartuKeluargaTransaksi();
                $transaksi->kartu_keluarga_id = $model->id;
                $transaksi->rt_id = $request->datang_rt_id;
                $transaksi->keterangan = $request->datang_keterangan;
                $transaksi->tanggal = $request->tanggal_dibuat ?? date('Y-m-d');
                $transaksi->jenis = 2;
                $transaksi->save();
            }

            // negara 0 wna, 1 wni
            $negara = new KartuKeluargaNegara();
            $negara->kartu_keluarga_id = $model->id;
            $negara->negara = $request->negara;
            $negara->negara_nama = $request->negara_nama;
            $negara->dari = $request->negara_dari ?? $request->tanggal_dibuat;
            $negara->save();

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
}
