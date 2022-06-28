<?php

namespace App\Http\Controllers\Admin\Kependudukan;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\DataMaster\Agama;
use App\Models\DataMaster\Pekerjaan;
use App\Models\DataMaster\Pendidikan;
use App\Models\DataMaster\RukunTetangga;
use App\Models\DataMaster\StatusKawin;
use App\Models\DataMaster\StatusPenduduk;
use Illuminate\Http\Request;
use League\Config\Exception\ValidationException;
use Yajra\Datatables\Datatables;
use App\Models\Kependudukan\Penduduk;
use Illuminate\Support\Facades\DB;

class PendudukController extends Controller
{
    private $folder_akte = Penduduk::image_folder_akte;
    private $folder_ktp = Penduduk::image_folder_ktp;

    private $validate_model = [
        'nama' => ['required', 'string', 'max:255'],
        'nik' => ['nullable', 'string', 'max:16'],
        'kota_lahir' => ['required', 'string', 'max:255'],
        'jenis_kelamin' => ['required', 'string', 'max:255'],
        'alamat_lengkap' => ['required', 'string'],

        'status' => ['required', 'int'],
        'status_tinggal' => ['nullable', 'int'],
        'penduduk_negara' => ['required', 'int'],
        'negara_asal' => ['nullable', 'string', 'max:255'],

        // data master
        'agama_id' => ['required', 'int'],
        'pendidikan_id' => ['required', 'int'],
        'pekerjaan_id' => ['required', 'int'],
        'status_kawin_id' => ['required', 'int'],
        'status_penduduk_id' => ['required', 'int'],
        'rt_id' => ['required', 'int'],

        // tanggal
        'tanggal_lahir' => ['required', 'string', 'max:255'],
        'tanggal_mati' => ['nullable', 'string', 'max:255'],
        'tanggal_pindah' => ['nullable', 'string', 'max:255'],
        'tanggal_datang' => ['nullable', 'string', 'max:255'],
    ];

    public function index(Request $request)
    {
        if (request()->ajax()) {
            // list table
            $table_penduduk = Penduduk::tableName;
            $table_agama = Agama::tableName;
            $table_pendidikan = Pendidikan::tableName;
            $table_pekerjaan = Pekerjaan::tableName;
            $table_status_kawin = StatusKawin::tableName;
            $table_status_penduduk = StatusPenduduk::tableName;
            $table_rt = RukunTetangga::tableName;

            // get key from validate
            $select = [];
            foreach ($this->validate_model as $k => $val) $select[] = "a.$k";
            $base_url_ktp = url(str_replace('./', '', $this->folder_ktp)) . '/';
            $base_url_akte = url(str_replace('./', '', $this->folder_akte)) . '/';
            // get data from model
            $model = Penduduk::select(array_merge([
                'a.id',
                'a.file_ktp',
                'a.file_akte',
                'a.ada_ktp',
                'a.ada_akte',
            ], $select))
                // select raw
                ->selectRaw("IF(a.status = 1, 'Dipakai', 'Tidak Dipakai') as status_str")
                ->selectRaw("IF(a.ada_ktp = 1, 'Ada', 'Tidak Ada') as ada_ktp_str")
                ->selectRaw("IF(a.ada_akte = 1, 'Ada', 'Tidak Ada') as ada_akte_str")
                ->selectRaw("concat('{$base_url_ktp}',a.file_ktp) as ktp_link")
                ->selectRaw("concat('{$base_url_akte}',a.file_akte) as akte_link")
                ->selectRaw("(SELECT TIMESTAMPDIFF(YEAR, a.tanggal_lahir, CURDATE())) as umur")
                ->selectRaw("ag.nama as agama")
                ->selectRaw("pd.nama as pendidikan")
                ->selectRaw("pk.nama as pekerjaan")
                ->selectRaw("skw.nama as status_kawin")
                ->selectRaw("spen.nama as status_penduduk")
                ->selectRaw("rt.nama as rt")

                // join
                ->leftJoin("$table_agama as ag", 'ag.id', '=', 'a.agama_id')
                ->leftJoin("$table_pendidikan as pd", 'pd.id', '=', 'a.pendidikan_id')
                ->leftJoin("$table_pekerjaan as pk", 'pk.id', '=', 'a.pekerjaan_id')
                ->leftJoin("$table_status_kawin as skw", 'skw.id', '=', 'a.status_kawin_id')
                ->leftJoin("$table_status_penduduk as spen", 'spen.id', '=', 'a.status_penduduk_id')
                ->leftJoin("$table_rt as rt", 'rt.id', '=', 'a.rt_id')
                // from
                ->from("$table_penduduk as a");

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
            'title' => 'Manage List Penduduk',
            'breadcrumbs' => [
                ['name' => 'Dashboard'],
                ['name' => 'Data Master'],
            ]
        ];

        $agamas = Agama::where('status', '=', 1)->get();
        $pendidikans = Pendidikan::where('status', '=', 1)->get();
        $pekerjaans = Pekerjaan::where('status', '=', 1)->get();
        $status_kawins = StatusKawin::where('status', '=', 1)->get();
        $status_penduduks = StatusPenduduk::where('status', '=', 1)->get();
        $rts = RukunTetangga::all();
        $folder_akte = $this->folder_akte;
        $folder_ktp = $this->folder_ktp;
        return view('admin.kependudukan.penduduk', compact(
            'page_attr',
            'agamas',
            'pendidikans',
            'pekerjaans',
            'status_kawins',
            'status_penduduks',
            'rts',
            'folder_akte',
            'folder_ktp'
        ));
    }

    public function insert(Request $request)
    {
        try {
            $request->validate($this->validate_model);

            $model = new Penduduk();
            $model->agama_id = $request->agama_id;
            $model->pendidikan_id = $request->pendidikan_id;
            $model->pekerjaan_id = $request->pekerjaan_id;
            $model->status_kawin_id = $request->status_kawin_id;
            $model->status_penduduk_id = $request->status_penduduk_id;
            $model->rt_id = $request->rt_id;

            $model->status = $request->status;
            $model->penduduk_negara = $request->penduduk_negara;
            $model->negara_asal = $request->negara_asal;

            $model->nik = $request->nik;
            $model->nama = $request->nama;
            $model->kota_lahir = $request->kota_lahir;
            $model->jenis_kelamin = $request->jenis_kelamin;
            $model->alamat_lengkap = $request->alamat_lengkap;
            $model->tanggal_lahir = $request->tanggal_lahir;

            // upload foto ktp dan akta
            $foto_ktp = '';
            if ($image = $request->file('file_ktp')) {
                $foto_ktp = AppHelper::slugify($request->nama) . substr($request->slug, 0, 10) . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($this->folder_ktp, $foto_ktp);
                $model->file_ktp = $foto_ktp;
                $model->ada_ktp = 1;
            } else {
                $model->ada_ktp = 0;
            }

            $foto_akte = '';
            if ($image = $request->file('file_akte')) {
                $foto_akte = AppHelper::slugify($request->nama) . substr($request->slug, 0, 10) . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($this->folder_akte, $foto_akte);
                $model->file_akte = $foto_akte;
                $model->ada_akte = 1;
            } else {
                $model->ada_akte = 0;
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
            $model = Penduduk::find($request->id);
            $request->validate(array_merge(['id' => ['required', 'int']], $this->validate_model));

            $model->agama_id = $request->agama_id;
            $model->pendidikan_id = $request->pendidikan_id;
            $model->pekerjaan_id = $request->pekerjaan_id;
            $model->status_kawin_id = $request->status_kawin_id;
            $model->status_penduduk_id = $request->status_penduduk_id;
            $model->rt_id = $request->rt_id;

            $model->status = $request->status;
            $model->penduduk_negara = $request->penduduk_negara;
            $model->negara_asal = $request->negara_asal;

            $model->nik = $request->nik;
            $model->nama = $request->nama;
            $model->kota_lahir = $request->kota_lahir;
            $model->jenis_kelamin = $request->jenis_kelamin;
            $model->alamat_lengkap = $request->alamat_lengkap;
            $model->tanggal_lahir = $request->tanggal_lahir;

            // upload foto ktp dan akta
            if ($image = $request->file('file_ktp')) {
                $foto_ktp = AppHelper::slugify($request->nama) . substr($request->slug, 0, 10) . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($this->folder_ktp, $foto_ktp);
                $model->file_ktp = $foto_ktp;
                $model->ada_ktp = 1;
            }

            if ($image = $request->file('file_akte')) {
                $foto_akte = AppHelper::slugify($request->nama) . substr($request->slug, 0, 10) . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($this->folder_akte, $foto_akte);
                $model->file_akte = $foto_akte;
                $model->ada_akte = 1;
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

    public function delete(Penduduk $model)
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
            $model = Penduduk::select(['id', DB::raw('nama as text')])
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

    public function getById(Penduduk $model)
    {
        try {
            return response()->json($model);
        } catch (\Exception $error) {
            return response()->json($error, 500);
        }
    }
}
