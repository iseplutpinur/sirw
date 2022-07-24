<?php

namespace App\Http\Controllers\Admin\Kependudukan;

use Illuminate\Http\Request;
use League\Config\Exception\ValidationException;
use Illuminate\Support\Facades\DB;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\DataMaster\HubunganDenganKK;
use App\Models\DataMaster\RukunTetangga;
use App\Models\Kependudukan\Penduduk;
use App\Models\Kependudukan\KartuKeluarga;
use App\Models\Kependudukan\KartuKeluarga\Data as KartuKeluargaData;
use App\Repository\Admin\Kependudukan\KartuKeluargaRepository;

class KartuKeluargaController extends Controller
{
    private $repo;
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

    public function __construct(KartuKeluargaRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if (request()->ajax()) {
            return $this->repo->datatable($request);
        }
        $page_attr = [
            'title' => 'Manage List Kartu Keluarga',
            'breadcrumbs' => [
                ['name' => 'Dashboard'],
                ['name' => 'Data Master'],
            ]
        ];

        $rts = RukunTetangga::all();
        $hub_kks = HubunganDenganKK::all();
        $image_folder = $this->image_folder;
        $data = compact(
            'page_attr',
            'rts',
            'hub_kks',
            'image_folder',
        );
        return view('admin.kependudukan.kartukeluarga.index', array_merge($data, ['compact' => $data]));
    }

    public function insert(Request $request)
    {
        return $this->repo->insert($request);
    }

    public function update(Request $request)
    {
        try {
            $model = KartuKeluarga::find($request->id);
            $request->validate(array_merge(['id' => ['required', 'int']], $this->validate_model));

            $model->no = $request->no;
            $model->rt_id = $request->rt_id;
            $model->alamat = $request->alamat;

            if ($image = $request->file('foto')) {
                $foto_kk = AppHelper::slugify($request->no) . substr($request->slug, 0, 10) . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($this->image_folder, $foto_kk);
                $model->foto = $foto_kk;
            }

            $model->save();
            return response()->json();
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }

    public function delete(KartuKeluarga $model)
    {
        try {
            $model->delete();
            return response()->json();
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }

    public function anggota_select2(Request $request)
    {
        try {
            $table_rt = RukunTetangga::tableName;
            $table_penduduk = Penduduk::tableName;
            $model = Penduduk::select([
                DB::raw("$table_penduduk.id as id"),
                DB::raw("concat($table_penduduk.nik, ' | ', $table_rt.nama,' | ',$table_penduduk.nama) as text")
            ])->whereRaw("(
                    $table_rt.nama like '%$request->search%' or
                    $table_rt.nomor like '%$request->search%' or
                    $table_penduduk.nama like '%$request->search%' or
                    $table_penduduk.alamat_lengkap like '%$request->search%' or
                    $table_penduduk.nik like '%$request->search%' or
                    $table_penduduk.id like '%$request->search%'
                    )")
                ->leftJoin("$table_rt", "$table_rt.id", '=', "$table_penduduk.rt_id")
                ->limit(10);

            $result = $model->get()->toArray();
            if ($request->with_empty && $request->search) {
                $result = array_merge([['id' => $request->search, 'text' => $request->search . ' (Buat Data Penduduk)']], $result);
            }

            return response()->json(['results' => $result]);
        } catch (\Exception $error) {
            return response()->json($error, 500);
        }
    }

    public function getById(KartuKeluarga $model)
    {
        try {
            return response()->json($model);
        } catch (\Exception $error) {
            return response()->json($error, 500);
        }
    }

    public function anggota_list(Request $request)
    {
        try {
            // table
            $table_kk_list = KartuKeluargaData::tableName;
            $table_penduduk = Penduduk::tableName;
            $table_hd_kk = HubunganDenganKK::tableName;

            $id = $request->id;
            $result = KartuKeluargaData::selectRaw("$table_kk_list.*, b.nik")
                ->selectRaw("DATE_FORMAT($table_kk_list.created_at, '%W, %d %M %Y %H:%i:%s') as created")
                ->selectRaw("b.nama as penduduk")
                ->selectRaw("c.nama as hubungan_dengan_kk")
                ->join("$table_penduduk as b", "b.id", "=", "$table_kk_list.penduduk_id")
                ->join("$table_hd_kk as c", "c.id", "=", "$table_kk_list.hubungan_dengan_kk_id")
                ->where("$table_kk_list.kartu_keluarga_id", $id)
                ->orderBy("urut")
                ->get();
            return response()->json($result);
        } catch (\Exception $error) {
            return response()->json($error, 500);
        }
    }

    public function anggota_insert(Request $request)
    {
        try {
            $request->validate([
                'penduduk_id' => ['required', 'integer'],
                'kartu_keluarga_id' => ['required', 'integer'],
                'hubungan_dengan_kk_id' => ['required', 'integer'],
            ]);

            $model = new KartuKeluargaData();
            $model->penduduk_id = $request->penduduk_id;
            $model->kartu_keluarga_id = $request->kartu_keluarga_id;
            $model->hubungan_dengan_kk_id = $request->hubungan_dengan_kk_id;

            $model->save();
            return response()->json();
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }

    public function anggota_delete(KartuKeluargaData $model)
    {
        try {
            $model->delete();
            return response()->json();
        } catch (ValidationException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 500);
        }
    }
}
