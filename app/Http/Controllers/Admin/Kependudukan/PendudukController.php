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
use App\Models\Kependudukan\Penduduk\Akte;
use App\Models\Kependudukan\Penduduk\Ktp;
use App\Models\Kependudukan\Peristiwa;
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
        'tanggal_lahir' => ['required', 'string', 'max:255'],
        'tanggal_mati' => ['nullable', 'string', 'max:255'],
        'status' => ['required', 'int'],
        'asal_data' => ['required', 'int'],

        // 'penduduk_negara' => ['required', 'int'],
        // 'negara_asal' => ['nullable', 'string', 'max:255'],

        // // data master
        // 'agama_id' => ['required', 'int'],
        // 'pendidikan_id' => ['required', 'int'],
        // 'pekerjaan_id' => ['required', 'int'],
        // 'status_penduduk_id' => ['required', 'int'],
        // 'rt_id' => ['required', 'int'],

        // tanggal
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
            DB::beginTransaction();
            $request->validate($this->validate_model);
            // insert data model penduduk
            $model = new Penduduk();
            $model->nama = $request->nama;
            $model->nik = $request->nik;
            $model->kota_lahir = $request->kota_lahir;
            $model->jenis_kelamin = $request->jenis_kelamin;
            $model->no_hp = $request->no_hp;
            $model->alamat_lengkap = $request->alamat_lengkap;
            $model->tanggal_lahir = $request->tanggal_lahir;
            $model->tanggal_mati = $request->tanggal_mati;

            // 0 Tidak ada di lingkungan rw, 1 ada di lingkungan rw
            $model->status = $request->status;

            // 0 kelahiran, 1 kedatangan
            $model->asal_data = $request->asal_data;

            // get id
            $model->save();

            dd($model);



            // upload foto ktp dan akta
            $foto_ktp = '';
            if ($image = $request->file('file_ktp')) {
                $foto_ktp = $request->nik . AppHelper::slugify($request->nama)  .  '.' .  $image->getClientOriginalExtension();
                $image->move($this->folder_ktp, $foto_ktp);
                $model->file_ktp = $foto_ktp;
                $model->ada_ktp = 1;
            } else {
                $model->ada_ktp = 0;
            }

            $foto_akte = '';
            if ($image = $request->file('file_akte')) {
                $foto_akte = $request->nik . AppHelper::slugify($request->nama)  .  '.' .  $image->getClientOriginalExtension();
                $image->move($this->folder_akte, $foto_akte);
                $model->file_akte = $foto_akte;
                $model->ada_akte = 1;
            } else {
                $model->ada_akte = 0;
            }

            // set peristiwa
            $model->save();
            // Peristiwa::create([
            //     'penduduk_id' => $model->id,
            //     'tanggal' => $request->tanggal_lahir,
            //     'peristiwa' => 1
            // ]);

            // // warga pindahan dari luar
            // if ($request->asal_data == 1) {
            //     Peristiwa::create([
            //         'penduduk_id' => $model->id,
            //         'tanggal' => $request->tanggal_datang,
            //         'peristiwa' => 4
            //     ]);
            // }

            DB::commit();
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
            DB::beginTransaction();
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

            $model->asal_data = $request->asal_data;

            // upload foto ktp dan akta
            if ($image = $request->file('file_ktp')) {
                if (file_exists("{$this->folder_ktp}/{$model->file_ktp}")) {
                    $date_time = date('Y-m-d-H-i-s');
                    rename("{$this->folder_ktp}/{$model->file_ktp}", "{$this->folder_ktp}/delete/{$date_time}-{$model->file_ktp}");
                }

                $foto_ktp = $request->nik . AppHelper::slugify($request->nama) . '.' . $image->getClientOriginalExtension();
                $image->move($this->folder_ktp, $foto_ktp);
                // move file to delete

                $model->file_ktp = $foto_ktp;
                $model->ada_ktp = 1;
            }

            if ($image = $request->file('file_akte')) {
                if (file_exists("{$this->folder_akte}/{$model->file_akte}")) {
                    $date_time = date('Y-m-d-H-i-s');
                    rename("{$this->folder_akte}/{$model->file_akte}", "{$this->folder_akte}/delete/{$date_time}-{$model->file_akte}");
                }

                $foto_akte = $request->nik . AppHelper::slugify($request->nama) . '.' . $image->getClientOriginalExtension();
                $image->move($this->folder_akte, $foto_akte);
                $model->file_akte = $foto_akte;
                $model->ada_akte = 1;
            }

            // update peristiwa
            // Peristiwa::updateOrCreate([
            //     'id' => $request->tanggal_lahir_id,
            //     'penduduk_id' => $model->id,
            //     'tanggal' => $request->tanggal_lahir,
            //     'peristiwa' => 1
            // ]);

            if ($request->asal_data == 1) {
                // Peristiwa::updateOrCreate([
                //     'id' => $request->tanggal_datang_id,
                //     'penduduk_id' => $model->id,
                //     'tanggal' => $request->tanggal_datang,
                //     'peristiwa' => 4
                // ]);
            } else {
                // $asal = Peristiwa::where('penduduk_id', '=', $model->id)
                //     ->where('peristiwa', '=', 4)
                //     ->orderBy('tanggal', 'desc')->get()->first();
                // if ($asal) {
                //     $asal->delete();
                // }
            }

            $model->save();
            DB::commit();
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
            DB::beginTransaction();
            // delete peristiwa
            // $peristiwa = Peristiwa::where('penduduk_id', '=', $model->id)->get(['id']);
            // if ($peristiwa) {
            // Peristiwa::destroy($peristiwa->toArray());
            // }

            // delete file ktp akte
            if (file_exists("{$this->folder_ktp}/{$model->file_ktp}")) {
                $date_time = date('Y-m-d-H-i-s');
                rename("{$this->folder_ktp}/{$model->file_ktp}", "{$this->folder_ktp}/delete/{$date_time}-{$model->file_ktp}");
            }

            if (file_exists("{$this->folder_akte}/{$model->file_akte}")) {
                $date_time = date('Y-m-d-H-i-s');
                rename("{$this->folder_akte}/{$model->file_akte}", "{$this->folder_akte}/delete/{$date_time}-{$model->file_akte}");
            }

            // delete data
            $model->delete();
            DB::commit();
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
            if ($model->asal_data == 1) {
                // tanggal datang
                // $peristiwa = Peristiwa::where('penduduk_id', '=', $model->id)
                //     ->where('peristiwa', '=', 4)
                //     ->orderBy('tanggal', 'desc')->get(['tanggal', 'id'])->first();
                // if ($peristiwa) {
                //     $model->tanggal_datang = $peristiwa->tanggal;
                //     $model->tanggal_datang_id = $peristiwa->id;
                // }
            }

            // tanggal lahir
            // $peristiwa = Peristiwa::where('penduduk_id', '=', $model->id)
            //     ->where('peristiwa', '=', 1)
            //     ->orderBy('tanggal', 'desc')->get(['tanggal', 'id'])->first();
            // if ($peristiwa) {
            //     $model->tanggal_lahir = $peristiwa->tanggal;
            //     $model->tanggal_lahir_id = $peristiwa->id;
            // }

            return response()->json($model);
        } catch (\Exception $error) {
            return response()->json($error, 500);
        }
    }
}
