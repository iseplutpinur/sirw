<?php

namespace App\Http\Controllers\Admin\Kependudukan;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\DataMaster\HubunganDenganKK;
use App\Models\DataMaster\RukunTetangga;
use App\Models\Kependudukan\KartuKeluarga;
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

    public function index(Request $request)
    {
        if (request()->ajax()) {
            // list table
            $table_kk = KartuKeluarga::tableName;
            $table_kk_list = KartuKeluargaList::tableName;
            $table_hd_kk = HubunganDenganKK::tableName;
            $table_penduduk = Penduduk::tableName;
            $table_rt = RukunTetangga::tableName;

            // get key from validate
            $select = [];
            foreach ($this->validate_model as $k => $val) $select[] = "a.$k";
            $base_url_image_folder = url(str_replace('./', '', $this->image_folder)) . '/';

            // cusotm query
            // get list anggota kk dengan no urut terendah
            $anggota = <<<SQL
                (select concat($table_penduduk.nama, '[', $table_hd_kk.singkatan , ']') from $table_penduduk
                    join $table_kk_list on $table_penduduk.id = $table_kk_list.penduduk_id
                    join $table_hd_kk on $table_kk_list.hubungan_dengan_kk_id = $table_hd_kk.id
                    where $table_kk_list.kartu_keluarga_id = a.id
                    order by $table_hd_kk.urut asc limit 1)
            SQL;

            $jumlah_anggota = <<<SQL
                (select count(*) from $table_kk_list where $table_kk_list.kartu_keluarga_id = a.id)
            SQL;

            // get data from model
            $model = Penduduk::select(array_merge([
                'a.id',
            ], $select))
                // select raw
                ->selectRaw("($anggota) as anggota")
                ->selectRaw("concat('{$base_url_image_folder}',a.foto) as foto_link")
                ->selectRaw("($jumlah_anggota) as jumlah_anggota")
                ->selectRaw("rt.nama as rt")
                ->selectRaw("DATE_FORMAT(a.created_at, '%W, %d %M %Y %H:%i:%s') as created")
                ->selectRaw("DATE_FORMAT(a.updated_at, '%W, %d %M %Y %H:%i:%s') as updated")

                // join
                ->leftJoin("$table_rt as rt", 'rt.id', '=', 'a.rt_id')
                // from
                ->from("$table_kk as a");

            // filter
            if (isset($request->filter)) {
                $filter = $request->filter;
                if ($filter['status'] != '') {
                    $model->where('status', '=', $filter['status']);
                }
            }

            return Datatables::of($model)
                ->addIndexColumn()
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
        $image_folder = $this->image_folder;
        return view('admin.kependudukan.kartukeluarga', compact(
            'page_attr',
            'rts',
            'image_folder'
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

    public function select2(Request $request)
    {
        try {
            $model = KartuKeluarga::select(['id', DB::raw('nama as text')])
                ->whereRaw("(`nama` like '%$request->search%' or `id` like '%$request->search%')")
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
}
