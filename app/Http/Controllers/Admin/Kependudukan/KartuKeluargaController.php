<?php

namespace App\Http\Controllers\Admin\Kependudukan;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\DataMaster\HubunganDenganKK;
use App\Models\DataMaster\RukunTetangga;
use App\Models\Kependudukan\KartuKeluarga;
use App\Models\Kependudukan\KartuKeluarga\Data;
use App\Models\Kependudukan\KartuKeluargaList;
use Illuminate\Http\Request;
use League\Config\Exception\ValidationException;
use Yajra\Datatables\Datatables;
use App\Models\Kependudukan\Penduduk;
use Illuminate\Support\Facades\DB;

class KartuKeluargaController extends Controller
{
    private $image_folder = KartuKeluarga::image_folder;

    private $validate_model = [
        'no' => ['required', 'string', 'max:16'],
        'alamat' => ['nullable', 'string'],
        'rt_id' => ['required', 'integer'],
    ];

    private $query = [];

    public function index(Request $request)
    {
        if (request()->ajax()) {
            // list table
            $table_kk = KartuKeluarga::tableName;
            $table_kk_list = Data::tableName;
            $table_hd_kk = HubunganDenganKK::tableName;
            $table_penduduk = Penduduk::tableName;
            $table_rt = RukunTetangga::tableName;

            // cusotm query
            // get list anggota kk dengan no urut terendah
            // ========================================================================================================
            $this->query['jumlah_anggota'] = <<<SQL
                (select count(*) from $table_kk_list where $table_kk_list.kartu_keluarga_id = $table_kk.id)
            SQL;
            $this->query['jumlah_anggota_alias'] = 'jumlah_anggota';


            $this->query['anggota'] = <<<SQL
                (select concat($table_penduduk.nama, '[', $table_hd_kk.singkatan , ']') from $table_penduduk
                    join $table_kk_list on $table_penduduk.id = $table_kk_list.penduduk_id
                    join $table_hd_kk on $table_kk_list.hubungan_dengan_kk_id = $table_hd_kk.id
                    where $table_kk_list.kartu_keluarga_id = $table_kk.id
                    order by $table_hd_kk.urut asc limit 1)
            SQL;
            $this->query['anggota_alias'] = 'anggota';
            // ========================================================================================================

            // get key from validate
            $select = [];
            foreach ($this->validate_model as $k => $val) $select[] = "$table_kk.$k";
            $base_url_image_folder = url(str_replace('./', '', $this->image_folder)) . '/';

            $model = KartuKeluarga::select(array_merge([
                "$table_kk.id",
                DB::raw("rt.nama as rt"),
                DB::raw("{$this->query['anggota']} as {$this->query['anggota_alias']}"),
                DB::raw("{$this->query['jumlah_anggota']} as {$this->query['jumlah_anggota_alias']}"),
            ], $select))
                ->selectRaw("concat('{$base_url_image_folder}',$table_kk.foto) as foto_link")
                ->selectRaw("DATE_FORMAT($table_kk.created_at, '%W, %d %M %Y %H:%i:%s') as created")
                ->selectRaw("DATE_FORMAT($table_kk.updated_at, '%W, %d %M %Y %H:%i:%s') as updated")
                // join
                ->leftJoin("$table_rt as rt", 'rt.id', '=', "$table_kk.rt_id");

            return Datatables::of($model)
                ->addIndexColumn()
                ->filterColumn('rt', function ($query, $keyword) {
                    $query->whereRaw("(rt.nama like '%$keyword%')");
                })
                ->filterColumn('created', function ($query, $keyword) {
                    $table_kk = KartuKeluarga::tableName;
                    $query->whereRaw("(DATE_FORMAT($table_kk.created_at, '%W, %d %M %Y %H:%i:%s') like '%$keyword%')");
                })
                ->filterColumn('updated', function ($query, $keyword) {
                    $table_kk = KartuKeluarga::tableName;
                    $query->whereRaw("(DATE_FORMAT($table_kk.updated_at, '%W, %d %M %Y %H:%i:%s') like '%$keyword%')");
                })
                ->filterColumn($this->query['anggota_alias'], function ($query, $keyword) {
                    $query->whereRaw("{$this->query['anggota']} like '%$keyword%'");
                })
                ->filterColumn($this->query['jumlah_anggota_alias'], function ($query, $keyword) {
                    $query->whereRaw("{$this->query['jumlah_anggota']} like '%$keyword%'");
                })
                ->make(true);
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
        return view('admin.kependudukan.kartukeluarga', compact(
            'page_attr',
            'rts',
            'hub_kks',
            'image_folder',
        ));
    }

    public function insert(Request $request)
    {
        try {
            $request->validate($this->validate_model);

            $model = new KartuKeluarga();
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
            $table_kk_list = Data::tableName;
            $table_penduduk = Penduduk::tableName;
            $table_hd_kk = HubunganDenganKK::tableName;

            $id = $request->id;
            $result = Data::selectRaw("$table_kk_list.*, b.nik")
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

            $model = new Data();
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

    public function anggota_delete(Data $model)
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
